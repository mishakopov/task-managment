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
            <h1 class="text-center pt-5">Task Create</h1>
            <form action="/task/store" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" name="title" class="form-control"  aria-describedby="emailHelp" placeholder="Enter title">
                    <small class="text-danger"><?= Helper::getError('title') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select User</label>
                    <select name="user_id" class="form-control" id="exampleFormControlSelect1">
                        <?php
                        foreach ($users as $user){
                        ?>
                        <option value="<?= $user['id']?>"> <?= $user['full_name']?></option>
                        <?php }?>
                    </select>
                    <small class="text-danger"><?= Helper::getError('user') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Body</label>
                    <textarea name='body' class="form-control" id="exampleInputPassword1" placeholder="Body"></textarea>
                    <small class="text-danger"><?= Helper::getError('body') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">File Upload</label>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <small class="text-danger"><?= Helper::getError('file') ?></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Expiration Date</label>
                    <input type="date" name="deadline" class="form-control"  placeholder="Expiration Date">
                    <small class="text-danger"><?= Helper::getError('deadline') ?></small>
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