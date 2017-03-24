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
                'url' => 'business/index',
                'cond' => true,
            ),
            'list-alluser' => array(
                'title' => 'จัดการผู้ใช้',
                'url' => 'business/list-alluser',
                'cond' => true,
            ),
            'upload-std' => array(
                'title' => 'จัดการไฟล์',
                'url' => 'business/file-manager',
                'cond' => true,
            ),
            'check-data' => array(
                'title' => 'ตรวจสอบข้อมูล',
                'url' => 'business/check-data',
                'cond' => true,
            ),
            'list-user' => array(
                'title' => 'รายชื่อผู้ใช้',
                'url' => 'business/list-user',
                'cond' => false,
            ),
            'import-std-radius' => array(
                'title' => 'โอน/ลบข้อมูล std',
                'url' => 'business/import-std-radius',
                'cond' => true,
            ),
            'import-users-radius' => array(
                'title' => 'โอน/ลบข้อมูล users',
                'url' => 'business/import-users-radius',
                'cond' => true,
            ),
            'edit-group-config' => array(
                'title' => 'ตั้งค่ากลุ่มผู้ใช้',
                'url' => 'business/edit-group-config',
                'cond' => true,
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

