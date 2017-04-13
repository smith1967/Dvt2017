<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "หน้าหลัก";
$active = 'home';   // active menu
?>

<?php require_once INC_PATH . 'header.php'; ?>
<div class='container'>
    <?php show_message() ?>
    <div class="page-header">
        <h1>ระบบฐานข้อมูลความร่วมมือ สำนักงานคณะกรรมการการอาชีวศึกษา</h1>
    </div>
    <div class="jumbotron">
        <h2>ยินดีต้อนรับ</h2>      
        <p>
            ทดสอบการติดตั้งหน้าแรก
        </p>

    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>
