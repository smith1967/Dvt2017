<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลการทำ กรอ";
$active = 'do_vg';
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
        do_editdovg();
    }
}
if(!isset($_GET['do_vg_id']))
    redirect('do_vg/list-do_vg');
if ($_GET['do_vg_id']) {
    $dovg = get_dovg($_GET['do_vg_id']);
    foreach ($dovg as $key => $value) {
        $$key = $value;
    }
    // var_dump($DoBusinessVg);
    // exit();
}
require_once INC_PATH . 'header.php';
?>
<script>
    $(document).ready(function () {
        $("#vg_id").focus();
    });
</script>
<div class="container">
    <?php show_message() ?>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">แก้ไขข้อมูลการทำ กรอ</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_vg_id" class="col-md-3 control-label">รหัสการทำ กรอ</label>
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" id="do_vg_id" name="do_vg_id"value="<?php set_var($do_vg_id); ?>">
                            <?php set_var($do_vg_id); ?>
                        </div>
                    </div>                   
                     <div class="form-group">
                        <label for="vg_id" class="col-md-3 control-label">กลุ่มอาชีพ</label>
                        <div class="col-md-2">
                        
                            <?php
                            $sql = "select * from vocation_group";
                            $def = $dovg['vg_id'];
                            ?>
                            <select class="form-control" id="vg_id" name="vg_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="do_vg_date" class="col-md-3 control-label">วันที่แต่งตั้งคณะกรรมการ</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="do_vg_date" placeholder="yyyy/mm/dd" name="do_vg_date"value="<?php set_var($do_vg_date); ?>">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="command_number" class="col-md-3 control-label">เลขที่คำสั่ง</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="command_number"name="command_number"value="<?php set_var($command_number); ?>">
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="control-label col-md-3" for="secretary_position_name">ตำแหน่งอนุกรรมการและเลขานุการ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="secretary_position_name"name="secretary_position_name"value="<?php set_var($secretary_position_name); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="president_name">ประธานอนุกรรมการ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="president_name"name="president_name"value="<?php set_var($president_name); ?>">
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
     if (empty($data['command_number'])) {
        set_err('กรุณากรอกเลขที่คำสั่ง');
        $valid = false;
    }
    return $valid;
}

function do_editdovg() {
    global $db;
    $data = &$_POST;
    $query = "update do_vg set
	vg_id=" . pq($data['vg_id']) . ","
            . "do_vg_date=" . pq($data['do_vg_date']) . ","
            . "command_number=" . pq($data['command_number']) . ","
            . "secretary_position_name=" . pq($data['secretary_position_name']) . ","
            . "president_name=" . pq($data['president_name']) . "
where do_vg_id = " . pq($data['do_vg_id']). ";";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('do_vg/list-do_vg');
}

function get_dovg($do_vg_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_vg where do_vg_id = '$do_vg_id';
";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
?>