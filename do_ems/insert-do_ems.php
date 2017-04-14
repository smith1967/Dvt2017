<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "เพิ่มข้อมูลสถานประกอบการ การร่วมภาครัฐและเอกชน";
$active = 'do_ems_id';
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
    if (isset($_POST['submit'])) {
        
    }
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#do_ems_id").focus();
    });
</script>
<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่มข้อมูลการลงนามความร่วมมือสถานศึกษาต้นแบบสานพลังประชารัฐ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_ems_id" class="col-md-3 control-label">รหัสการลงนาม</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="do_ems_id" name="do_ems_id">
                        </div>
                    </div>

                   <div class="form-group">
                        <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="business_id" name="business_id" placeholder="Business ID" value='<?php echo isset($business_id) ? $business_id : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_id" name="school_id" placeholder="School ID" value='<?php echo isset($school_id) ? $school_id : ''; ?>'>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="do_date" class="col-md-3 control-label">วันที่ลงนาม</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="do_date" placeholder="yyyy/mm/dd" name="do_date">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="minor_id" class="col-md-3 control-label">ชื่อสาขางานที่ลงนาม</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from minor";
                            $def = "minor_id";
                            ?>
                            <select class="form-control" id="minor_id" name="minor_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="ems_id" class="col-md-3 control-label">กลุ่มต้นแบบสานพลังประชารัฐ</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from ems_detail";
                            $def = "ems_id";
                            ?>
                            <select class="form-control" id="ems_id" name="ems_id">
                                <?php
                                echo gen_option($sql, $def);
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
<script>
   $(function() {

      $( "#business_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 1
      });
   });
</script>
<script>
   $(function() {

      $( "#school_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_school.php",
         minLength: 1
      });
   });
</script>
<?php

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['do_ems_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ การร่วมภาครัฐและเอกชน');
        $valid = false;
    }
    if (empty($data['business_id'])) {
        set_err('กรุณาเลือกสถานประกอบการ');
        $valid = false;
    }
     if (empty($data['school_id'])) {
        set_err('กรุณาเลือกสถานศึกษา');
        $valid = false;
    }
    return $valid;
}

function do_insert() {
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO do_ems ("
            . "`do_ems_id`,"
            . " `business_id`,"
            . " `school_id`,"
            . " `do_date`,"
            . " `minor_id`,"
            . " `ems_id`)"
            . " VALUES ("
            . pq($data['do_ems_id']) . ","
            . pq($data['business_id']) . ","
            . pq($data['school_id']) . ","
            . pq($data['do_date']) . ","
            . pq($data['minor_id']) . ","
            . pq($data['ems_id']) . ");";

//$query = "INSERT INTO group_config (groupname, group_desc, upload, download) VALUES (".pq($data['groupname']).", ".pq($data['group_desc']).", ".pq($data['upload']).", ".pq($data['download']).");";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('เพิ่มข้อมูลสำเร็จ');
    } else {
        set_err('ไม่สามารถเพิ่มข้อมูล ' . mysqli_error($db));
    }
    redirect('do_ems/list-do_ems');
}
