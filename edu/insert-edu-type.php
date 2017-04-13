<?php
 if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); 
$title = "เพิ่มข้อมูลประเภทวิชา";
$active = 'business';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
   //var_dump($data);
   $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
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
        <div class="panel-heading">ข้อมูลประเภทวิชา</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="typcode">รหัสประเภทวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="typcode" name="typcode"value="<?php set_var($typcode) ?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="typname">ชื่อประเภทวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="typname" name="typname"value="<?php set_var($typname) ?>"></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="etypname">ชื่อวิชาภาษาอักงกฤษ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="etypname"name="etypname"value="<?php set_var($etypname) ?>"></div>
                </div>
        </div> 

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
        </div>
        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php
function do_insert(){
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO edu_type (`typcode`,`typname`,`etypname`)  VALUES (".pq($data['typcode']).",".pq($data['typname']).",".pq($data['etypname']).")";
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db)>0){
        set_info('บันทึกข้อมูลเรียบร้อย');
		redirect('edu/list-edu-type');
    }  else {
        set_err('บันทึกข้อมูลไม่สำเร็จ '. mysqli_error($db));
    }
}
function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[0-9_]{1,}/', $data['typcode'])) {
        set_err('ข้อมูลดาวน์โหลดต้องเป็นตัวเลข');
        $valid = false;
    }
    if (empty($data['typname'])) {
        set_err('กรุณากรอกข้อมูล');
        $valid = false;
    }
    
	if (!preg_match('/[a-zA-Z_]{1,}/', $data['etypname'])) {
        set_err('ข้อมูลอัพโหลดต้องเป็นภาษาอังกฤษ');
        $valid = false;
    }
    return $valid;
}



?>
