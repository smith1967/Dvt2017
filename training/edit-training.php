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
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
<!--                <div class="form-group"> 
                    <label class="control-label col-md-3" for="training_id">รหัสการฝึกอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="training_id" name="training_id"></div>
                </div>-->
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="citizen_id">รหัสบัตรประชาชน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="citizen_id" placeholder="ชื่อนักศึกษา" name="citizen_id" value="<?php set_var($citizen_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="business_id" placeholder="ชื่อสถานประกอบการ" name="business_id" value="<?php set_var($business_id)?>"></div>
                </div>
<!--                <div class="form-group"> 
                    <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="school_id" placeholder="ชื่อสถานศึกษา" name="school_id"></div>
                </div>-->
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="minor_id">รหัสสาขางาน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="minor_id" placeholder="ชื่อสาขางาน" name="minor_id" value="<?php set_var($minor_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="training_id">รหัสครูฝึก</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="training_id" placeholder="ชื่อครูฝึก" name="training_id" value="<?php set_var($training_id)?>"></div>
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
      $( "#citizen_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_student.php",
         minLength: 1
      });
      $( "#business_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 1
      });   
      $( "#minor_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_minor.php",
         minLength: 1
      });      
      $( "#training_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_training.php",
         minLength: 1
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
    if (empty($data['training_id'])) {
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
            .",`training_id`=".pq($data['training_id'])
            .",`contract_date`=".pq($data['contract_date'])
            .",`start_date`=".pq($data['start_date'])
            .",`end_date`=".pq($data['end_date'])
            ." WHERE `training_id`=".pq($data['training_id']).";";
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('training/list-training');
}

function get_training($training_id = NULL) {
    global $db;
    $sql = "SELECT * FROM training where training_id = '$training_id';";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}