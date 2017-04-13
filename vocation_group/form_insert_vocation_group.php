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
        do_insert();
    }
}

require_once INC_PATH . 'header.php';
?>
<div class='container'>
    <?php show_message() ?>
    <div class="panel panel-default">
        <div class="panel-heading">เพิ่มข้อมูลกลุ่มอาชีพ</div>
        <div class="panel-body">
            <form method="post" class="form-horizontal" action=""> 
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="vg_id">รหัสกลุ่มอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="vg_id" name="vg_id" value="<?php set_var($vg_id)?>" ></div>
                </div>
                <div class="form-group"> 
                    <label class="control-label col-md-3" for="vg_name">ชื่อกลุ่มอาชีพ</label>
                    <div class="col-md-4 "><input type="text" class="form-control" id="vg_name" name="vg_name" value="<?php set_var($vg_name)?>" ></div>
                </div>
        </div> 

        <div class="form-group"> 
            <div class="col-md-offset-3"><button type="submit" class="btn btn-primary"name="submit">บันทึกข้อมูล</button></div>
        </div>
        </form>
    </div>
</div>

<?php require_once INC_PATH . 'footer.php'; ?>

<?php
function do_insert(){
    global $db;
    $data = &$_POST;
    $query = "INSERT INTO vocation_group (`vg_id`, `vg_name`) VALUES (".pq($data['vg_id']).",".pq($data['vg_name']).")";
    mysqli_query($db,$query);
    if(mysqli_affected_rows($db)>0){
        set_info('บันทึกข้อมูลเรียบร้อย');
    }  else {
        set_err('บันทึกข้อมูลไม่สำเร็จ '. mysqli_error($db));
    }
    redirect('vocation_group/list-vocation_group');
}

function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    
    if (!preg_match('/[0-9]{1,}/', $data['vg_id'])) {
        set_err('รหัสกลุ่มอาชีพเป็นตัวเลข');
        $valid = false;
    }
     
    if (empty($data['vg_id'])) {
        set_err('กรุณากรอกชื่อกลุ่มอาชีพ');
        $valid = false;
    }
    
    if (empty($data['vg_name'])) {
        set_err('กรุณากรอกรหัสกลุ่มอาชีพ');
        $valid = false;
    }
    
    return $valid;
}