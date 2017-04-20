<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "สถานศึกษา";
$active = 'home';
//$subactive = 'home';

require_once INC_PATH . 'header.php';
?>

</script>

<div class="container">
    <?php
    show_message();
    ?> 
    <div class="jumbotron">
        <h3 class="text-center">เมนูระบบงานสถานศึกษา</h3>
    </div>
    <div class="row">
        <div class=" col-xs-6 col-md-3">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-6 col-md-3">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
                    <a href="<?php echo site_url('admin/list-user') ?>"><img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" /></a>
        </div>
        <div class="col-md-3">.col-md-3</div>
        <div class="col-md-3">.col-md-3</div>
        <div class="col-md-3">.col-md-3</div>
    </div>    
</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>


