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
            <form action="/user/update" method="post" >
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Full Name">
                    <small class="text-danger"><?= Helper::getError('fullname') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small class="text-danger"><?= Helper::getError('email') ?></small>
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