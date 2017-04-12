<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "เพิ่มข้อมูลสถานประกอบการ";
$active = 'business';
$property = array();
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
//    var_dump($property);
    if (!$valid) {
    foreach ($_POST as $k => $v) {
        $$k = $v;
    }        
    } else {
        do_insert();
    }
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#business_id").focus();
    });
</script>
<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่มข้อมูลสถานประกอบการ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="business_id" class="col-md-2 control-label">รหัส</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="business_id" name="business_id"value="<?php set_var($business_id); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_name" class="col-md-2 control-label">ชื่อสถานประกอบการ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="business_name"name="business_name"value="<?php set_var($business_name); ?>">
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
                            <textarea class="form-control" id="job_description" rows="3" name="job_description"value="<?php set_var($job_description); ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-2 control-label">ที่ตั้ง</label>
                    </div>

                    <div class="form-group">
                        <label for="address_no" class="col-md-3 control-label">เลขที่</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="address_no" name="address_no"value="<?php set_var($address_no); ?>">
                        </div>
                        <label for="road" class="col-md-2 control-label">ถนน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="road" name="road"value="<?php set_var($road); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tumbon" class="col-md-3 control-label">ตำบล</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="tumbon"name="tumbon"value="<?php set_var($tumbon); ?>">
                        </div>
                        <label for="aumphur" class="col-md-2 control-label">อำเภอ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="aumphur" name="aumphur"value="<?php set_var($aumphur); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="province" class="col-md-3 control-label">จังหวัด</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="province"name="province"value="<?php set_var($province); ?>">
                        </div>
                        <label for="postcode" class="col-md-2 control-label">รหัสไปรษณีย์</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="postcode" name="postcode"value="<?php set_var($postcode); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="land" class="col-md-3 control-label">ประเทศ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="land" placeholder="ประเทศไทย" name="land" value="ประเทศไทย">
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


                    <div class="form-group">
                        <label for="mou" class="col-md-3 control-label">ข้อมูลทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class="form-control" id="mou"name="mou"value="<?php set_var($mou); ?>">
                                <option value="0">ไม่เคยจัด</option>
                                <option value="1">เคยร่วมจัด</option>
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

                    <div class="form-group">
                        <label for="tax_break" class="col-md-2 control-label">การลดหย่อนภาษี</label>
                        <div class="col-md-2">
                            <select class="form-control" id="tax_break"name="tax_break"value="<?php set_var($tax_break); ?>">
                                <option>ใช้สิทธิ์</option>
                                <option>กำลังดำเนินการ</option>
                                <option>ไม่ใช้สิทธิ์</option>
                            </select>
                        </div>
                    </div>   
                    <div class="form-group">
                        <label for="tax_break" class="col-md-5 control-label"><u>คำชี้แจง</u>กรุณาคลิกในช่องที่ตรงกับคุณลักษณะของสถานประกอบการ</label>

                    </div> 

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

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-sm-primary" name="submit">บันทึกข้อมูล</button>
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
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['business_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['business_name'])) {
        set_err('กรุณากรอกชื่อสถานประกอบการ');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['address_no'])) {
        set_err('กรุณากรอกเลขที่');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['tumbon'])) {
        set_err('กรุณากรอกตำบล');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['aumphur'])) {
        set_err('กรุณากรอกอำเภอ');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['province'])) {
        set_err('กรุณากรอกจังหวัด');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['postcode'])) {
        set_err('กรุณากรอกรหัสไปรษณีย์');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['contact'])) {
        set_err('กรุณากรอกชื่อผู้ประสานงาน');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['contact_phone'])) {
        set_err('กรุณากรอกเบอร์โทรศัพท์');
        $valid = false;
    }

    return $valid;
}

function do_insert() {
    global $db;
    $data = &$_POST;
    //print_r($data['property']);
    $arr_pro = $data['property'];
    $pro = implode(",", $arr_pro);
    //echo $pro;
    //exit();
    $query = "INSERT INTO business ("
            . "`business_id`,"
            . " `business_name`,"
            . " `Job_description`,"
            . " `amount_emp`,"
            . " `address_no`,"
            . " `road`,"
            . " `tumbon`,"
            . " `aumphur`,"
            . " `province`,"
            . " `postcode`,"
            . " `land`,"
            . " `email`,"
            . " `contact`,"
            . " `contact_phone`,"
            . " `mou`,"
            . " `registration_date`,"
            . " `capital`,"
            . " `country`,"
            . " `tax_break`,"
            . " `property_id`) "
            . " VALUES ("
            . pq($data['business_id']) . ","
            . pq($data['business_name']) . ","
            . pq($data['job_description']) . ","
            . pq($data['amount_emp']) . ","
            . pq($data['address_no']) . ","
            . pq($data['road']) . ","
            . pq($data['tumbon']) . ","
            . pq($data['aumphur']) . ","
            . pq($data['province']) . ","
            . pq($data['postcode']) . ","
            . pq($data['land']) . ","
            . pq($data['email']) . ","
            . pq($data['contact']) . ","
            . pq($data['contact_phone']) . ","
            . pq($data['mou']) . ","
            . pq($data['registration_date']) . ","
            . pq($data['capital']) . ","
            . pq($data['country']) . ","
            . pq($data['tax_break']) . ","
            . "'$pro') ";
//    var_dump($query);
//    die();
//    $query = "INSERT INTO group_config (groupname, group_desc, upload, download) VALUES (".pq($data['groupname']).", ".pq($data['group_desc']).", ".pq($data['upload']).", ".pq($data['download']).");";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('เพิ่มข้อมูลสำเร็จ');
    } else {
        set_err('ไม่สามารถเพิ่มข้อมูล ' . mysqli_error($db));
    }
    redirect('business/list-business');
}
