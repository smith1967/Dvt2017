<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'home';
is_admin('home/index');
// check condition
//if (isset($_POST)) {
//    $data = $_POST;
//    // transfer data
//    if (isset($data['tid'])) {
//        do_transfer($data);
//    }
//    /*     * *** delete data ****** */
//    if (isset($data['did'])) {
//        do_delete($data);
//    }
//}
require_once INC_PATH . 'header.php';
?>

</script>

<div class="container">
    <?php
    show_message();
    ?> 
    <div class="jumbotron">
        <h3 class="text-center">เมนูผู้ดูแลระบบ</h3>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">รายชื่อผู้ใช้งาน</h3>
                </div>
                <div class="panel-body">
                    <a href="<?php echo site_url('admin/list-user') ?>">รายชื่อผู้ใช้งาน</a>
                </div>
            </div>                
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">

                <div class="panel-body">
                    <a href="<?php echo site_url('admin/signup') ?>">เพิ่มผู้ใช้งาน</a>
                </div>
                <div class="panel-footer">
                    <h3 class="panel-title text-center"><a href="<?php echo site_url('admin/signup') ?>">เพิ่มผู้ใช้งาน</a></h3>
                </div>
            </div>                
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">เพิ่มผู้ใช้งาน</h3>
                </div>
                <div class="panel-body">
                    <a href="<?php echo site_url('admin/signup') ?>">เพิ่มชื่อผู้ใช้งาน</a>
                </div>
            </div>                
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">เพิ่มผู้ใช้งาน</h3>
                </div>
                <div class="panel-body">
                    <a href="<?php echo site_url('admin/signup') ?>">เพิ่มชื่อผู้ใช้งาน</a>
                </div>
            </div>                
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">.col-md-3</div>
        <div class="col-md-3">.col-md-3</div>
        <div class="col-md-3">.col-md-3</div>
        <div class="col-md-3">.col-md-3</div>
    </div>    
</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>

