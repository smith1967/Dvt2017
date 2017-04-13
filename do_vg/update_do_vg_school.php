<?php include_once 'include/config.php'; ?>
<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลสถานประกอบการ";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    //$valid = TRUE;
    if (!$valid) {
        
    } else {
        do_edit();
    }
}
require_once INC_PATH . 'header.php';
?>
<?php
$school = get_school($_GET['dovg_school_id']);
?>

<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">

            <form method="post" class="form-horizontal" id="rain" action="">
                <fieldset>
                    <input type="hidden" name="dovg_school_id"value="<?php echo $school['dovg_school_id'] ?>">

                    <div class="form-group">

                        <label class="control-label col-md-3" for="dovg_id">รหัส กรอ</label>
                        <div class="col-md-3"><input type="text" class="form-control" id="dovg_id" name="dovg_id" value="<?php set_var($school['dovg_id']);?>"></div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-md-3"><input type="text" class="form-control" id="school_id" name="school_id" value="<?php set_var($school['school_id']);?>"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-4"><button type="submit" class="btn btn-primary"name="submit">แก้ไขข้อมูล</button></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function do_edit() {
    global $db;
    $data = &$_POST;
    $query = "UPDATE do_vg_school SET dovg_id=" . pq($data['dovg_id']) .",school_id=" . pq($data['school_id']) . " WHERE dovg_school_id = " . pq($data['dovg_school_id']) . "";
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูลได้');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');     
    }
    redirect('rain/do_vg_school');
}

function get_school($dovg_school_id) {
    global $db;
    $school = array();
    $sql = "SELECT * FROM do_vg_school WHERE dovg_school_id='$dovg_school_id'";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    $school = $row;
    return $school;
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[0-9]{1,}/', $data['dovg_id'])) {
        set_err('กรุณากรอกตัวเลขในช่อง กรอ');
        $valid = false;
    }
    if (empty($data['dovg_id'])) {
        set_err('กรุณากรอกรหัส กรอ');
        $valid = false;
    }
    
    if (!preg_match('/[0-9]{1,}/', $data['school_id'])) {
        set_err('กรุณากรอกตัวเลขในช่อง รหัสสถานศึกษา');
        $valid = false;
    }
    if (empty($data['school_id'])) {
        set_err('กรุณากรอกรหัส สถาศึกษา');
        $valid = false;
    }
    
    return $valid;
}
?>

