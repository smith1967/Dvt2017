<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "แก้ไขข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน";
$active = 'do_business_vg';
$subactive = 'edit';
if (isset($_POST['submit'])) {
    $data = $_POST;
//    var_dump($data);
   $valid = do_validate($data);  // check ความถูกต้องของข้อมูล
    foreach ($_POST as $k => $v) {
        $$k = $v;  // set variable to form
    }
   
    if (!$valid) {
        
    } else {
        do_editdobusinessvg();
    }
}
if(!isset($_GET['do_business_vg_id']))
    redirect('do_business_vg/list-do_business_vg');
if ($_GET['do_business_vg_id']) {
    $DoBusinessVg = get_DoBusinessVg($_GET['do_business_vg_id']);
    foreach ($DoBusinessVg as $key => $value) {
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
            <div class="panel-heading">เพิ่มข้อมูลสถานศึกษา การร่วมภาครัฐและเอกชน</div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="">
                    <div class="form-group">
                        <label for="do_business_vg_id" class="col-md-3 control-label">รหัสการร่วมภาครัฐและเอกชน</label>
                        <div class="col-md-3">
                            <input type="hidden" class="form-control" id="do_business_vg_id" name="do_business_vg_id"value="<?php set_var($do_business_vg_id); ?>">
                           <?php set_var($do_business_vg_id); ?>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="vg_id" class="col-md-3 control-label">กลุ่มอาชีพ</label>
                        <div class="col-md-2">
                        
                            <?php
                            $sql = "select * from vocation_group";
                            $def = $DoBusinessVg['vg_id'];
                            ?>
                            <select class="form-control" id="vg_id" name="vg_id">
                                <?php
                                echo gen_option($sql, $def);
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="business_id">รหัสสถานประกอบการ</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="business_id" name="business_id" placeholder="Business ID" value="<?php set_var($business_id); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_vg" class="col-md-3 control-label">วันที่จดทะเบียน</label>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="registration_date"name="date_vg"value="<?php set_var($date_vg); ?>">
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
<?php 
require_once INC_PATH.'footer.php';                                
//var_dump($_SESSION['user']);
?>
<script>
   $(function() {

      $( "#business_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_business_1.php",
         minLength: 1
      });
   });
</script>
<?php
function do_validate($data) {
    $valid = true;
    $data = &$_POST;
    if (!preg_match('/[a-zA-Z0-9_]{1,}/', $data['vg_id'])) {
        set_err('กรุณาเลือกกลุ่มอาชีพ');
        $valid = false;
    }
    if (!preg_match('/[0-9]{1,}/', $data['business_id'])) {
        set_err('กรุณาเลือกสถานประกอบการ');
        $valid = false;
    }
    return $valid;
}
function do_editdobusinessvg() {
    global $db;
    $data = &$_POST;
    $query = "update do_business_vg set
	vg_id=" . pq($data['vg_id']) . ","
            . "business_id=" . pq($data['business_id']) . ","
            . "date_vg=" . pq($data['date_vg']) ."
where do_business_vg_id = " . pq($data['do_business_vg_id']). ";";
    // echo $query; exit();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 0) {
        set_err('ไม่สามารถแก้ไขข้อมูล');
    } else {
        set_info('แก้ไขข้อมูลสำเร็จ');
    }
     redirect('do_business_vg/list-do_business_vg');
}

function get_DoBusinessVg($do_business_vg_id = NULL) {
    global $db;
    $sql = "SELECT * FROM do_business_vg where do_business_vg_id = '$do_business_vg_id';";
    $rs = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($rs,MYSQLI_ASSOC);
    return $row;
}
?>