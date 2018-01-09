$(document).ready(function(){

    //improve select view
    $('#selectArea').chosen({placeholder_text_single:'Select an area'});

    //clear success message
    setTimeout(function(){
        $('.text-success').text(' ');
    },2000);

    // if a city has not district we do not check it field into submit
    var hasDistrict = true;

    // check dublicate email
    $('#inputEmail').blur(function(){
        var email = $(this).val().trim();
        //TODO cneck regex email
        if(email){
            $.ajax({
                method:'POST',
                data:{email:email},
                url:'/check-unique'
            }).done(function(res){
                var json = $.parseJSON(res);
                console.log(res);
                if(json !='error'){
                    $('#mod-name').text(json.name);
                    $('#mod-email').text(json.email);
                    $('#mod-territory').text(json.territory);
                    $('#modal-show').modal('show');
                }
            });
        }
    });

    // generate the new select for city after selected an area
    $('#selectArea').change(function(){
        $('#area-error').text(' ');
        var valueAreaId = $("option:selected", this).val();
        var valueAreaText = $("option:selected", this).text();
        //clear previously chose
        var divCity = $('#div-city');
        divCity.html(' ');
        var divDistrict = $('#div-district');
        divDistrict.html(' ');
        if(valueAreaText !='м.Київ' && valueAreaText !='м.Севастополь' ){
            //generete the select with all cities for the form registration
            $.ajax({
                method:'POST',
                data:{id:valueAreaId},
                url:'/get-city'
            }).done(function(res){
                var html = '';
                html += '<label for="selectCity" class="col-sm-2 control-label">City</label>';
                html += '<div class="col-sm-10">';
                html += '<select name="city" id="selectCity" class="form-control">';
                html += '<option value=""></option>';
                var json = $.parseJSON(res);
                for (key in json) {
                    var arr = json[key];
                    var city = arr.city
                    html+='<option value="'+arr.id+'">'+city+'</option>'
                }
                html += '</select>';
                html += '</div>';
                html += '<span class="text-danger col-sm-8 col-sm-offset-2" id="city-error"></span>';
                divCity.html(html);

                $('#selectCity').chosen({placeholder_text_single:'Select a city'});

                // generate the new select for district after selected a city
                $('#selectCity').change(function(){
                    //clear previously chose
                    divDistrict.html(' ');
                    $('#city-error').text(' ');
                    var valueId = $("option:selected", this).val();
                    var valueText = $("option:selected", this).text();
                    //generete the select with all cities for the form registration
                    $.ajax({
                        method:'POST',
                        data:{id:valueId},
                        url:'/get-district'
                    }).done(function(res){
                        var html = '';
                        html += '<label for="selectDistrict" class="col-sm-2 control-label">District</label>';
                        html += '<div class="col-sm-10">';
                        html += '<select name="district" id="selectDistrict" class="form-control">';
                        html += '<option value=""></option>';
                        var json = $.parseJSON(res);
                        var emptyVal = 0;
                        for (key in json) {
                            var arr = json[key];
                            var district = arr.district;
                            if(district.indexOf(valueText)!==-1){
                                html+='<option value="'+arr.id+'">'+district+'</option>'
                                emptyVal ++;
                            }
                        }
                        html += '</select>';
                        html += '</div>';
                        html += '<span class="text-danger col-sm-8 col-sm-offset-2" id="district-error"></span>';
                        if(emptyVal>0){
                            divDistrict.html(html);
                            $('#selectDistrict').chosen({placeholder_text_single:'Select a district'});
                        }else{
                            //TODO a message on page
                            hasDistrict = false;
                            alert('The selected city does not fave districts');
                        }
                    });
                });
            });
        }else{
            //TODO duplicate code???
            divDistrict.html(' ');
            divCity.html(' ');
            //generete the select with all cities for the form registration
            $.ajax({
                method:'POST',
                data:{id:valueAreaId},
                url:'/get-district'
            }).done(function(res){
                var html = '';
                html += '<label for="selectDistrict" class="col-sm-2 control-label">District</label>';
                html += '<div class="col-sm-10">';
                html += '<select name="district" id="selectDistrict" class="form-control">';
                html += '<option value=""></option>';
                var json = $.parseJSON(res);
                for (key in json) {
                    var arr = json[key];
                    var district = arr.district
                    html+='<option value="'+arr.id+'">'+district+'</option>'
                }
                html += '</select>';
                html += '</div>';
                html += '<span class="text-danger col-sm-8 col-sm-offset-2" id="district-error"></span>';
                divDistrict.html(html);
                $('#selectDistrict').chosen({placeholder_text_single:'Select a district'});
            });
        }

    });

    //for validate username
    function test (value){
        var regExp = /^[a-zа-я]+\s[a-zа-я]+\s[a-zа-я]+$/i;
        return regExp.test(value);
    }

    $('#form-add-user').submit(function(){
        // for catch an error
        var flag = false;
        // clear previously messages
        $('#area-error').text(' ');
        $('#city-error').text(' ');
        var districtError = $('#district-error');
        districtError.text(' ');
        $('#name-error').text(' ');

        var name = $('#inputName').val().trim();
        if(!test(name)){
            flag = true;
            $('#name-error').text('Wrong format!');
        }

        //var email = $('inputEmail').val(); html5 type and required
        var district = $("#selectDistrict option:selected");
        var area = $("#selectArea option:selected").text();
        if(!area){
            flag = true;
            $('#area-error').text('The area field is require!');
        }else{
            if(area !='м.Київ' && area !='м.Севастополь'){
                var city = $("#selectCity option:selected").text();
                if(!city){
                    flag = true;
                    $('#city-error').text('The city field is require!');
                }else{
                    if(hasDistrict){
                        district.val().trim();
                        if(!district){
                            flag = true;
                            districtError.text('The district field is require!');
                        }
                    }
                }
            }else{
                district.val().trim();
                if(!district){
                    flag = true;
                    alert('empty district');
                    districtError.text('The district field is require!');
                }
            }
        }
        if(flag){
            return false;
        }
    });
});
