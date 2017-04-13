<?php include_once 'include/config.php'; ?>
<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลสถานประกอบการ";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    // $valid = TRUE;
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
                    <label class="control-label col-md-3" for="dovg_school_id">รหัสการร่วมมือ กรอ กับสถานศึกษา</label>
                    <div class="col-md-3"><input type="text" class="form-control" id="dovg_school_id" name="dovg_school_id" value="<?php set_var($dovg_school_id) ?>"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="dovg_id">รหัส กรอ</label>
                    <div class="col-md-3"><input type="text" class="form-control" id="dovg_id" name="dovg_id" value="<?php set_var($dovg_id) ?>"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="school_id">รหัส สถานศึกษา</label>
                    <div class="col-md-3"><input type="text" class="form-control" id="school_id" name="school_id" value="<?php set_var($school_id) ?>"></div>
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
    $query = "INSERT INTO do_vg_school (`dovg_school_id`,`dovg_id`,`school_id`) VALUES (" . pq($data['dovg_school_id']) . "," . pq($data['dovg_id']) . "," . pq($data['school_id']) . ")";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('บันทึกข้อมูลเรียบร้อย');
        redirect('rain/do_vg_school');
    } else {
        set_err('บันทึกข้อมูลไม่สำเร็จ ' . mysqli_error($db));
    }
    
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[0-9]{1,}/', $data['dovg_school_id'])) {
        set_err('กรุณากรอกเฉพาะตัวเลข');
        $valid = false;
    }
    if (empty($data['dovg_school_id'])) {
        set_err('กรุณากรอกรหัสการร่วมมือระหว่างกรอ.และสถานศึกษา');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['dovg_id'])) {
        set_err('กรุณากรอกเฉพาะตัวเลข');
        $valid = false;
    }
    if (empty($data['dovg_id'])) {
        set_err('กรุณากรอกรหัส กรอ');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['school_id'])) {
        set_err('กรุณากรอกเฉพาะตัวเลข');
        $valid = false;
    }
    if (empty($data['school_id'])) {
        set_err('กรุณากรอกรหัสสถานศึกษา');
        $valid = false;
    }
    return $valid;
}
?>
