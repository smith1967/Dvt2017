<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$active = 'signup';
$title = 'ลงทะเบียนผู้ใช้';
//
if (isset($_POST['submit'])) {
    $data = $_POST;
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    if (!$valid) {
        foreach ($data as $k => $v) {
            $$k = $v;  // set variable to form
        }
    } else {
        do_save();  // ไม่มี error บันทึกข้อมูล
    }
} else {
    $username = '';
    $lname = '';
    $fname = '';
    $password = '';
    $confirm_password = '';
    $email = '';
    $phone = '';
}
// include header
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#username").focus();
    });
</script>

<div class='container'>
    <?php show_message() ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <label class="panel-title">กรอกข้อมูลสมัครเข้าใช้ระบบ</label>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="signupform" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="username">ชื่อผู้ใช้</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value='<?php echo isset($username) ? $username : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
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
                    </div>
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
                    <div class="form-group"> 
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
                    </div>
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
// include footer
require_once INC_PATH . 'footer.php';
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
// function section

function do_save() {
    global $db;
    $data = &$_POST;
    $password = md5($data['password']);
    //var_dump($data);
    //die();
    $sql = "INSERT INTO `user` ("
            . "`user_id`, "
            . "`username`, "
            . "`password`, "
            . "`fname`, "
            . "`lname`, "
            . "`email`, "
            . "`phone`, "
            . "`school_id`, "
            . "`user_type_id`, "
            . "`status`"
            . ") VALUES ("
            . "NULL, "
            . pq($data['username']) . ", "
            . pq($password) . ", "
            . pq($data['fname']) . ", "
            . pq($data['lname']) . ", "
            . pq($data['email']) . ", "
            . pq($data['phone']) . ", "
            . pq($data['school_id']) . ", "
            . pq($data['user_type_id']) . ","
            . "'N');";
//    die("sql: " . $sql);
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) > 0) {
        set_info('ลงทะเบียนข้อมูลเรียบร้อย');
//        $_SESSION['info'] = "ลงทะเบียนเรียบร้อยครับ";
        redirect('home/index');
    } else {
        set_err("ลงทะเบียนไม่สำเร็จ กรุณาตรวจสอบข้อมูล" . mysqli_error($db));
//        $_SESSION['error'] = "ลงทะเบียนไม่สำเร็จ กรุณาตรวจสอบข้อมูล" . mysqli_error($db) . $sql;
        redirect('user/signup');
    }
    /* close statement and connection */
    //redirect();
}

function get_info($mem_id) {
    global $db;
    $query = "SELECT * FROM member WHERE mem_id='" . pq($mem_id + 0) . "'";
    $res = mysqli_query($db, $query);
    return $res;
}

function do_validate($data) {
//    var_dump($data);
    global $db;
    $valid = TRUE;
    if (!preg_match('/[a-zA-Z0-9_@]{5,}/', $data['username'])) {
        set_err('ชื่อผู้ใช้ต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 5 ตัวอักษร');
        $valid = FALSE;
    }
    $sql = "SELECT username FROM user WHERE username = ".pq($data['username']);
    if(mysqli_query($db, $sql)){
        set_err('ชือผู้ใช้นี้ถูกใช้ไปแล้ว');
        $valid = FALSE;
    }
  
    if (!preg_match('/[a-zA-Z0-9_@$!]{6,}/', $data['password'])) {
        set_err('รหัสผ่านต้องเป็นตัวเลขหรือตัวอักษรภาษาอังกฤษ ความยาวไม่ต่ำกว่า 6 ตัวอักษร');
        $valid = FALSE;
    }
    if ($data['password'] != $data['confirm_password']) {
        set_err('รหัสยืนยันไม่ตรงกับรหัสผ่าน');
        $valid = FALSE;
    }
    if ($data['password'] == $data['username']) {
        set_err('ชื่อผู้ใช้กับรหัสผ่านต้องไม่เหมือนกัน');
        $valid = FALSE;
    }
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
    $sql = "SELECT username FROM user WHERE email = ".pq($data['email']);
    if(mysqli_query($db, $sql)){
        set_err('อีเมล์นี้ถูกใช้ไปแล้ว');
        $valid = FALSE;
    }    
    if (!preg_match('/[0-9_-+]{8,}/', $data['phone'])) {
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
