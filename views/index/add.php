<?php
require_once('/views/layout/header.php');

//if (!isset($usersList)) $usersList = [];
?>
<div class="wrap">
    <div class="container">
        <div class="col-md-6 col-md-offset-3 form-div">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="First Second Last" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
                    <div class="col-sm-10">
                        <select name="area" id="selectArea" class="form-control" required></select>
                    </div>
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
<?php require_once('/views/layout/footer.php');?>
