<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน";
$active = 'do_business_vg';
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
        do_editdoems();
    }
}
if(!isset($_GET['do_ems_id']))
    redirect('do_ems/list-do_ems');
if ($_GET['do_ems_id']) {
    $doems = get_doems($_GET['do_ems_id']);
    foreach ($doems as $key => $value) {
        $$key = $value;
    }
    // var_dump($DoBusinessVg);
    // exit();
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
            <div class="panel-heading">แก้ไขข้อมูลการลงนามความร่วมมือสถานศึกษาต้นแบบสานพลังประชารัฐ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_ems_id" class="col-md-3 control-label">รหัสการลงนาม</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" readonly="" id="do_ems_id" name="do_ems_id"value="<?php set_var($do_ems_id); ?>">                           
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="business_id" name="business_id" placeholder="Business ID" value="<?php set_var($business_id); ?>">
                        </div>
                    </div>
                      <div class="form-group">
                        <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_id" name="school_id" placeholder="School ID" value="<?php set_var($school_id); ?>">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label for="do_date" class="col-md-3 control-label">วันที่ลงนาม</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date"name="do_date"value="<?php set_var($do_date); ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="minor_id" class="col-md-3 control-label">ชื่อสาขางานที่ลงนาม</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from minor";                        
                            ?>
                            <select class="form-control" id="minor_id" name="minor_id">
                                <?php
                                echo gen_option($sql, $minor_id);
                                ?>
                            </select>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="ems_id" class="col-md-3 control-label">ชื่อสาขาวิชาที่ลงนาม</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from ems_detail";
                            $def = $doems['ems_id'];
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
                            <button type="submit" class="btn btn-sm btn-primary" name ="submit" >บันทึกข้อมูล</button>
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
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['school_id'])) {
        set_err('กรุณาเลือกสถานศึกษา');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['business_id'])) {
        set_err('กรุณาเลือกสถานประกอบการ');
        $valid = false;
    }
    return $valid;
}

function do_editdoems() {
    global $db;
    $data = &$_POST;
    $query = "update do_ems set
	business_id=" . pq($data['business_id']) . ","
            . "school_id=" . pq($data['school_id']) . ","
            . "do_date=" . pq($data['do_date']) . ","
            . "minor_id=" . pq($data['minor_id']) . ","
            . "ems_id=" . pq($data['ems_id']) . "
where do_ems_id = " . pq($data['do_ems_id']). ";";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('do_ems/list-do_ems');
}

function get_doems($do_ems_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_ems where do_ems_id = '$do_ems_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>