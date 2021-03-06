<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$active = 'signin';
$title = 'เข้าระบบ';
// check post data
if (isset($_POST['submit'])) {
    $data = $_POST;
    do_login($data);
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
    <div class="col-md-offset-3 col-md-6">
        <div class="panel panel-default center-block">
            <div class="panel-heading">
                <label class="panel-title">ลงชื่อเข้าระบบ</label>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="signupfrm" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="username">ชื่อผู้ใช้</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value='<?php echo isset($username) ? $username : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="password">รหัสผ่าน</label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" id="password" name="password" value='<?php echo isset($password) ? $password : ''; ?>'>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn btn-default" name='submit'>เข้าระบบ</button>
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

// functions section 
function do_login($data) {
    global $db;
    $strHash = create_password_hash(md5($data['password']), PASSWORD_DEFAULT);
    $query = "SELECT * FROM user WHERE username = " . pq($data['username']) ." AND status = 'Y'" ;
//    die($query);
    $result = mysqli_query($db, $query);
//    echo mysqli_error($db);
//    var_dump($result);
//    die();
    if ($result) {
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if (verify_password_hash($row['password'], $strHash)) {
            unset($row['password']);
//            $_SESSION['username'] = $row['username'];
//            $_SESSION['fname'] = $row['fname'];
//            $_SESSION['lname'] = $row['lname'];
            $_SESSION['user'] = $row;
//            var_dump($_SESSION);
//            die();
            do_insert_log($data['username'],'Y');
            set_info('ยินดีต้อนรับคุณ'.$row['fname']);
            redirect();
        } else {
            do_insert_log($data['username'],'N');
            set_err("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!");
        }
    }  else {
            do_insert_log($data['username'],'N');
        set_err("ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!!");
    }
}

function do_insert_log($username,$event){
    global $db;
    $query = "INSERT INTO `access_log` ("
            . "`id`, "
            . "`username`, "
            . "`event`, "
            . "`ip_address`, "
            . "`user_agent` "            
            . ") VALUES ("
            . "NULL, "
            . pq($username) . ", "
            . pq($event).","
            . pq($_SERVER['REMOTE_ADDR']) . ", "
            . pq($_SERVER['HTTP_USER_AGENT']).")";
//    var_dump($query);
//    die();
    $result = mysqli_query($db, $query);
    if(mysqli_error($db)){
        set_err('ไม่สามารถบันทึกข้อมูลได้ : '.  mysqli_error($db));
    }
}


