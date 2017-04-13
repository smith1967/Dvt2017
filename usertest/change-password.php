<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$active = 'change-password';
$title = 'เปลี่ยนรหัสผ่าน';
?>
<?php
if (isset($_POST['submit'])) {
    $data = $_POST;
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    if (!$valid) {
        foreach ($_POST as $k => $v) {
            $$k = $v;  // set variable to form
        }
    } else {
        do_update();  // ไม่มี error บันทึกข้อมูล
    }
}
?>
<?php require_once INC_PATH . 'header.php'; ?>
<script>
    $(document).ready(function () {
        $("#username").focus();
    });
</script>

<div class='container'>
    <?php show_message(); ?>
    <div class="page-header">
        <h2>แก้ไขรหัสผ่าน</h2>
    </div>

    <form class="form-horizontal" id="signupfrm" method="post" action="">
        <fieldset>
            <div class="form-group">
                <label class="control-label col-md-2" for="username">ชื่อผู้ใช้</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value='<?php echo isset($username) ? $username : ''; ?>'>
                    <p class="help-block">ชื่อผู้ใช้ต้องเป็นภาษาอังกฤษหรือตัวเลขความยาวไม่ต่ำกว่า 5 ตัวอักษร</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="password">รหัสผ่านเดิม</label>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="password" name="password" value='<?php echo isset($password) ? $password : ''; ?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="newpass">รหัสผ่านใหม่</label>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="password" name="newpass" value='<?php echo isset($newpass) ? $newpass : ''; ?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2" for="confpass">ยืนยันรหัสผ่านใหม่</label>
                <div class="col-md-3">
                    <input type="password" class="form-control" id="confirm_password" name='confpass' value='<?php echo isset($confpass) ? $confpass : ''; ?>'>
                    <p class="help-block">รหัสผ่านต้องประกอบตัวอักษรตัวเล็ก ตัวใหญ่ และตัวเลขความยาวไม่น้อยกว่า 6 ตัวอักษร</p>
                </div>
            </div>     
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-primary" name='submit'>บันทึกข้อมูล</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function do_update() {
    global $db;
    $data = &$_POST;
//    $query = "SELECT username FROM user WHERE username = " . pq($data['username']) . " AND password = " . pq($data['password']);
//    if (mysqli_query($db, $query)) {
    $query = "UPDATE user SET password  = MD5(" . pq($data['newpass']) . ") WHERE username = " . pq($data['username']);
    $result = mysqli_query($db, $query);
    mysqli_affected_rows($db) > 0 ? set_info('แก้ไขรหัสผ่านสำเร็จ') : set_err('ไม่สามารถแก้ไขรหัสผ่าน' . mysqli_error($db));
//    }
    redirect('user/change-password');
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    $valid = validate_user();
    if (!preg_match('/[a-zA-Z0-9_@]{5,}/', $data['username'])) {
        set_err('ชื่อผู้ใช้ต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 5 ตัวอักษร');
        $valid = false;
    }
    //if (!preg_match('/[a-zA-Z0-9_@]{6,}/', $data['newpass'])) {    
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,}$/', $data['newpass'])) {
        set_err('รหัสผ่านต้องมีตัวเลขและตัวอักษรภาษาอังกฤษตัวพิมพ์เล็กและตัวพิมพ์ใหญ่ ความยาวไม่ต่ำกว่า 6 ตัวอักษร');
        $valid = false;
    }
    if ($data['newpass'] != $data['confpass']) {
        set_err('รหัสยืนยันไม่ตรงกับรหัสผ่าน');
        $valid = false;
    }
    return $valid;
}

function validate_user() {
    global $db;
    $data = &$_POST;
    $query = "SELECT * FROM user WHERE username=" . pq($data['username']) . " AND password = MD5(" . pq($data['password']).");";
    //die($query);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 0) {
        set_err('กรุณาตรวจสอบชื่อผู้ใช้และรหัสผ่าน');
        return FALSE;
    } else {
        return TRUE;
    }
}
?>

