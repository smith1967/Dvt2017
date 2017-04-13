<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
?>
<div>
    <div>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">หน้าหลัก</a></li>
            <li class='active'>จัดการระบบ</li>
        </ol>
    </div>
    <div class='submenu'>
        <?php
        $submenu = array(
            'home' => array(
                'title' => 'หน้าหลัก',
                'url' => 'school/file-manager',
                'cond' => true,
            ),
            'list-alluser' => array(
                'title' => 'จัดการผู้ใช้',
                'url' => 'school/list-alluser',
                'cond' => false,
            ),
            'upload-std' => array(
                'title' => 'จัดการไฟล์',
                'url' => 'school/file-manager',
                'cond' => true,
            ),
            'check-data' => array(
                'title' => 'ตรวจสอบข้อมูลschool',
                'url' => 'school/file-manager',
                'cond' => true,
            ),
            'list-school' => array(
                'title' => 'รายชื่อสถานศึกษา',
                'url' => 'school/list-data-school',
                'cond' => true,
            ),
            'school_type' => array(
                'title' => 'ประเภทสถานศึกษา',
                'url' => 'school/list-school-type',
                'cond' => true,
            ),
            'import-users-radius' => array(
                'title' => 'โอน/ลบข้อมูล users',
                'url' => 'school/import-users-radius',
                'cond' => false,
            ),
            'edit-group-config' => array(
                'title' => 'ตั้งค่ากลุ่มผู้ใช้',
                'url' => 'school/edit-group-config',
                'cond' => false,
            ),
//            'rep-alluser' => array(
//                'title' => 'รายงานการใช้',
//                'url' => 'user/rep-alluser',
//                'cond' => true,
//            ),
        );
        $menu_class = "nav nav-pills";
        echo gen_menu($menu_class, $submenu, $subactive);
        ?>
    </div>
</div>

