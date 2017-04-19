<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "แก้ไขขอมูลstudent";
$active = 'student';
$subactive = 'list-student';
if (isset($_POST['submit'])) {
    $data = $_POST;
    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    if (!$valid) {
        
    } else {
        do_update();
    }
}

if (isset($_GET['std_id'])) {
    $student=getstudent($_GET['std_id']);
}

require_once INC_PATH . 'header.php';
       
?>


<div class='container'>
    
<?php include_once INC_PATH . 'submenu-student.php'; ?>
<?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">student</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
                
                <input type="hidden" name="std_id"value="<?php echo $student['std_id'] ?>">
                
                <div class="form-group">    
                    <label class="control-label col-md-3" for="school_id">สถานศึกษา</label>
                    <div class="col-md-4 "><input type="hidden"  class="form-control" id="school_id" name="school_id"value="<?php echo $student['school_id'] ?>">
                        <input type='text' class="form-control" readonly id="school_id" value="<?php echo getSchoolName($student['school_id']);?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 " for="citizen_id">รหัสประจำตัวประชาชน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="citizen_id"name="citizen_id"value="<?php echo $student['citizen_id'] ?>"></div>       
                </div>
                <div class="form-group">      
                    <label class="control-label col-md-3" for="std_name">ชื่อนักเรียน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="std_name" name="std_name"value="<?php echo $student['std_name'] ?>"></div> 
                </div>
                <div class="form-group">  
                    <label class="control-label col-md-3" for="dateofbirth">วันเดือนปีเกิด</label>
                    <div class="col-md-4 "><input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo $student['dateofbirth'] ?>" ></div>
                </div>       
                <div class="form-group">
                    <label class="control-label col-md-3" for="sex">เพศ</label>
                    <div class="col-md-4 ">
                    <input type="radio" name="sex" id="sex" value="M"<?php if ($student['sex'] == "M") echo " checked"; ?>>ชาย
                    <input type="radio" name="sex" id="sex" value="F"<?php if ($student['sex'] == "F") echo " checked"; ?>>หญิง</div>
                </div>
                <?php
                $sql = "SELECT * FROM edu_type";
                $def=$student['type_code'];
                ?>
                <div class="form-group">  
                    <label class="control-label col-md-3" for="type_code">ประเภทวิชา</label>
                    <div class="col-md-4 ">
                    <select class="form-control" id="type_code" name="type_code">
                      <?php echo gen_option($sql, $def)  ?>
                    </select>
                   </div>   
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="major_id">สาขาวิชา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="major_id"name="major_id"value="<?php echo $student['major_id'] ?>" required></div>
                    <?php echo getMajorName($student['major_id']) ?>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3" for="minor_id">สาขางาน</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="minor_id"name="minor_id"value="<?php echo $student['minor_id'] ?> " required></div>
                    <?php echo getMinorName($student['minor_id']) ?>
                </div>               
                <div class="form-group">    
                    <label class="control-label col-md-3" for="end_edu_id">สถานะภาพการศึกษา</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="end_edu_id"name="end_edu_id"value="<?php echo $student['end_edu_id'] ?>"></div>   
                </div>
                <div class="form-group">
                        <div class="col-md-offset-3"><button type="submit" class="btn btn-primary" name="submit">แก้ไข</button></div>
                </div>
        </div>

        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_update(){
    global $db;
    $data = &$_POST;
    $query .= "UPDATE `student` SET ";
    $query .= "`school_id`=".pq($data['school_id']).","
            . "`citizen_id`=".pq($data['citizen_id']).","
            . "`std_name`=".pq($data['std_name']).","
            . "`dateofbirth`=".pq($data['dateofbirth']).","
            . "`sex`=".pq($data['sex']).","
            . "`minor_id`=".pq($data['minor_id']).","
            . "`major_id`=".pq($data['major_id']).","
            . "`end_edu_id`=".pq($data['end_edu_id']).","
            . "`type_code`=".pq($data['type_code'])." "
            . "WHERE `std_id`=".$data['std_id']."";
    //echo $query;
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db) > 0){
        set_info('แก้ไขข้อมูลเรียบร้อย');
    }  else {
        set_err('ไม่มีการแก้ไขข้อมูล');
        if (mysqli_error($db)){
            set_err('เกิดข้อผิดพลาด'. mysqli_error($db));
        }
    }
    redirect('student/list-student');
}

function getstudent($std_id) {
    global $db;
    $query = "SELECT * FROM student where std_id='$std_id'";
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    $student = $row;
    return $student;
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    
    if (!preg_match('/[0-9]{1,}/', $data['school_id'])) {
        set_err('รหัสสถานศึกษาต้องเป็นตัวเลข');
        $valid = false;
    }
  
    
    if (!preg_match('/[0-9]{13,}/', $data['citizen_id'])) {
        set_err('รหัสบัตรประชนไม่ถูกต้อง');
        $valid = false;
    }
    
    
    if (empty($data['std_name'])) {
        set_err('กรุณากรอกชื่อนักเรียน');
        $valid = false;
    }
    
    
    if (!preg_match('/[0-9]{1,}/', $data['minor_id'])) {
        set_err('รหัสสาขางานต้องเป็นตัวเลข');
        $valid = false;
    }
   
    if (!preg_match('/[0-9]{1,}/', $data['major_id'])) {
        set_err('รหัสสาขาวิชาต้องเป็นตัวเลข');
        $valid = false;
    }
    
    if (!preg_match('/[0-9]{1,}/', $data['type_code'])) {
        set_err('รหัสประเภทวิชาต้องเป็นตัวเลข');
        $valid = false;
    }
    
    return $valid;
}

?>

