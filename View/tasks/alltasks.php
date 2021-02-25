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

    <h1>Tasks <?= Helper::isAdmin() ? '<a href="/task/create"><span class="btn btn-success">+</span></a>': '' ?></h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">File</th>
            <th scope="col">Expiration Date</th>
            <th scope="col">User</th>
            <th scope="col">Status</th>
            <?= !Helper::isAdmin() ? '<th scope="col">Change Status</th>': '' ?>
        </tr>
        </thead>
        <tbody>
            <?php
                foreach ($tasks as $task){ ?>
                    <tr>
                        <td><?= $task ['title'] ?></td>
                        <td><?= $task ['body'] ?></td>
                       <td><a href="<?= Helper::generateUrl($task['files']) ?>" download><?= end(explode('/', $task ['files']))  ?></a></td>
                        <td><?= $task ['deadline'] ?></td>
                        <td><?= $task ['full_name'] ?></td>
                        <td class="button-td"><?php
                            switch($task ['status']){
                                case 0 :
                                    echo "<button class='btn btn-primary'>Pending</button>";
                                    break;

                                case 1:
                                    echo "<button class='btn  btn-info'>In Progress</button>";
                                    break;

                                case 2:
                                    echo "<button class='btn btn-danger'>Rejected</button>";
                                    break;

                                    case 3:
                                    echo "<button class='btn btn-success'>Done</button>";
                                    break;
                            }
                            ?></td>
                        <?php
                        if (!Helper::isAdmin()){?>
                            <td class="change-status">
                                <div class="form-group">
                                    <select name="status" class="form-control status" data-id="<?=$task ['id'] ?>">
                                        <?php
                                        switch($task ['status']){
                                            case 0 :
                                                echo "<option  selected disabled>Select status</option>";
                                                echo "<option value='1'>In progress</option>";
                                                echo "<option value='2'>Rejected</option>";
                                                echo "<option value='3'>Done</option>";
                                                break;

                                            case 1:
                                                echo "<option selected disabled>Select status</option>";
                                                echo "<option value='0'>Pending</option>";
                                                echo "<option value='2'>Rejected</option>";
                                                echo "<option value='3'>Done</option>";
                                                break;

                                            case 2:
                                                echo "<option selected disabled>Select status</option>";
                                                echo "<option value='1'>In progress</option>";
                                                break;

                                            case 3:
                                                echo "<option selected disabled>Select status</option>";
                                                echo "<option value='1'>In progress</option>";
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </td>
                        <?php }?>
                    </tr>
                <?php } ?>

        </tbody>
    </table>
</div>
<script>
    $('.status').on('change',function() {
         let val = $(this).val();
         let id = $(this).data('id');

         $.ajax({
             url: "/task/change-status/" + id,
             method: "post",
             data: {
                 'status': val
             },
             success: function (result) {
                 let elem = $('select[data-id="' + id + '"]').closest('tr').find('.button-td');
                 $(elem).find('button').remove();
                 let html = '';
                 switch (val) {
                     case "0" :
                         $(elem).html("<button class='btn btn-primary'>Pending</button>");
                         $('select[data-id="' + id + '"]').find('option').remove();
                         html =   "<option selected disabled>Select status</option>" +
                                      "<option value='1'>In Progress</option>" +
                                      "<option value='2'>Rejected</option>"+
                                      "<option value='3'>Done</option>";

                         $('select[data-id="' + id + '"]').html(html);
                         break;

                     case "1":
                         $(elem).html("<button class='btn btn-info'>In progress</button>");
                         $('select[data-id="' + id + '"]').find('option').remove();
                         html =   "<option selected disabled>Select status</option>" +
                             "<option value='0'>Pending</option>" +
                             "<option value='2'>Rejected</option>"+
                             "<option value='3'>Done</option>";

                         $('select[data-id="' + id + '"]').html(html);
                         break;

                     case "2":
                         $(elem).html("<button class='btn btn-danger'>Rejected</button>");
                         html =   "<option selected disabled>Select status</option>" +
                             "<option value='1'>In Progress</option>";

                         $('select[data-id="' + id + '"]').html(html);
                         break;

                     case "3":
                         $(elem).html("<button class='btn btn-success'>Done</button>");
                         html =   "<option selected disabled>Select status</option>" +
                             "<option value='1'>In Progress</option>";

                         $('select[data-id="' + id + '"]').html(html);
                         break;

                 }
             }
         });
    })
</script>
</body>
</html>