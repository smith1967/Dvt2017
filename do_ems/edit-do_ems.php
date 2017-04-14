<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน";
$active = 'do_business_vg';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
    $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }

    if (!$valid) {
        
    } else {
        do_editdoems();
    }
}
if ($_GET['do_ems_id']) {
    $doems = get_doems($_GET['do_ems_id']);
}
require_once INC_PATH . 'header.php';
?>

<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">แก้ไขข้อมูลการลงนามความร่วมมือสถานศึกษาต้นแบบสานพลังประชารัฐ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_ems_id" class="col-md-2 control-label">รหัสการลงนาม</label>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" id="do_ems_id" name="do_ems_id"value="<?php echo $doems['do_ems_id']; ?>">
                            <?php echo $doems['do_ems_id']; ?>
                        </div>
                    </div>                   
                    <div class="form-group">
                        <label for="business_id" class="col-md-3 control-label">ชื่อสถานประกอบการ</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from business";
                            $def = "business_id";
                            ?>
                            <select class="form-control" id="business_id" name="business_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="school_id" class="col-md-3 control-label">ชื่อสถานศึกษา</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from school";
                            $def = "school_id";
                            ?>
                            <select class="form-control" id="vg_id" name="school_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="do_date" class="col-md-2 control-label">วันที่ลงนาม</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date"name="do_date"value="<?php echo $doems['do_date']; ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="major_id" class="col-md-3 control-label">ชื่อสาขาวิชาที่ลงนาม</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from major";
                            $def = "major_id";
                            ?>
                            <select class="form-control" id="major_id" name="major_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div>     
                    <div class="form-group">
                        <label for="ems_id" class="col-md-3 control-label">ชื่อสาขาวิชาที่ลงนาม</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from ems_detail";
                            $def = "ems_id";
                            ?>
                            <select class="form-control" id="ems_id" name="ems_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div>     
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn btn-sm btn-primary" name ="submit" >บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['school_id'])) {
        set_err('กรุณาเลือกสถานศึกษา');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['business_id'])) {
        set_err('กรุณาเลือกสถานประกอบการ');
        $valid = false;
    }
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['major_id'])) {
        set_err('กรุณาเลือกสาขาวิชาที่ลงนาม');
        $valid = false;
    }
    return $valid;
}

function do_editdoems() {
    global $db;
    $data = &$_POST;
    $query = "update do_ems set
	business_id=" . pq($data['business_id']) . ","
            . "school_id=" . pq($data['school_id']) . ","
            . "do_date=" . pq($data['do_date']) . ","
            . "major_id=" . pq($data['major_id']) . ","
            . "ems_id=" . pq($data['ems_id']) . "'
where do_ems_id = '" . $data['do_ems_id'] . "'";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('doems/list-doems');
}

function get_doems($do_ems_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_ems where do_ems_id = '$do_ems_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>