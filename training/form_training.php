<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลสถานประกอบการ";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
//    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    $valid = TRUE;
    if (!$valid) {
        
    } else {
        do_insert();
    }
}
require_once INC_PATH . 'header.php';
?>
<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">ข้อมูลการฝึกงาน</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="VocationTrain_id">รหัสการฝึกอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="VocationTrain_id" name="VocationTrain_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="citizen_id">รหัสบัตรประชาชน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="citizen_id" name="citizen_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="business_id" placeholder="ชื่อสถานประกอบการ"name="business_id"></div>
                </div>              
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="school_id" placeholder="ชื่อสถานศึกษา" name="school_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="minor_id">รหัสสาขางาน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="minor_id" placeholder="ชื่อสาขางาน" name="minor_id"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="trainer_id">รหัสครูฝึก</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="trainer_id" placeholder="ชื่อครูฝึก" name="trainer_id"></div>
                </div>

                <div class="form-group"> 
                    <label class="control-label col-md-3" for="contract_date">วันที่ทำสัญญา</label>
                    <div class="col-md-4 "><input type="date" id="contract_date" name="contract_date" /></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="start_date">วันที่เริ่มต้นการฝึก</label>
                    <div class="col-md-4 "><input type="date" id="start_date" name="start_date" /></div>
                </div>

                <div class="form-group"> 
                    <label class="control-label col-md-3" for="end_date">วันที่สิ้นสุดการฝึก</label>
                    <div class="col-md-4 "><input type="date" id="end_date" name="end_date" /></div>
                </div>


        </div> 

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
        </div>
        </form>
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
      $( "#school_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_school.php",
         minLength: 1
      });
      $( "#minor_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_minor.php",
         minLength: 1
      });   
      $( "#trainer_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_trainer.php",
         minLength: 1
      });        
   });
</script> 
<?php
function do_insert(){
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO training (`VocationTrain_id`,`citizen_id`,`business_id`,`school_id`,`minor_id`,`trainer_id`,`contract_date`,`start_date`,`end_date`)  VALUES (".pq($data['VocationTrain_id']).",".pq($data['citizen_id']).",".pq($data['business_id']).",".pq($data['school_id']).",".pq($data['minor_id']).",".pq($data['trainer_id']).",".pq($data['contract_date']).",".pq($data['start_date']).",".pq($data['end_date']).")";
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db)>0){
        set_info('บันทึกข้อมูลเรียบร้อย');
    }  else {
        set_err('บันทึกข้อมูลไม่สำเร็จ '. mysqli_error($db));
    }
}