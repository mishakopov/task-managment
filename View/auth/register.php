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
                <form action="user/register" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="name" name="fullname" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="text-danger"><?= Helper::getError('fullname') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control"  aria-describedby="emailHelp" placeholder="Enter email">
                        <small class="text-danger"><?= Helper::getError('email') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name='password' class="form-control"  placeholder="Password">
                        <small class="text-danger"><?= Helper::getError('password') ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name='confirmpassword' class="form-control" placeholder="Confirm Password">
                        <small class="text-danger"><?= Helper::getError('confirmpassword') ?></small>
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