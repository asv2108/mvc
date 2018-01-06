<?php
    require_once('/views/layout/header.php');
    if (!isset($usersList)) $usersList = [];
?>
<div class="wrap">
    <div class="container">
        <div class="button-add ">
            <a href="/add">Add a new user</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User name</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($usersList as $item):?>
                <tr>
                    <td><?=$item['name']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$item['area']?></td>
                </tr>
            <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once('/views/layout/footer.php');?>


