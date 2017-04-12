<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูล";
$active = 'edit-edu-type';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
    //var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    //$valid = TRUE;
    if (!$valid) {
        
    } else {
        do_update();
    }
}
require_once INC_PATH . 'header.php';
?>

<div class='container'>
    <?php
     $edu_type = getedu_type($_GET['typcode']);
    ?>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลประเภทวิชา</div>
        <div class="panel-body">
            <form class="form-horizontal" id="signupfrm" method="post" action="">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="typcode">รหัสประเภทวิชา</label>
                        <div class="col-xs-3">
                            <input type="hidden"  id="typcode" name="typcode"  value="<?php set_var($edu_type['typcode']) ?>">
                            <?php echo $edu_type['typcode']; ?>
                        </div>                      
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="typname">ชื่อประเภทวิชา</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="typname" name="typname" value="<?php set_var($edu_type['typname']) ?>" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="etypname">ชื่อภาษาอักงกฤษ</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="etypname" name="etypname" value="<?php set_var($edu_type['etypname']) ?>">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-offset-1">
                            <button type="submit" class="btn btn-primary" name='submit'>แก้ไขข้อมูล</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <?php require_once INC_PATH . 'footer.php'; ?>

    <?php

   function do_update() {
        global $db;
        $data = &$_POST;
    




	   $query = "update edu_type  
	   set typname=" . pq($data['typname']) . ","
            . "etypname=" . pq($data['etypname']) . "
           where typcode = '" . $data['typcode']. "'";

        $result = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
        redirect('sinphong/show_edu_type');
    }
        
    }

    function getedu_type($typcode) {
        global $db;
        $edu_type = array();
        $sql = "SELECT * FROM edu_type WHERE typcode='$typcode'";
        $rs = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($rs);
        $edu_type = $row;
        return $edu_type;
      }  


	function do_validate($data) {
    $valid = true;
    $data = &$_POST;
	/*if (!preg_match('/[0-9]{10,10}/', $data['typcode'])) {
        set_err('รหัสวิชา		: ข้อมูลดาวน์โหลดต้องเป็นตัวเลข 10 ตัว');
        $valid = false;
    }*/
	if (empty($data['typname'])) {
        set_err('ชื่อสาขาวิชา	: กรุณากรอกข้อมูล ประเภทสถานศึกษา');
        $valid = false;
    }
	if (empty($data['etypname'])) {
        set_err('ประเภทวิชา		: กรุณากรอกข้อมูล');
        $valid = false;
    }
	/*if (empty($data['road'])) {
        set_err('กรุณากรอกข้อมูล');
        $valid = false;
    }*/
	
	/*if (empty($data['edu_type_eng'])) {
        set_err('ชื่อภาษาอังกฤษ		: กรุณากรอกข้อมูล');
        $valid = false;
        
    }*/
    return $valid;
}
?>
    