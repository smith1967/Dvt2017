<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลการฝึกงาน";
$active = 'training';
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
if(!isset($_GET['training_id']))
    redirect('training/list-training');
if ($_GET['training_id']) {
    $training = get_training($_GET['training_id']);
    foreach ($training as $key => $value) {
        $$key = $value;
    }
//    var_dump($training);
}
require_once INC_PATH . 'header.php';
?>
<div class='container'>
    <?php include_once INC_PATH . 'submenu-training.php'; ?>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
<!--                <div class="form-group"> 
                    <label class="control-label col-md-3" for="training_id">รหัสการฝึกอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="training_id" name="training_id"></div>
                </div>-->
                 <input type="hidden" class="form-control" id="training_id" name="training_id" value="<?php set_var($training_id)?>">
                <input type="hidden" class="form-control" id="citizen_id" name="citizen_id" value="<?php set_var($citizen_id)?>">
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="std_name">ชื่อนักศึกษา</label>
                    <div class="col-md-3 ">
                        <input type="text" class="form-control" id="std_name" placeholder="ชื่อนักศึกษา" name="std_name" value="<?php set_var($std_name)?>">
                    </div>
                </div>
                <input type="hidden" class="form-control" id="business_id"  name="business_id" value="<?php set_var($business_id)?>">
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="business_name">รหัสสถานประกอบการ</label>
                    <div class="col-md-3 ">
                        <input type="text" class="form-control" id="business_name" placeholder="ชื่อสถานประกอบการ" name="business_name" value="<?php set_var($business_name)?>">
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                    <div class="col-md-3 ">
                    <input type="text" class="form-control" readonly="" id="school_id" placeholder="ชื่อสถานศึกษา" name="school_id" value="<?php set_var($school_id)?>">
                    </div>
                </div>
                    <input type="hidden" class="form-control" id="minor_id" name="minor_id" value="<?php set_var($minor_id)?>">
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="minor_name">ชื่อสาขางาน</label>
                    <div class="col-md-3 ">
                    <input type="text" class="form-control" id="minor_name" placeholder="ชื่อสาขางาน" name="minor_name" value="<?php set_var($minor_name)?>">
                    </div>
                </div>
                    <input type="hidden" class="form-control" id="trainer_id" name="trainer_id" value="<?php set_var($trainer_id)?>">
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="trainer_name">ชื่อครูฝึก</label>
                    <div class="col-md-3 ">
                    <input type="text" class="form-control" id="trainer_name" placeholder="ชื่อครูฝึก" name="trainer_name" value="<?php set_var($trainer_name)?>">
                    </div>
                </div>

                <div class="form-group"> 
                    <label class="control-label col-md-3" for="contract_date">วันที่ทำสัญญา</label>
                    <div class="col-md-4 "><input type="date" id="contract_date" name="contract_date" value="<?php set_var($contract_date)?>"/></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="start_date">วันที่เริ่มต้นการฝึก</label>
                    <div class="col-md-4 "><input type="date" id="start_date" name="start_date" value="<?php set_var($start_date)?>"/></div>
                </div>

                <div class="form-group"> 
                    <label class="control-label col-md-3" for="end_date">วันที่สิ้นสุดการฝึก</label>
                    <div class="col-md-4 "><input type="date" id="end_date" name="end_date" value="<?php set_var($end_date)?>"/></div>
                </div>

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
        </div>
        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>
<script>
   $(function() {
      $( "#std_name" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_student.php",
         minLength: 2,
         select: function (event, ui) {
            $("#std_name").val(ui.item.label); // display the selected text
            $("#citizen_id").val(ui.item.value); // save selected id to hidden input
            return false;
        }   
      });
      $( "#business_name" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 2,
         select: function (event, ui) {
            $("#business_name").val(ui.item.label); // display the selected text
            $("#business_id").val(ui.item.value); // save selected id to hidden input
            return false;
        }   
      });   
      $( "#minor_name" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_minor.php",
         minLength: 2,
         select: function (event, ui) {
            $("#minor_name").val(ui.item.label); // display the selected text
            $("#minor_id").val(ui.item.value); // save selected id to hidden input
            return false;
        }   
      });      
      $( "#trainer_name" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_trainer.php",
         minLength: 2,
         select: function (event, ui) {
            $("#trainer_name").val(ui.item.label); // display the selected text
            $("#trainer_id").val(ui.item.value); // save selected id to hidden input
            return false;
        }   
      }); 
});
</script>
<?php
function do_validate($data) {
    $valid = true;
    $data = &$_POST;
//    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['training_id'])) {
//        set_err('กรุณากรอกรหัสครูฝึก');
//        $valid = false;
//    }
    if (check_pid($data['citizen_id'])) {
        set_err('กรุณากรอกเลขบัตรประชาชน');
        $valid = false;
    }
    if (empty($data['business_id'])) {
        set_err('กรุณากรอกรหัสสถานประกอบการ');
        $valid = false;
    }
    if (empty($data['minor_id'])) {
        set_err('กรุณากรอกรหัสสาขางาน');
        $valid = false;
    }
    if (empty($data['trainer_id'])) {
        set_err('กรุณากรอกรหัสครูฝึก');
        $valid = false;
    }
    if (empty($data['contract_date'])) {
        set_err('กรุณาเลือกวันทำสัญญา');
        $valid = false;
    }
    if (empty($data['start_date'])) {
        set_err('กรุณาเลือกวันเริ่มฝึกงาน');
        $valid = false;
    }
    if (empty($data['end_date'])) {
        set_err('กรุณาเลือกวันสุดท้ายฝึกงาน');
        $valid = false;
    }
    return $valid;
}


function do_update() {
    global $db;
    $data = &$_POST;
    //print_r($data['property']);
    $query = "UPDATE `training` SET `citizen_id`="
            .pq($data['citizen_id']).",`business_id`=".pq($data['business_id'])
            .",`business_id`=".pq($data['business_id'])
            .",`minor_id`=".pq($data['minor_id'])
            .",`trainer_id`=".pq($data['trainer_id'])
            .",`contract_date`=".pq($data['contract_date'])
            .",`start_date`=".pq($data['start_date'])
            .",`end_date`=".pq($data['end_date'])
            ." WHERE `training_id`=".pq($data['training_id']).";";
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล'.  mysqli_error($db));
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('training/list-training');
}

function get_training($training_id = NULL) {
    global $db;
    $sql = "SELECT "
            . "t1.*,s.std_name,b.business_name,m.minor_name,t2.trainer_name "
            . "FROM "
            . "training as t1,business as b,minor as m,trainer as t2,student as s "
            . "where "
            . "t1.citizen_id = s.citizen_id "
            . "AND "
            . "t1.business_id = b.business_id "
            . "AND "
            . "t1.minor_id = m.minor_id "
            . "AND "
            . "t1.trainer_id = t2.trainer_id "
            . "AND "
            . "training_id = '$training_id';";
//    var_dump($sql);
//    die();
    
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}