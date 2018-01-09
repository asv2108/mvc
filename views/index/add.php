<?php
require_once('/views/layout/header.php');

//if (!isset($usersList)) $usersList = [];
?>
<div class="wrap">
    <div class="container">
        <div class="col-md-6 col-md-offset-3 form-div">
            <form class="form-horizontal" role="form" method="POST" id="form-add-user" action="/save">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="First Second Last" required>
                    </div>
                    <span class="text-danger col-sm-8 col-sm-offset-2" id="name-error"></span>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="selectArea" class="col-sm-2 control-label">Area</label>
                    <div class="col-sm-10">
                        <select name="area" id="selectArea" class="form-control">
                            <option value=""></option>
                            <?php foreach($areaList as $option):?>
                                <option value="<?=$option['id']?>"><?=$option['area']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <span class="text-danger col-sm-8 col-sm-offset-2" id="area-error"></span>
                </div>
                <div class="form-group" id="div-city">
                    <!--  main.js generate new cities here after selected an area -->
                </div>
                <div class="form-group" id="div-district">
                    <!--  main.js generate new districts here after selected a city -->
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                        <button type="submit" class="btn btn-default btn-block">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id="modal-show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title text-warning">Such contact already exist!</h2>
            </div>
            <div class="modal-body">
               <table>
                   <tr>
                       <td id="mod-name"></td>
                   </tr>
                   <tr>
                       <td id="mod-email"></td>
                   </tr>
                   <tr>
                       <td id="mod-territory"></td>
                   </tr>
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<?php require_once('/views/layout/footer.php');?>
