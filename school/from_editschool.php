<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานศึกษา";
$active = 'school';
$subactive = 'list-school';

if (isset($_POST['submit'])) {
    $data = $_POST;
    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    $valid = TRUE;
    if (!$valid) {
        
    } else {
        do_update();gi
    }
}
require_once INC_PATH . 'header.php';
?>

<div class='container'>
    <?php
     $school = getschool($_GET['school_id']);
    ?>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลประเภทวิชา</div>
        <div class="panel-body">
            <form class="form-horizontal" id="signupfrm" method="post" action="">
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-xs-3">
                            <input type="hidden"  id="major_id" name="school_id"  value="<?php echo $school['school_id']; ?>">
                            <?php echo $school['school_id']; ?>
                        </div>                      
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="password">รหัสผ่าน</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="password" name="password"  value="<?php echo $school['password']; ?>">
                          <!--<p class="help-block">ชื่อต้องเป็นภาษาอังกฤษหรือตัวเลขความยาวไม่ต่ำกว่า 5 ตัวอักษร</p>-->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="name">ชื่อสถานศึกษา</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="name" name="name"  value="<?php echo $school['name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="type_id">ประเภทสถานศึกษา</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="type_id" name="type_id" value="<?php echo $school['type_id']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="address_no">เลขที่ตั้ง</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="address_no" name="address_no"  value="<?php echo $school['address_no']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="road">ถนน</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="road" name="road" value="<?php echo $school['road']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="tumbon">ตำบล</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="tumbon" name="tumbon"  value="<?php echo $school['tumbon']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="aumphur">อำเภอ</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="aumphur" name="aumphur" value="<?php echo $school['aumphur']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="province">จังหวัด</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="province" name="province"  value="<?php echo $school['province']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="postcode">รหัสไปรษณีย์</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="postcode" name="postcode" value="<?php echo $school['postcode']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="phone">เบอร์โทรศัพท์</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="phone" name="phone" value="<?php echo $school['phone']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-2" for="fax">เบอร์ Fax</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="fax" name="fax"  value="<?php echo $school['fax']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-2" for="zone">ภาค</label>
                        <div class="col-xs-3">
                            <input type="text" class="input-xlarge" id="zone" name="zone" value="<?php echo $school['zone']; ?>">
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
        echo $query = "update school  set password=" . pq($data['password'])  . ",name=  ".pq($data['name']). ",type_id=  " . pq($data['type_id']) . ",address_no=  ".pq($data['address_no']).",road=  " . pq($data['road']) . ",tumbon=  ".pq($data['tumbon']) . ",aumphur= " . pq($data['aumphur']) . ",province=  ".pq($data['province']) . ",postcode= " . pq($data['postcode']) . ",phone=  ".pq($data['phone']) . ",fax= " . pq($data['fax']) . ",zone=  ".pq($data['zone'])." WHERE school_id = " . pq($data['school_id']) . "";
        $result = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
        redirect('natthapon/show_school');
    }
        
    }

    function getschool($school_id) {
        global $db;
        $school = array();
        $sql = "SELECT * FROM school WHERE school_id='$school_id'";
        $rs = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($rs);
        $school = $row;
        return $school;
      }  


	function do_validate($data) {
    $valid = true;
    $data = &$_POST;
	/*if (!preg_match('/[0-9]{10,10}/', $data['school_id'])) {
        set_err('รหัสวิชา		: ข้อมูลดาวน์โหลดต้องเป็นตัวเลข 10 ตัว');
        $valid = false;
    }*/
    if (!preg_match('/[a-zA-Z0-9_]{1,30}/', $data['password'])) {
        set_err('รหัสผ่าน		: ชื่อผู้ใช้ต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 8 ตัวอักษร');
        $valid = false;
    }
	if (empty($data['type_id'])) {
        set_err('ชื่อสถานศึกษา	: กรุณากรอกข้อมูล ประเภทสถานศึกษา');
        $valid = false;
    }
	if (empty($data['address_no'])) {
        set_err('บ้านเลขที่		: กรุณากรอกข้อมูล');
        $valid = false;
    }
	/*if (empty($data['road'])) {
        set_err('กรุณากรอกข้อมูล');
        $valid = false;
    }*/
	
	if (empty($data['tumbon'])) {
        set_err('ตำบล		: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (empty($data['aumphur'])) {
        set_err('อำเภอ		: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (empty($data['province'])) {
        set_err('จังหวัด		: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (!preg_match('/[0-9]{5,5}/', $data['postcode'])) {
        set_err('รหัสไปรษณีย์		: กรุณากรอกข้อมูลเป็นตัวเลข 5 ตัว');
        $valid = false;
    }
	if (!preg_match('/[0-9]{1,10}/', $data['phone'])) {
        set_err('เบอร์โทรศัพท์		: กรุณากรอกข้อมูลเป็นเบอร์โทรศัพท์  10 ตัว');
        $valid = false;
    }

	/*if (empty($data['zone'])) {
        set_err('ข้อมูลดาวน์โหลดต้องเป็นตัวเลข');
        $valid = false;
    }*/
	if (empty($data['zone'])) {
        set_err('ภาค		: กรุณากรอกข้อมูล');
        $valid = false;
    }
}
?>
    