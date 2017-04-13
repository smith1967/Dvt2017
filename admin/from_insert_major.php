<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "เพิ่มข้อมูลสาขาวิชา";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//   var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }

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
        <div class="panel-heading">ข้อมูลสาขาวิชา</div>
        <div class="panel-body">


            <form method="post" class="form-horizontal" action=""> 
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="major_id">รหัสสาขาวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="major_id" name="major_id" value="<?php set_var($major_id) ?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="major_name">ชื่อสาขาวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="major_name" name="major_name" value="<?php set_var($major_name) ?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="type_code">ประเภทวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="type_code" name="type_code" value="<?php set_var($type_code) ?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="major_eng">ชื่อภาษาอังกฤษ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="major_eng" name="major_eng" value="<?php set_var($major_eng) ?>"></div>
                </div>
        </div> 

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
        </div>
        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_insert() {
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO major (`major_id`,`major_name`,`type_code`,`major_eng`)  VALUES (" . pq($data['major_id']) . "," . pq($data['major_name']) . "," . pq($data['type_code']) . "," . pq($data['major_eng']) . ")";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('บันทึกข้อมูลเรียบร้อย');
        redirect('natthapon/show_major');
    } else {
        set_err('บันทึกข้อมูลไม่สำเร็จ ' . mysqli_error($db));
    }
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[0-9_]{1,}/', $data['major_id'])) {
        set_err('ข้อมูลสาขาต้องเป็นตัวเลข');
        $valid = false;
    }
    if (empty($data['major_name'])) {
        set_err('กรุณากรอกข้อมูล');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['type_code'])) {
        set_err('ข้อมูลรหัสประเภทวิชาต้องเป็นตัวเลข');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z_]{5,}/', $data['major_eng'])) {
        set_err('ข้อมูลนี้ต้องเป็นภาษาอังกฤษ');
        $valid = false;
    }
    return $valid;
}
?>
