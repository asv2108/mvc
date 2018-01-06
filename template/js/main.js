$(document).ready(function(){
    $.ajax({
        method:'GET',
        url:'/get-area',
    }).done(function(res){
        var option = '<option value=""></option>';
        var json = $.parseJSON(res);
        for (key in json) {
            var arr = json[key];
            var area = arr.area
            option+='<option value="'+arr.id+'">'+area+'</option>'
        }
        $('#selectArea').html(option).chosen({placeholder_text_single:'Select an area'});

    });
});
