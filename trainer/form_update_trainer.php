<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "เพิ่มข้อมูลครูฝึก";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    if (!$valid) {
        
    } else {
        do_insert();
    }
}
if ($_GET['trainer_id']) {
    $trainer = get_trainer($_GET['trainer_id']);
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#trainer_id").focus();
    });
</script>
<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">เพิ่มข้อมูลครูฝึก</div>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="">
                        <div class="form-group">
                        <label for="trainer_id" class="col-md-2 control-label">รหัส</label>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" id="trainer_id" name="trainer_id"value="<?php echo $trainer['trainer_id']; ?>">
                            <?php echo $trainer['trainer_id']; ?>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="trainer_citizen" class="col-md-3 control-label">รหัสบัตรประชาชน</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="trainer_citizen" name="trainer_citizen"value="<?php set_var($trainer['trainer_citizen']); ?>">
                            </div>
                        </div>    
                        
                       <div class="form-group">
                            <label for="trainer_name" class="col-md-3 control-label">ชื่อครูฝึก</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="trainer_name" name="trainer_name"value="<?php set_var($trainer['trainer_name']); ?>">
                            </div>
                        </div>
               
                            <div class="form-group">
                            <label for="phone" class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="phone" name="phone"value="<?php set_var($trainer['phone']); ?>">
                            </div>
                        </div>
                          <div class="form-group">
                        <label for="address" class="col-md-3 control-label">ที่อยู่</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="address" rows="3" name="address"value="<?php set_var($trainer['address']); ?>">
                            <?php set_var($trainer['address']); ?>
                            </textarea>
                        </div>
                    </div>
                         <div class="form-group">
                            <label for="business_id" class="col-md-3 control-label">รหัสสถานประกอบการ</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" id="business_id" name="business_id"value="<?php set_var($trainer['business_id']); ?>">
                            </div>
                        </div>
             
            <div class="form-group">
                            <label for="educational" class="col-md-3 control-label">วุฒิการศึกษาสูงสุด</label>
                            <div class="col-md-2">
                                <select type="text" class="form-control" id="educational" name="educational"value="<?php set_var($trainer['educational']); ?>">
                                  <option value="1">ปวช.</option>
                            <option value="2">ปวส.</option>
                            <option value="3">ปริญญาตรี</option>
                            <option value="4">ปริญญาโท</option>
                            <option value="5">ปริญญาเอก</option>
                            <option value="6">อื่นๆ</option>
                                </select>
                            </div>
                        </div>

                    <div class="form-group">
                            <label for="certificate_date" class="col-md-3 control-label">วันที่ออกใบรับฝึกงาน</label>
                            <div class="col-md-2">
                                <input type="date" class="form-control" id="certificate_date" name="certificate_date"value="<?php set_var($trainer['certificate_date']); ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                        <label for="property" class="col-md-3 control-label">ข้อมูลทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class="form-control" id="property"name="property"value="<?php set_var($trainer['property']); ?>">
                                <option value="P">ผ่านการฝึกอบรม</option>
                                <option value="E">มีประสบการณ์</option>
                                <option value="N">ไม่มีประสบการณ์</option>
                            </select>
                        </div>
                    </div>
                        

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
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['trainer_id'])) {
        set_err('กรุณากรอกรหัสสครูฝึก');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z0-9_]{1,13}/', $data['trainer_citizen'])) {
        set_err('กรุณากรอกเลขบัตรประชาชน กรอกได้ 13 ตัว');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['trainer_name'])) {
        set_err('กรุณากรอกชื่อครูฝึก');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['phone'])) {
        set_err('กรุณากรอกเบอร์โทรศัพท์');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['address'])) {
        set_err('กรุณากรอกที่อยู่');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['business_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['educational'])) {
        set_err('เลือกวุฒิการศึกษา');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['certificate_date'])) {
        set_err('กรุณาเลือกวันที่ออกใบรับฝึกงาน');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['property'])) {
        set_err('กรุณาเลือคุณสมบัติของครูฝึก');
        $valid = false;
    }

    return $valid;
}

function do_insert() {
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO trainer (`trainer_id`, `trainer_citizen`, `trainer_name`, `phone`, `address`, `business_id`, `educational`, `certificate_date`, `property`) VALUES (" . pq($data['trainer_id']) . "," . pq($data['trainer_citizen']) . "," . pq($data['trainer_name']) . "," . pq($data['phone']) . "," . pq($data['address']) . "," . pq($data['business_id']) . "," . pq($data['educational']) . "," . pq($data['certificate_date']) . "," . pq($data['property']) . ")";
//    var_dump($query);
//    die();
//    $query = "INSERT INTO group_config (groupname, group_desc, upload, download) VALUES (".pq($data['groupname']).", ".pq($data['group_desc']).", ".pq($data['upload']).", ".pq($data['download']).");";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('เพิ่มข้อมูลสำเร็จ');
    } else {
        set_err('ไม่สามารถเพิ่มข้อมูล ' . mysqli_error($db));
    }
    redirect('trainer/list-trainer');
}
function get_trainer($trainer_id = NULL) {
    global $db;
    $sql = "SELECT * FROM trainer where trainer_id = '$trainer_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>
</body>
</html>
