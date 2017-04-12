<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานะต่าง ๆ";
$active = 'business';
//$subactive = 'edit-group-config';
if ($_GET['business_id']) {
    $property = array();
    $business = get_business($_GET['business_id']);
    $property = explode(',', $business['property_id']);
//    var_dump($business);
//    exit();
}
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
//    exit();
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    if ($valid) {
        do_editbusiness();
    }
}
require_once INC_PATH . 'header.php';
?>

<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">แก้ไขข้อมูลสถานประกอบการ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="business_id" class="col-md-2 control-label">รหัส</label>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" id="business_id" name="business_id"value="<?php echo $business['business_id']; ?>">
                            <?php echo $business['business_id']; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_name" class="col-md-2 control-label">ชื่อสถานประกอบการ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="business_name"name="business_name"value=" <?php set_var($business['business_name']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount_emp" class="col-md-2 control-label">จำนวนพนักงาน</label>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="amount_emp" name="amount_emp"value=" <?php set_var($business['amount_emp']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Job_description" class="col-md-2 control-label">รายละเอียด</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="Job_description" rows="3" name="Job_description">
                                <?php set_var($business['Job_description']); ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address"class="col-md-2 control-label">ที่ตั้ง</label>
                    </div>

                    <div class="form-group">
                        <label for="address_no" class="col-md-3 control-label">เลขที่</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="address_no" name="address_no" value="<?php set_var($business['address_no']); ?>">
                        </div>
                        <label for="road" class="col-md-2 control-label">ถนน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="road"name="road" value="<?php set_var($business['road']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tumbon" class="col-md-3 control-label">ตำบล</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="tumbon" name="tumbon"value="<?php set_var($business['tumbon']); ?>">
                        </div>
                        <label for="aumphur" class="col-md-2 control-label">อำเภอ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="aumphur" name="aumphur"value="<?php set_var($business['aumphur']); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="province" class="col-md-3 control-label">จังหวัด</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="province"name="province"value="<?php set_var($business['province']); ?>">
                        </div>
                        <label for="postcode" class="col-md-2 control-label">รหัสไปรษณีย์</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="postcode" name="postcode" value="<?php set_var($business['postcode']); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="land" class="col-md-3 control-label">ประเทศ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="land"name="land" value="<?php set_var($business['land']); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">E-mail</label>
                        <div class="col-md-3">
                            <input type="email" class="form-control" id="email" name="email" value="<?php set_var($business['email']); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-md-2 control-label">ชื่อผู้ประสานงาน</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="contact"name="contact"value="<?php set_var($business['contact']); ?>">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="contact_phone" class="col-md-2 control-label">เบอร์โทรศัพท์</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone"value="<?php set_var($business['contact_phone']); ?>">
                        </div>
                    </div> 


                    <div class="form-group">
                        <label for="mou" class="col-md-3 control-label">ข้อมูลทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class="form-control" id="mou" name="mou"value="<?php set_var($business['mou']); ?>">
                                <option value="0">ไม่เคยจัด</option>
                                <option value="1">เคยร่วมจัด</option>
                            </select>
                        </div>
                    </div>                       

                    <div class="form-group">
                        <label for="registration_date" class="col-md-2 control-label">วันที่จดทะเบียน</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date"name="registration_date"value="<?php set_var($business['registration_date']); ?>">
                        </div>
                    </div> 


                    <div class="form-group">
                        <label for="capital" class="col-md-2 control-label">ทุนการจดทะเบียน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="capital" name="capital"value="<?php set_var($business['capital']); ?>">
                        </div>
                    </div>       



                    <div class="form-group">
                        <label for="country" class="col-md-2 control-label">ประเทศต้นสังกัด</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="country" name="country" value="<?php set_var($business['country']); ?>">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="tax_break" class="col-md-2 control-label">การลดหย่อนภาษี</label>
                        <div class="col-md-2">
                            <select class="form-control" id="tax_break" name="tax_break"value="<?php set_var($business['tax_break']); ?>">
                                <option>ใช้สิทธิ์</option>
                                <option>กำลังดำเนินการ</option>
                                <option>ไม่ใช้สิทธิ์</option>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">

                        <label for="tax_break" class="col-md-6 control-label"><u>คำชี้แจง</u>กรุณาคลิกในช่องที่ตรงกับคุณลักษณะของสถานประกอบการ</label>

                    </div> 

                    <?php
//                    var_dump($property);
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
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-sm btn-primary" name ="submit" >บันทึกข้อมูล</button>
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
    $arr_pro = $data['property'];
    $pro = implode(",", $arr_pro);
    //echo $pro;
    //exit();
    $query = "update business  set
	business_name=" . pq($data['business_name']) . ","
            . "Job_description=" . pq($data['Job_description']) . ","
            . "amount_emp=" . pq($data['amount_emp']) . ","
            . "address_no=" . pq($data['address_no']) . ","
            . "road=" . pq($data['road']) . ","
            . "tumbon=" . pq($data['tumbon']) . ","
            . "aumphur=" . pq($data['aumphur']) . ","
            . "province=" . pq($data['province']) . ","
            . "postcode=" . pq($data['postcode']) . ","
            . "land=" . pq($data['land']) . ","
            . "email=" . pq($data['email']) . ","
            . "contact=" . pq($data['contact']) . ","
            . "contact_phone=" . pq($data['contact_phone']) . ","
            . "mou=" . pq($data['mou']) . ","
            . "registration_date=" . pq($data['registration_date']) . ","
            . "capital=" . pq($data['capital']) . ","
            . "country=" . pq($data['country']) . ","
            . "tax_break=" . pq($data['tax_break']) . ","
            . "property_id='" . $pro . "'
    where business_id = '" . $data['business_id'] . "'";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('business/list-business');
}

function get_business($business_id = NULL) {
    global $db;
    $sql = "SELECT * FROM business where business_id = '$business_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>