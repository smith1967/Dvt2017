<?php
//session_start();
$_SESSION['school_id'] = 1320026101; //แก้ไขรับ  แบบ Auto
$school_id = $_SESSION['school_id'];
//$check=$_GET['action'];
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "อัพโหลดไฟล์และตรวจสอบข้อมูล";
$active = 'admin';
$subactive = 'school_type';
// is_admin('home/index');
?>

<?php require_once INC_PATH . 'header.php'; ?>


<div class='container'>
    <?php include_once INC_PATH . 'submenu-school.php'; ?>


<div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">กรอกข้อมูลสถานศึกษา</label>
            </div>
<?php
 if (isset($_POST['submit'])) {
        $data = $_POST;
        $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
        if (!$valid) {
            show_message();
            foreach ($_POST as $k => $v) {
                $$k = $v;  // set variable to form
            }
        } else {
            do_save();  // ไม่มี error บันทึกข้อมูล
        }
    } else {
        //echo "input  data ";
    }





?>
            <div class="panel-body">
                <form class="form-horizontal" id="school_type" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="school_id">รหัสประเภทสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_type_id" name="school_type_id" placeholder="school_type_id" value=''>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="type_name">ชื่อประเภทสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="type_name" name="type_name" placeholder="type_name" value=''>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-5">
                            <button type="submit" class="btn btn-primary" name='submit'>บันทึกข้อมูล</button>
                        </div>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</div>

<?php

function do_save() {
    global $db;
    $data = &$_POST;
    var_dump($data);
    //die();
    $sql = "INSERT INTO `school_type` (
			`school_type_id` ,`type_name`
		)VALUES(
			" . pq($data['school_type_id']) . ",
            " . pq($data['type_name']) . ");";
			
    // die("sql: ".$sql);
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) > 0) {
        $_SESSION['info'] = "บันทึกเรียบร้อยครับ";
        redirect('school/list-school-type');
    } else {
        $_SESSION['error'] = "บันทึกไม่สำเร็จ กรุณาตรวจสอบข้อมูล" . mysqli_error($db) . $sql;
        redirect('school/form-insert-school-type');
    }
    /* close statement and connection */
    //redirect();
}

?>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php 
    function do_validate($data) {
        $valid = TRUE;
        if (empty($data['school_type_id'])) {
            set_err('กรุณาใส่รหัสของสถานศึกษา');
            $valid = FALSE;
        }

        if (empty($data['type_name'])) {
            set_err('กรุณาใส่ชื่อของสถานศึกษา');
            $valid = FALSE;
        }
        
        return $valid;
        /* ----End Validate ---- */
    }
    ?>