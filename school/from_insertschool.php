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
   $valid = TRUE;
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
                    <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="school_id" name="school_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="password">รหัสผ่าน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="password" name="password"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="name">ชื่อสถานศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="name"name="name"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="type_id">ประเภทสถานศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="type_id"name="type_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="address_no">เลขที่ตั้ง</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="address_no"name="address_no"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="road">ถนน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="road"name="road"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="tumbon">ตำบล</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="tumbon"name="tumbon"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="aumphur">อำเภอ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="aumphur"name="aumphur"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="province">จังหวัด</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="province"name="province"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="postcode">รหัสไปรษณีย์</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="postcode"name="postcode"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="phone">เบอร์โทรศัพท์</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="phone"name="phone"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="fax">เบอร์ Fax</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="fax"name="fax"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="zone">ภาค</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="zone"name="zone"></div>
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
function do_insert(){
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO school (`school_id`,`password`,`name`,`type_id`,`address_no`,`road`,`tumbon`,`aumphur`,`province`,`postcode`,`phone`,`fax`,`zone`)  VALUES (".pq($data['school_id']).",".pq($data['password']).",".pq($data['name']).",".pq($data['type_id']).",".pq($data['address_no']).",".pq($data['road']).",".pq($data['tumbon']).",".pq($data['aumphur']).",".pq($data['province']).",".pq($data['postcode']).",".pq($data['phone']).",".pq($data['fax']).",".pq($data['zone']).")";
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db)>0){
        set_info('บันทึกข้อมูลเรียบร้อย');
        redirect('natthapon/show_school');
    }  else {
        set_err('บันทึกข้อมูลไม่สำเร็จ '. mysqli_error($db));
        
    }
}
function do_validate($data) {
    $valid = true;
    $data = &$_POST;
	if (!preg_match('/[0-9]{1,10}/', $data['school_id'])) {
        set_err('รหัสวิชา: ข้อมูลดาวน์โหลดต้องเป็นตัวเลข 10 ตัว');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z0-9_]{1,30}/', $data['password'])) {
        set_err('รหัสผ่าน:กรุณากรอกPassword');
        $valid = false;
    }
	if (empty($data['name'])) {
        set_err('ชื่อสถานศึกษา: กรุณากรอกข้อมูล ประเภทสถานศึกษา');
        $valid = false;
    }
	if (empty($data['type_id'])) {
        set_err('ประเภทสถานศึกษา:กรุณากรอกข้อมูล ประเภทสถานศึกษา');
        $valid = false;
    }
	if (empty($data['address_no'])) {
        set_err('บ้านเลขที่: กรุณากรอกข้อมูล');
        $valid = false;
    }
	/*if (empty($data['road'])) {
        set_err('กรุณากรอกข้อมูล');
        $valid = false;
    }*/
	
	if (empty($data['tumbon'])) {
        set_err('ตำบล	: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (empty($data['aumphur'])) {
        set_err('อำเภอ: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (empty($data['province'])) {
        set_err('จังหวัด: กรุณากรอกข้อมูล');
        $valid = false;
    }
	if (!preg_match('/[0-9]{5,5}/', $data['postcode'])) {
        set_err('รหัสไปรษณีย์:กรุณากรอกรหัสไปรษณีย์ ตัวเลข 5 ตัว');
        $valid = false;
    }
	if (!preg_match('/[0-9]{1,10}/', $data['phone'])) {
        set_err('เบอร์โทรศัพท์		: กรุณากรอกข้อมูลเป็นเบอร์โทรศัพท์  10 ตัว');
        $valid = false;
    }

	/*if (empty($data['zone'])) {
        set_err('กรุณากรอก Zone');
        $valid = false;
    }*/
	if (empty($data['zone'])) {
        set_err('ภาค	: กรุณากรอกข้อมูล');
        $valid = false;
    }
}
?>