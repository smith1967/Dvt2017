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
    <div class="page-header">
        <h3 class="text-center">เมนูระบบงานสถานศึกษา</h3>
    </div>
    <div class="row">
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('school/list-school-type');?>">
                    <img src="<?php echo IMG_URL.'menu/school.png';?>" class="img-responsive" />                
            </a>
<!--            <a href="<?php echo site_url('school/list-school-type');?>" class="btn btn-link btn-lg btn-block" role="button">
            ข้อมูลสถานศึกษา
            </a>            -->
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('trainer/list-trainer');?>">
                    <img src="<?php echo IMG_URL.'menu/trainer.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('student/list-student');?>">
                    <img src="<?php echo IMG_URL.'menu/student1.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('training/list-training');?>">
                    <img src="<?php echo IMG_URL.'menu/training.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('mou/list-mou');?>">
                    <img src="<?php echo IMG_URL.'menu/mou.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('do_school_vg/list-do_school_vg');?>">
                    <img src="<?php echo IMG_URL.'menu/vg_do_school.png';?>" class="img-responsive" />                
            </a>
        </div>

    </div>
    <div class="row">
        <div class="col-md-offset-2 col-xs-4 col-md-2">
            <a href="<?php echo site_url('do_ems/list-do_ems');?>">
                    <img src="<?php echo IMG_URL.'menu/ems.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('do_business_vg/list-do_business_vg');?>">
                    <img src="<?php echo IMG_URL.'menu/vg_do_business.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('business/list-business');?>">
                    <img src="<?php echo IMG_URL.'menu/business.png';?>" class="img-responsive" />                
            </a>
        </div>
<!--        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>
        <div class="col-xs-4 col-md-2">
            <a href="<?php echo site_url('admin/list-user');?>">
                    <img src="<?php echo IMG_URL.'menu/school2.png';?>" class="img-responsive" />                
            </a>
        </div>-->
    </div>    
</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>


