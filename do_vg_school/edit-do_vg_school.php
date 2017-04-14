<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลการร่วมมือ กรอ กับสถานศึกษา";
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
if(!isset($_GET['do_vg_school_id']))
    redirect('do_vg_school/list-do_vg_school');
if ($_GET['do_vg_school_id']) {
    $DoVgSchool = get_DoVgSchool($_GET['do_vg_school_id']);
    foreach ($DoVgSchool as $key => $value) {
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
            <div class="panel-heading">ข้อมูลการร่วมมือ กรอ กับสถานศึกษา</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_vg_school_id" class="col-md-3 control-label">รหัสการร่วมมือ กรอ กับสถานศึกษา</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" readonly="" id="do_vg_school_id" name="do_vg_school_id"value="<?php set_var($do_vg_school_id); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="do_vg_id">รหัส กรอ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="do_vg_id" name="do_vg_id" placeholder="Do Vg ID" value="<?php set_var($do_vg_id); ?>">
                        </div>
                    </div>      
                    <div class="form-group">
                        <label class="control-label col-md-3" for="school_id">รหัสสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_id" name="school_id" placeholder="School ID" value="<?php set_var($school_id); ?>">
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
<script>
   $(function() {

      $( "#school_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_school.php",
         minLength: 1
      });
   });
</script>
<?php
function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (empty($data['do_vg_id'])) {
        set_err('กรุณากรอกรหัส กรอ');
        $valid = false;
    }
    if (empty($data['school_id'])) {
        set_err('กรุณากรอกข้อมูลสถานศึกษา');
        $valid = false;
    }
    return $valid;
}
function do_editdoschoolvg() {
    global $db;
    $data = &$_POST;
    $query = "update do_vg_school set
	do_vg_id=" . pq($data['do_vg_id']) . ","
            . "school_id=" . pq($data['school_id']) ."
where do_vg_school_id = " . pq($data['do_vg_school_id']). ";";
    //echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
     redirect('do_vg_school/list-do_vg_school');
}

function get_DoVgSchool($do_vg_school_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_vg_school where do_vg_school_id = '$do_vg_school_id';";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
?>