<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
?>
<div>
    <div>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">หน้าหลัก</a></li>
            <li class='active'>จัดการข้อมูลการทำความร่วมมือ</li>
        </ol>
    </div>
    <div class='submenu'>
        <?php
        $submenu = array(
//            'home' => array(
//                'title' => 'หน้าหลัก',
//                'url' => 'business/index',
//                'cond' => true,
//            ),
            'list' => array(
                'title' => 'รายชื่อสถานประกอบการ',
                'url' => 'do_business_vg/list-do_business_vg',
                'cond' => true,
            ),
            'edit' => array(
                'title' => 'แก้ไขข้อมูลสถานประกอบการ',
                'url' => 'do_business_vg/edit-do_business_vg',
                'cond' => true,
            ),
            'insert' => array(
                'title' => 'เพิ่มสถานประกอบการ',
                'url' => 'do_business_vg/insert-do_business_vg',
                'cond' => true,
            ),
//            'edit-business' => array(
//                'title' => 'รายชื่อผู้ใช้',
//                'url' => 'business/list-user',
//                'cond' => false,
//            ),
//            'import-std-radius' => array(
//                'title' => 'โอน/ลบข้อมูล std',
//                'url' => 'business/import-std-radius',
//                'cond' => true,
//            ),
//            'import-users-radius' => array(
//                'title' => 'โอน/ลบข้อมูล users',
//                'url' => 'business/import-users-radius',
//                'cond' => true,
//            ),
//            'edit-group-config' => array(
//                'title' => 'ตั้งค่ากลุ่มผู้ใช้',
//                'url' => 'business/edit-group-config',
//                'cond' => true,
//            ),
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

