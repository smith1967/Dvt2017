<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูล";
$active = 'edit-user';
//$subactive = 'home';
!is_auth()? redirect():'';
?>
<?php
if (isset($_POST['submit'])) {
    $data = $_POST;
    $valid = do_validate($data);
    if ($valid) {
        do_update();  // ไม่มี error บันทึกข้อมูล
    } else {
        foreach ($_POST as $k => $v) {
            $$k = $v;  // set variable to form
        }
    }
}else{
    foreach ($_SESSION['user'] as $k => $v){
        $$k = $v;
    }    
}
require_once INC_PATH.'header.php'; 
?>
<script>
$(document).ready(function(){
    $("#username").focus();
});
</script>
<div class='container'>
    <?php show_message() ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">แก้ไขข้อมูล</label>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="signupform" method="post" action="">
                    <input type="hidden" name="user_id" value="<?php set_var($user_id)?>"/>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="username">ชื่อผู้ใช้</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="username" name="username" readonly value='<?php echo isset($username) ? $username : ''; ?>'>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="control-label col-md-3" for="password">รหัสผ่าน</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" id="password" name="password" value='<?php echo isset($password) ? $password : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="confirm_password">ยืนยันรหัสผ่าน</label>
                        <div class="col-md-5">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value='<?php echo isset($confirm_password) ? $confirm_password : ''; ?>'>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_id" name="school_id" placeholder="School ID" value='<?php echo isset($school_id) ? $school_id : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="email">อีเมล์</label>
                        <div class="col-md-5">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value='<?php echo isset($email) ? $email : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="fname">ชื่อ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="firstname" value='<?php echo isset($fname) ? $fname : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="lname">นามสกุล</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="lastname" value='<?php echo isset($lname) ? $lname : ''; ?>'>
                        </div>
                    </div>
<!--                    <div class="form-group"> 
                        <label class="control-label col-md-3" for="user_type_id">ประเภทผู้ใช้</label>
                        <div class="col-md-4">
                            <select class='form-control input-xlarge'id="user_type_id" name="user_type_id">
                                <?php
                                $def = isset($user_type_id) ? $user_type_id : '3';
                                $sql = "SELECT user_type_id,user_type_desc FROM user_type";
                                echo gen_option($sql, $def)
                                ?>
                            </select>              
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-md-3" for="phone">โทรศัพท์</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="phone" name="phone" value='<?php echo isset($phone) ? $phone : ''; ?>'>
                        </div>
                    </div>

                    <div class="form-group">

                            <div class="checkbox" >
                                <label class="control-label col-md-offset-3"><input type="checkbox" id='agree' name='agree' value='1'>ยืนยันข้อมูลถูกต้อง</label>
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
require_once INC_PATH.'footer.php';                                
//var_dump($_SESSION['user']);
?>
<script>
   $(function() {

      $( "#school_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_school.php",
         minLength: 1
      });
   });
</script>
<?php

function do_update() {
    global $db;
    $data = &$_POST;
    //var_dump($data);
    //die();
    foreach ($_POST as $k => $v) {
            $$k = pq($v);  // set variable to form
    }
    $id = $_SESSION['user']['id'];

    $sql = <<<EOD
            UPDATE user SET 
                username = {$username},
                fname = {$fname},
                lname = {$lname},
                school_id = {$school_id},
                email = {$email} 
            WHERE
                user_id = {$user_id};
EOD;
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db)>0){   
        $_SESSION['info'][] = "แก้ไขเรียบร้อยครับ";
        redirect('home/index');
    } else {
        $_SESSION['err'][] = "แก้ไขข้อมูลไม่สำเร็จกรุณาตรวจสอบข้อมูล".  mysqli_error($db) .$sql;        
        redirect('user/edit-user');
    }
    /* close statement and connection */
    //redirect();
}

function get_info($user_id) {
    global $db;
    $query = "SELECT * FROM user WHERE user_id='" . pq($user_id + 0) . "'";
    $res = mysqli_query($db, $query);
    return $res;
}


function do_validate($data) {
//    var_dump($data);
    global $db;
    $valid = TRUE;
//    if (!preg_match('/[a-zA-Z0-9_@]{5,}/', $data['username'])) {
//        set_err('ชื่อผู้ใช้ต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 5 ตัวอักษร');
//        $valid = FALSE;
//    }
//    $sql = "SELECT username FROM user WHERE username = ".pq($data['username']);
//    if(mysqli_query($db, $sql)){
//        set_err('ชือผู้ใช้นี้ถูกใช้ไปแล้ว');
//        $valid = FALSE;
//    }
//    if (!preg_match('/[a-zA-Z0-9_@]{5,}/', $data['username'])) {
//        set_err('ชื่อผู้ใช้ต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 5 ตัวอักษร');
//        $valid = FALSE;
//    }    
//    if (!preg_match('/[a-zA-Z0-9_@]{6,}/', $data['password'])) {
//        set_err('รหัสผ่านต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 6 ตัวอักษร');
//        $valid = FALSE;
//    }
//    if ($data['password'] != $data['confirm_password']) {
//        set_err('รหัสยืนยันไม่ตรงกับรหัสผ่าน');
//        $valid = FALSE;
//    }
//    if ($data['password'] == $data['username']) {
//        set_err('ชื่อผู้ใช้กับรหัสผ่านต้องไม่เหมือนกัน');
//        $valid = FALSE;
//    }
    if (empty($data['fname'])) {
        set_err('กรุณาใส่ชื่อ');
        $valid = FALSE;
    }
    if (empty($data['lname'])) {
        set_err('กรุณาใส่นามสกุล');
        $valid = FALSE;
    }
//    if (check_confirm_password($data['confirm_password'])) {
//        set_err('ตรวจสอบรหัสบัตรประชาชนให้ถูกต้องครับ');
//        $valid = FALSE;
//    }
    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) == FALSE) {
        set_err('รูปแบบอีเมล์ไม่ถูกต้อง');
        $valid = FALSE;
    }
//    $sql = "SELECT username FROM user WHERE email = ".pq($data['email']);
//    if(mysqli_query($db, $sql)){
//        set_err('อีเมล์นี้ถูกใช้ไปแล้ว');
//        $valid = FALSE;
//    }    
    if (!preg_match('/[0-9_-]{8,}/', $data['phone'])) {
        set_err('กรุณาใส่หมายเลขโทรศัพท์');
        $valid = FALSE;
    }
    if (empty($data['agree'])) {
        set_err('กรุณายืนยันข้อมูล');
        $valid = FALSE;
    }
    return $valid;
    /* ----End Validate ---- */
}
