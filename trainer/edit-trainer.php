<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลครูฝึก";
$active = 'trainer';
$subactive = 'edit';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    if ($valid) {
        do_update();
    }
}
if(!isset($_GET['trainer_id']))
    redirect('trainer/list-trainer');
    
if ($_GET['trainer_id']) {
    $trainer = get_trainer($_GET['trainer_id']);
    foreach ($trainer as $key => $value) {
        $$key = $value;
    }
//    var_dump($trainer);
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#trainer_name").focus();
    });
</script>
<div class="container">
    <?php include_once INC_PATH . 'submenu-trainer.php'; ?>
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่มข้อมูลครูฝึก</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">

                    <input type="hidden" class="form-control" id="trainer_id" name="trainer_id" value="<?php set_var($trainer_id); ?>">

                    <div class="form-group">
                        <label for="trainer_citizen" class="col-md-3 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="trainer_citizen" readonly="" name="trainer_citizen"value="<?php set_var($trainer_citizen); ?>">
                        </div>
                    </div>    

                    <div class="form-group">
                        <label for="trainer_name" class="col-md-3 control-label">ชื่อครูฝึก</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="trainer_name" name="trainer_name"value="<?php set_var($trainer_name); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-md-3 control-label">เบอร์โทรศัพท์</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="phone" name="phone"value="<?php set_var($phone); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-3 control-label">ที่อยู่</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="address" rows="3" name="address"><?php trim(set_var($address)); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_id" class="col-md-3 control-label">รหัสสถานประกอบการ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="business_id" name="business_id" placeholder="ชื่อสถานประกอบการ" value="<?php set_var($business_id); ?>">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="educational_id">วุฒิการศึกษาสูงสุด</label>
                        <div class="col-md-2">
                            <select class='form-control' id="educational_id" name="educational_id">
                                <?php
                                $def = isset($educational_id) ? $educational_id : '2';
                                $sql = "SELECT educational_id,educational_name FROM educational ORDER BY educational_id ASC";
                                echo gen_option($sql, $def)
                                ?>
                            </select>              
                        </div>
                    </div>             


                    <div class="form-group">
                        <label for="certificate_date" class="col-md-3 control-label">วันที่ออกใบรับฝึกงาน</label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="certificate_date" name="certificate_date"value="<?php set_var($certificate_date); ?>">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="trainer_property_id">ข้อมูลทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class='form-control' id="educational_id" name="trainer_property_id">
                                <?php
                                $def = isset($trainer_property_id) ? $trainer_property_id : 'E';
                                $sql = "SELECT trainer_property_id,trainer_property FROM trainer_property ORDER BY trainer_property_id ASC";
                                echo gen_option($sql, $def)
                                ?>
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
<!-- Javascript -->
<script>
   $(function() {
      $( "#business_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 1
      });
   });
</script> 
<?php

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
//    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['trainer_id'])) {
//        set_err('กรุณากรอกรหัสสครูฝึก');
//        $valid = false;
//    }
    if (!preg_match('/[a-zA-Z0-9_]{1,13}/', $data['trainer_citizen'])) {
        set_err('กรุณากรอกเลขบัตรประชาชน กรอกได้ 13 ตัว');
        $valid = false;
    }
    if (empty($data['trainer_name'])) {
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
    if (!preg_match('/[0-9]{1,}/', $data['trainer_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
//    if (!preg_match('/[0-9]{1,}/', $data['educational'])) {
//        set_err('เลือกวุฒิการศึกษา');
//        $valid = false;
//    }
//    if (!preg_match('/[0-9]{1,}/', $data['certificate_date'])) {
//        set_err('กรุณาเลือกวันที่ออกใบรับฝึกงาน');
//        $valid = false;
//    }
//    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['property'])) {
//        set_err('กรุณาเลือคุณสมบัติของครูฝึก');
//        $valid = false;
//    }

    return $valid;
}

function do_update() {
    global $db;
    $data = &$_POST;
    //print_r($data['property']);
    $arr_pro = $data['property'];
    $pro = implode(",", $arr_pro);
    //echo $pro;
    //exit();`trainer_id`, `trainer_citizen`, `trainer_name`, `phone`, `address`, `business_id`, `educational`, `certificate_date`, `property
    $query = "UPDATE trainer SET
	trainer_name=" . pq($data['trainer_name']) . ","
            . "phone=" . pq($data['phone']) . ","
            . "address=" . pq($data['address']) . ","
            . "business_id=" . pq($data['business_id']) . ","
            . "educational_id=" . pq($data['educational_id']) . ","
            . "certificate_date=" . pq($data['certificate_date']) . ","
            . "trainer_property_id=" . pq($data['trainer_property_id'])
            . " WHERE trainer_id = " . pq($data['trainer_id']);
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('trainer/list-trainer');
}

function get_trainer($trainer_id = NULL) {
    global $db;
    $sql = "SELECT * FROM trainer where trainer_id = '$trainer_id';";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
?>
</body>
</html>
