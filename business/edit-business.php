<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานประกอบการ";
$active = 'business';
$subactive = 'edit';
$property = array();
$benefit = array();

if (isset($_POST['submit'])) {
    $data = $_POST;
    var_dump($data);
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
//    $property = $business['property'];
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล

    if ($valid) {
        do_editbusiness();
    }
}else if ($_GET['business_id']) {
    $property = array();
    $business = get_business($_GET['business_id']);
    $property = explode(',', $business['property_id']);
    $benefit = explode(',', $business['benefit_id']);
    foreach ($business as $key => $value) {
        $$key = $value;
    }

//    var_dump($business);
//    exit();
}  else {
    redirect('business/list-business');
}
require_once INC_PATH . 'header.php';
?>

<div class="container">
     <?php include_once INC_PATH . 'submenu-business.php'; ?>
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">แก้ไขข้อมูลสถานประกอบการ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="business_id" class="col-md-2 control-label">รหัส</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="business_id" readonly="" name="business_id"value="<?php set_var($business_id); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_name" class="col-md-2 control-label">ชื่อสถานประกอบการ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="business_name"name="business_name"value="<?php set_var($business_name); ?>">
                        </div>
                    </div>
                    <?php 
                        $business_opt = array('ไม่ระบุ'=>'ไม่ระบุ', 'เล็ก'=>'เล็ก', 'กลาง'=>'กลาง', 'ใหญ่'=>'ใหญ่');
                    ?>
                    <div class="form-group">
                        <label for="business_size" class="col-md-2 control-label">ขนาดสถานประกอบการ</label>
                        <div class="col-md-2">
                            <select class="form-control" id="do_mou" name="business_size">
                                <?php echo gen_option($business_opt, $business_size) ?>
                            </select>
                        </div>
                    </div>    
                    
                    <div class="form-group">
                        <label for="amount_emp" class="col-md-2 control-label">จำนวนพนักงาน</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="amount_emp" name="amount_emp"value="<?php set_var($amount_emp); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job_description" class="col-md-2 control-label">รายละเอียด</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="job_description" rows="3" name="job_description"><?php set_var($job_description); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2 control-label">ที่ตั้ง</label>
                    </div>

                    <div class="form-group">
                        <label for="address_no" class="col-md-2 control-label">เลขที่</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="address_no" name="address_no"value="<?php set_var($address_no); ?>">
                        </div>
                        <label for="road" class="col-md-2 control-label">ถนน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="road" name="road"value="<?php set_var($road); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tumbon" class="col-md-2 control-label">ตำบล</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="tumbon"name="tumbon"value="<?php set_var($tumbon); ?>">
                        </div>
                        <label for="aumphur" class="col-md-2 control-label">อำเภอ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="aumphur" name="aumphur"value="<?php set_var($aumphur); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="province" class="col-md-2 control-label">จังหวัด</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="province"name="province"value="<?php set_var($province); ?>">
                        </div>
                        <label for="postcode" class="col-md-2 control-label">รหัสไปรษณีย์</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="postcode" name="postcode"value="<?php set_var($postcode); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="land" class="col-md-2 control-label">ประเทศ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="land" placeholder="ประเทศไทย" name="land" value="ประเทศไทย">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="capital" class="col-md-2 control-label">พิกัดแผนที่</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" placeholder="หาจาก google maps" id="capital" name="capital" value="<?php set_var($locattion); ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">E-mail</label>
                        <div class="col-md-3">
                            <input type="email" class="form-control" id="email" placeholder="Kidakarn@gmail.com"name="email"value="<?php set_var($email); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-md-2 control-label">ชื่อผู้ประสานงาน</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="contact"name="contact"value="<?php set_var($contact); ?>">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="contact_phone" class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="xxx-xxx-xxxx"value="<?php set_var($contact_phone); ?>">
                        </div>
                    </div> 

                    <?php 
                        $do_mou_opt = array('N'=>'ไม่เคยทำ', 'Y'=>'เคยร่วมจัดทำ');
                    ?>
                    <div class="form-group">
                        <label for="do_mou" class="col-md-2 control-label">ทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class="form-control" id="do_mou" name="do_mou">
                                <?php echo gen_option($do_mou_opt, $do_mou) ?>
                            </select>
                        </div>
                    </div>                       

                    <div class="form-group">
                        <label for="registration_date" class="col-md-2 control-label">วันที่จดทะเบียน</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date" placeholder="yyyy/mm/dd" name="registration_date"value="<?php set_var($registration_date); ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="capital" class="col-md-2 control-label">ทุนการจดทะเบียน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="capital"name="capital"value="<?php set_var($capital); ?>">
                        </div>
                    </div>       
                    <div class="form-group">
                        <label for="country" class="col-md-2 control-label">ประเทศต้นสังกัด</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="country" name="country"value="<?php set_var($country); ?>">
                        </div>
                    </div>  
                    <?php $tax_break_opt = array('ใช้สิทธิ์'=>'ใช้สิทธิ์', 'กำลังดำเนินการ'=>'กำลังดำเนินการ', 'ไม่ใช้สิทธิ์'=>'ไม่ใช้สิทธิ์') ?>
                    <div class="form-group">
                        <label for="tax_break" class="col-md-2 control-label">การลดหย่อนภาษี</label>
                        <div class="col-md-2">
                            <select class="form-control" id="tax_break"name="tax_break">
                                <?php echo gen_option($tax_break_opt, $tax_break)?>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="tax_break" class="control-label col-md-offset-1"><u>คำชี้แจง</u>กรุณาคลิกในช่องที่ตรงกับคุณลักษณะของสถานประกอบการ</label>
                    <?php
                    $sql = "select * from business_property order by property_id ASC";
                    $result = mysqli_query($db, $sql);
                    while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                        <div class="checkbox">
                            <label class="col-md-offset-2">
                                <input type="checkbox" 
                                       name="property[]" 
                                       value="<?php echo $rs['property_id'] ?>"
                                       <?php echo in_array($rs['property_id'], $property) ? "checked=checked" : "" ?>
                                       >
                                       <?php echo $rs['descript'] ?>
                            </label>
                        </div>           
                    <?php } ?>
                    </div> 
                    <div class="form-group">
                        <label for="benefit" class="control-label col-md-offset-1"><u>คำชี้แจง</u>กรุณาคลิกในช่องที่ตรงกับสวัสดิการของสถานประกอบการ</label>

                    <?php
                    $sql = "select * from business_benefit order by benefit_id ASC";
                    $result = mysqli_query($db, $sql);
                    while ($rs = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                        <div class="checkbox">
                            <label class="col-md-offset-2">
                                <input type="checkbox" 
                                       name="benefit[]" 
                                       value="<?php echo $rs['benefit_id'] ?>"
                                       <?php echo in_array($rs['benefit_id'], $benefit) ? "checked=checked" : "" ?>
                                       >
                                       <?php echo $rs['name'] ?>
                            </label>
                        </div>           
                    <?php } ?>
                    </div>                     
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (empty($data['business_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
    if (empty($data['business_name'])) {
        set_err('กรุณากรอกชื่อสถานประกอบการ');
        $valid = false;
    }
    if (empty($data['address_no'])) {
        set_err('กรุณากรอกเลขที่');
        $valid = false;
    }
    if (empty($data['tumbon'])) {
        set_err('กรุณากรอกตำบล');
        $valid = false;
    }
    if (empty($data['aumphur'])) {
        set_err('กรุณากรอกอำเภอ');
        $valid = false;
    }
    if (empty($data['province'])) {
        set_err('กรุณากรอกจังหวัด');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['postcode'])) {
        set_err('กรุณากรอกรหัสไปรษณีย์');
        $valid = false;
    }
    if (empty($data['contact'])) {
        set_err('กรุณากรอกชื่อผู้ประสานงาน');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['contact_phone'])) {
        set_err('กรุณากรอกเบอร์โทรศัพท์');
        $valid = false;
    }

    return $valid;
}

