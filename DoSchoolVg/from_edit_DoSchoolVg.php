<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน";
$active = 'do_school_vg';
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
        do_editdoschoolvg();
    }
}
if ($_GET['do_school_vg_id']) {
    $DoSchoolVg = get_DoSchoolVg($_GET['do_school_vg_id']);
}
require_once INC_PATH . 'header.php';
?>

<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่มข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_school_vg_id" class="col-md-2 control-label">รหัสการร่วมภาครัฐและเอกชน</label>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" id="do_school_vg_id" name="do_school_vg_id"value="<?php echo $DoSchoolVg['do_school_vg_id']; ?>">
                            <?php echo $DoSchoolVg['do_school_vg_id']; ?>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="vg_id" class="col-md-3 control-label">กลุ่มอาชีพ</label>
                        <div class="col-md-2">
                            <?php
                            $sql = "select * from vocation_group";
                            $def = "vg_id";
                            ?>
                            <select class="form-control" id="vg_id" name="vg_id">
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
                        <label for="date_vg" class="col-md-2 control-label">วันที่จดทะเบียน</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date"name="date_vg"value="<?php echo $DoSchoolVg['date_vg']; ?>">
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
    if (empty($data['vg_id'])) {
        set_err('กรุณาเลือกกลุ่มอาชีพ');
        $valid = false;
    }
    if (empty($data['school_id'])) {
        set_err('กรุณาเลือกสถานศึกษา');
        $valid = false;
    }
    return $valid;
}
function do_editdoschoolvg() {
    global $db;
    $data = &$_POST;
    $query = "update do_school_vg set
	vg_id=" . pq($data['vg_id']) . ","
            . "school_id=" . pq($data['school_id']) . ","
            . "date_vg=" . pq($data['date_vg']) ."'
where do_school_vg_id = '" . $data['do_school_vg_id']. "'";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
     redirect('DoSchoolVg/list-DoSchoolVg');
}

function get_DoSchoolVg($do_school_vg_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_school_vg where do_school_vg_id = '$do_school_vg_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
?>