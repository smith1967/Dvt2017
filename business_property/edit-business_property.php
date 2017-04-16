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
//    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    $valid = TRUE;
    if (!$valid) {
        
    } else {
        do_edit();
    }
}
require_once INC_PATH . 'header.php';
?>
<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">
            <?php
            $sql = "SELECT * FROM business_property where property_id='$_GET[property_id]';";
            $rs = mysqli_query($db, $sql);
            $row = mysqli_fetch_array($rs);
            ?>
            <form method="post" class="form-horizontal" action=""> 
                <input type="hidden" name="property_id"value="<?php echo $row['property_id'] ?>">
                <div class="form-group">
                    <label class="control-label col-md-3" for="name">ชื่อคุณสมบัติ</label>
                    <div class="col-md-3"><input type="text" class="form-control" id="name" name="name"value="<?php echo $row['name'] ?>"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="descript">รายละเอียด  </label>
                    <div class="col-md-6"><input type="text" class="form-control" id="descript"name="descript"value="<?php echo $row['descript'] ?>"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-4"><button type="submit" class="btn btn-primary"name="submit">แก้ไขข้อมูล</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_edit() {
    global $db;
    $data = &$_POST;
    echo $query = "UPDATE business_property SET `name`=".pq($data['name']).",`descript`=".pq($data['descript'])." WHERE `property_id`=".pq($data['property_id'])."";
    $result=mysqli_query($db,$query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('แก้ไขข้อมูลเรียบร้อย');
        redirect('rain/business_property');
    } else {
        set_err('แก้ไขข้อมูลไม่สำเร็จ ' . mysqli_error($db));
    }
}
