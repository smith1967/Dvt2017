<?php include_once 'include/config.php'; ?>
<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลสถานะต่าง ๆ";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
//    $valid = TRUE;
    if (!$valid) {
        
    } else {
        do_insert();
    }
}
require_once INC_PATH . 'header.php';
?>
<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
                <div class="form-group">
                    <label class="control-label col-md-3" for="property_id">รหัสคุณสมบัติ</label></td>
                    <div class="col-md-3"><input type="text" class="form-control" id="property_id" name="property_id"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="name">ชื่อคุณสมบัติ</label></td>
                    <div class="col-md-3"><input type="text" class="form-control" id="name" name="name"></div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3" for="descript">รายละเอียด</label></td>
                    <div class="col-md-3"><input type="text" class="form-control" id="descript"name="descript"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-4"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_insert() {
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO business_property (`property_id`, `name`, `descript`) VALUES (" . pq($data['property_id']) . "," . pq($data['name']) . "," . pq($data['descript']) . ")";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('บันทึกข้อมูลเรียบร้อย');
        redirect('rain/business_property');
    } else {
        set_err('บันทึกข้อมูลไม่สำเร็จ ' . mysqli_error($db));
    }
}