function do_editbusiness() {
    global $db;
    $data = &$_POST;
    //print_r($data['property']);
//    $arr_pro = $data['property'];
//    $pro = implode(",", $arr_pro);
    //echo $pro;
    //exit();
    $query = "update business  set
	business_name=" . pq($data['business_name']) . ","
            . "job_description=" . pq($data['job_description']) . ","
            . "amount_emp=" . pq($data['amount_emp']) . ","
            . "address_no=" . pq($data['address_no']) . ","
            . "road=" . pq($data['road']) . ","
            . "tumbon=" . pq($data['tumbon']) . ","
            . "aumphur=" . pq($data['aumphur']) . ","
            . "province=" . pq($data['province']) . ","
            . "postcode=" . pq($data['postcode']) . ","
            . "land=" . pq($data['land']) . ","
            . "location=" . pq($data['location']) . ","
            . "email=" . pq($data['email']) . ","
            . "contact=" . pq($data['contact']) . ","
            . "contact_phone=" . pq($data['contact_phone']) . ","
            . "do_mou=" . pq($data['do_mou']) . ","
            . "registration_date=" . pq($data['registration_date']) . ","
            . "capital=" . pq($data['capital']) . ","
            . "country=" . pq($data['country']) . ","
            . "tax_break=" . pq($data['tax_break']) . ","
            . "benefit_id=" . pq(implode(",",$data['benefit'])) . ","
            . "property_id=" . pq(implode(",",$data['property']))
            . " WHERE "
            . "business_id = " . pq($data['business_id']) . "";
//    echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('แก้ไขข้อมูลสำเร็จ'); 
    } else {
       set_err('ไม่สามารถแก้ไขข้อมูล');
    }
    redirect('business/list-business');
}

function get_business($business_id = NULL) {
    global $db;
    $sql = "SELECT * FROM business where business_id = '$business_id';";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>