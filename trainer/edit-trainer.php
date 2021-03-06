<?php
//แก้ไข DB
//ALTER TABLE `trainer` ADD `trainer_major` VARCHAR(100) NOT NULL AFTER `educational_id`;
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
    if(!empty($business_id)){
        $data = get_business_name($business_id);
        $business_name = $data['business_name'];
//        var_dump($business_name);
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
            <div class="panel-heading">แก้ไขข้อมูลครูฝึก</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">

                    <input type="hidden" class="form-control" id="trainer_id" name="trainer_id" value="<?php set_var($trainer_id); ?>">

                    <div class="form-group">
                        <label for="trainer_citizen" class="col-md-3 control-label">เลขประจำตัวประชาชน</label>
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
                    <input type="hidden" class="form-control" id="business_id" name="business_id" placeholder="ชื่อสถานประกอบการ" value="<?php set_var($business_id); ?>">
                    <div class="form-group">
                        <label for="business_name" class="col-md-3 control-label">ชื่อสถานประกอบการ</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="business_name" name="business_name" placeholder="ชื่อสถานประกอบการ" value="<?php set_var($business_name); ?>">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="educational_id">ระดับการศึกษาสูงสุด</label>
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
                        <label for="trainer_experience" class="col-md-4 control-label">ประสบการณ์ในอาชีพที่สำเร็จการศึกษา จำนวน</label>
                        <div class="col-md-4">
                            <select class='form-control' id="trainer_experience" name="trainer_experience" >
                                <?php
                                $def = isset($trainer_experience) ? $trainer_experience : 'ต่ำกว่า 3 ปี';
                                //$sql = "SELECT trainer_property_id,trainer_property FROM trainer_property ORDER BY trainer_property_id ASC";
                                $exper_data = array('ต่ำกว่า 3 ปี'=>'ต่ำกว่า 3 ปี', 
                                                '3 ปี'=>'3 ปี','5 ปี'=>'5 ปี','มากกว่า 5 ปี'=>'มากกว่า 5 ปี');
                                echo gen_option($exper_data, $def)
                                ?>
                            </select>
                        </div>
                    </div>           


                    <div class="form-group">
                        <label for="assign_date" class="col-md-3 control-label">วันที่ได้รับการแต่งตั้งเป็นครูฝึก</label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="assign_date" name="assign_date"value="<?php set_var($assign_date); ?>">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="trainer_method_assign">ได้รับการแต่งตั้งเป็นครูฝึก ด้วยวิธี</label>
                        <div class="col-md-4">
                            <select class='form-control' id="trainer_method_assign" name="trainer_method_assign">
                                <?php
                                $def = isset($trainer_method_assign) ? $trainer_method_assign : 'ผ่านการฝึกอบรม';
                                //$sql = "SELECT trainer_property_id,trainer_property FROM trainer_property ORDER BY trainer_property_id ASC";
                                $assign_data = array('ผ่านการฝึกอบรม'=>'ผ่านการฝึกอบรม', 
                                                'มีประสบการณืการสอนมากกว่า 6 เดือน'=>'มีประสบการณืการสอนมากกว่า 6 เดือน');
                                echo gen_option($assign_data, $def);
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
      $( "#business_name" ).autocomplete({
         minLength: 2, 
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         select: function (event, ui) {
            $("#business_name").val(ui.item.label); // display the selected text
            $("#business_id").val(ui.item.value); // save selected id to hidden input
            return false;
        }         
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
        set_err('กรุณากรอกชื่อสถานประกอบการ');
        $valid = false;
    }
   
    if (!preg_match('/[0-9]{1,}/', $data['assign_date'])) {
        set_err('กรุณาเลือกวันที่แต่งตั้งเป็นครูฝึก');
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
            . "trainer_experience=" . pq($data['trainer_experience']) . ","
            . "assign_date=" . pq($data['assign_date']) . ","
            . "trainer_method_assign=" . pq($data['trainer_method_assign'])." "
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
    $sql = "SELECT t.* "
            . "FROM trainer as t "
            . "WHERE "
            . "t.trainer_id = '$trainer_id';";
//    var_dump($sql);
//    exit();
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
function get_business_name($business_id) {
    global $db;
    $sql = "SELECT business_name "
            . "FROM business "
            . "WHERE "
            . "business_id = '$business_id';";
//    var_dump($sql);
//    exit();
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
?>


</body>
</html>
