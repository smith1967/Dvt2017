<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "เพิ่มข้อมูลครูฝึก";
$active = 'trainer';
$subactive = 'insert';

if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    if ($valid) {
        do_insert();
    } else {
        foreach ($_POST as $k => $v) {
            $$k = $v;  // set variable to form
        }
    }
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#trainer_citizen").focus();
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

<!--                    <div class="form-group">
                        <label for="trainer_id" class="col-md-3 control-label">รหัสครูฝึก</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="trainer_id" name="trainer_id"value="<?php set_var($trainer_id); ?>">
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label for="trainer_citizen" class="col-md-3 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="trainer_citizen" name="trainer_citizen"value="<?php set_var($trainer_citizen); ?>">
                        </div>
                    </div>    

                    <div class="form-group">
                        <label for="trainer_name" class="col-md-3 control-label">ชื่อครูฝึก</label>
                        <div class="col-md-4">
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
                            <textarea class="form-control" id="address" rows="3" name="address" ><?php set_var($address); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="business_id" class="col-md-3 control-label">รหัสสถานประกอบการ</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="business_id" name="business_id" placeholder="ชื่อสถานประกอบการ" value="<?php set_var($business_id); ?>">
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
                        <label for="trainer_major" class="col-md-3 control-label">สาขาวิชา/วุฒิการศึกษา</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="trainer_major" name="trainer_major" placeholder="สาขาวิชา/วุฒิการศึกษา" value="<?php set_var($trainer_major); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="assign_date" class="col-md-3 control-label">วันที่ได้รับการแต่งตั้งเป็นครูฝึก</label>
                        <div class="col-md-2">
                            <input type="date" class="form-control" id="assign_date" name="assign_date"value="<?php set_var($assign_date); ?>">
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="trainer_property_id">ประสบการณ์การเป็นครูฝึก</label>
                        <div class="col-md-2">
                            <select class='form-control' id="trainer_property_id" name="trainer_property_id">
                                <?php
                                $def = isset($trainer_property_id) ? $trainer_property_id : 'E';
                                $sql = "SELECT trainer_property_id,trainer_property FROM trainer_property ORDER BY trainer_property_id ASC";
                                echo gen_option($sql, $def)
                                ?>
                            </select>              
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="certificate">ผ่านการฝึกอบรมเป็นครูฝึก</label>
                        <div class="col-md-2">
                            <select class='form-control' id="certificate" name="certificate">
                                <option value="P">ผ่าน</option>
                                 <option value="N">ไม่ผ่าน</option>
                            </select>              
                        </div>
                    </div>

<!--                    <div class="form-group">
                        <label for="property" class="col-md-3 control-label">ข้อมูลทำความร่วมมือจัดอาชีวศึกษา</label>
                        <div class="col-md-2">
                            <select class="form-control" id="property"name="property"value="<?php set_var($property); ?>">
                                <option value="P">ผ่านการฝึกอบรม</option>
                                <option value="E">มีประสบการณ์</option>
                                <option value="N">ไม่มีประสบการณ์</option>
                            </select>
                        </div>
                    </div>-->


                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-8">
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
//        set_err('กรุณากรอกรหัสครูฝึก');
//        $valid = false;
//    }
    if (check_pid($data['trainer_citizen'])) {
        set_err('กรุณากรอกเลขบัตรประชาชน');
        $valid = false;
    }
    if (empty($data['trainer_name'])) {
        set_err('กรุณากรอกชื่อครูฝึก');
        $valid = false;
    }
    if (!preg_match('/[0-9-]{1,}/', $data['phone'])) {
        set_err('กรุณากรอกเบอร์โทรศัพท์');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['address'])) {
        set_err('กรุณากรอกที่อยู่');
        $valid = false;
    }
    if (empty($data['business_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
    if (empty($data['trainer_major'])) {
        set_err('กรุณากรอกสาขาวิชา/วุฒิการศึกษา');
        $valid = false;
    }

    if (!preg_match('/[0-9]{1,}/', $data['assign_date'])) {
        set_err('กรุณาเลือกวันที่ออกใบรับฝึกงาน');
        $valid = false;
    }
    return $valid;
}

function do_insert() {
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO trainer (`trainer_id`, `trainer_citizen`, `trainer_name`, `phone`, `address`, `business_id`, `educational_id`, `trainer_major`,`assign_date`, `trainer_property_id`,certificate) VALUES (NULL," . pq($data['trainer_citizen']) . "," . pq($data['trainer_name']) . "," . pq($data['phone']) . "," . pq($data['address']) . "," . pq($data['business_id']) . "," . pq($data['educational_id']) . "," . pq($data['trainer_major']) . "," . pq($data['assign_date']) . "," . pq($data['trainer_property_id']) .",". pq($data['certificate']) . ")";
//    var_dump($query);
//    die();
//    $query = "INSERT INTO group_config (groupname, group_desc, upload, download) VALUES (".pq($data['groupname']).", ".pq($data['group_desc']).", ".pq($data['upload']).", ".pq($data['download']).");";
   // echo $query;  exit();
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('เพิ่มข้อมูลสำเร็จ');
    } else {
        set_err('ไม่สามารถเพิ่มข้อมูล ' . mysqli_error($db));
    }
    redirect('trainer/list-trainer');
}
?>
