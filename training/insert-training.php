<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลการฝึกงาน";
$active = 'training';
$school_id = $_SESSION['user']['school_id'];
$subactive = 'insert';
if (isset($_POST['submit'])) {
    $data = $_POST;
<<<<<<< HEAD
    //var_dump($data);
=======
//    var_dump($data);
>>>>>>> master
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    if ($valid) {
        do_insert($school_id);
    } else {
        foreach ($_POST as $k => $v) {
            $$k = $v;  // set variable to form
        }
    }
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
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="citizen_id">รหัสบัตรประชาชน</label>
                    <div class="col-md-3 "><input type="text" class="form-control" id="citizen_id" placeholder="ชื่อนักศึกษา" name="citizen_id" value="<?php set_var($citizen_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                    <div class="col-md-3 "><input type="text" class="form-control" id="business_id" placeholder="ชื่อสถานประกอบการ" name="business_id" value="<?php set_var($business_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                    <div class="col-md-3 "><input type="text" class="form-control" readonly="" id="school_id" placeholder="ชื่อสถานศึกษา" name="school_id" value="<?php set_var($school_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="minor_id">รหัสสาขางาน</label>
                    <div class="col-md-3 "><input type="text" class="form-control" id="minor_id" placeholder="ชื่อสาขางาน" name="minor_id" value="<?php set_var($minor_id)?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="trainer_id">รหัสครูฝึก</label>
                    <div class="col-md-3 "><input type="text" class="form-control" id="trainer_id" placeholder="ชื่อครูฝึก" name="trainer_id" value="<?php set_var($trainer_id)?>"></div>
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
         minLength: 2
      });
      $( "#business_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 2
      });   
      $( "#minor_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_minor.php",
         minLength: 2
      });      
      $( "#trainer_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_trainer.php",
         minLength: 2
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

function do_insert($school_id){
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO training (`training_id`,`citizen_id`,`business_id`,`school_id`,`minor_id`,`trainer_id`,`contract_date`,`start_date`,`end_date`)  VALUES (NULL,".pq($data['citizen_id']).",".pq($data['business_id']).",".pq($school_id).",".pq($data['minor_id']).",".pq($data['trainer_id']).",".pq($data['contract_date']).",".pq($data['start_date']).",".pq($data['end_date']).")";
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db)>0){
        set_info('บันทึกข้อมูลเรียบร้อย');
    }  else {
        set_err('บันทึกข้อมูลไม่สำเร็จ '. mysqli_error($db));
    }
}