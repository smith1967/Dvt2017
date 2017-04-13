<?php
/* if (!defined('BASE_PATH'))
  exit('No direct script access allowed'); */
$title = "เพิ่มข้อมูลกลุ่มอาชีพ";
$active = 'vocation_group';
//$subactive = 'edit-group-config';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
 $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
    //$valid = TRUE;
    if (!$valid) {
        
    } else {
        do_update();
    }
}       
require_once INC_PATH . 'header.php';

$vocation_group=getvocation_group($_GET['vg_id'])
?>
<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">แก้ไขข้อมูลกลุ่มอาชีพ</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action="">      
                
                <input type="hidden" class="form-control" id="vg_id" name="vg_id" value="<?php set_var($vocation_group['vg_id'])?>">
                
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="vg_name">ชื่อกลุ่มอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="vg_name" name="vg_name" value="<?php set_var($vocation_group['vg_name'])?>"></div>
                </div>
        </div> 

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">แก้ไขข้อมูล</button></div>
        </div>
        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php
function do_update() {
    global $db;
    $data = &$_POST;
    $query = "UPDATE `vocation_group` SET `vg_name`=".pq($data['vg_name'])." WHERE `vg_id`=".pq($data['vg_id'])."";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
    redirect('vocation_group/list_vocation_group');
}

function getvocation_group($vg_id) {
    global $db;
    $query = "SELECT * FROM vocation_group where vg_id='$vg_id'";
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    $vocation_group = $row;
    return $vocation_group;
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    
    if (empty($data['vg_name'])) {
        set_err('กรุณากรอกรหัสกลุ่มอาชีพ');
        $valid = false;
    }
    
    return $valid;
}
?>