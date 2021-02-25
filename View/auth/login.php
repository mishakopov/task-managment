<!doctype html>
<html lang="en">
<head>
    <?php
    require_once '../View/layouts/head.php';
    ?>
</head>
<body>
<?php
require_once '../View/layouts/nav.php';
?>
<div class="container">
    <div class="d-flex justify-content-center pt-5">
        <div class="col-sm-4">
            <form action="user/login" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small class="text-danger"><?= Helper::getError('email') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
                    <small class="text-danger"><?= Helper::getError('password') ?></small>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>