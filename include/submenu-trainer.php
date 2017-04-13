<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
?>
<div>
    <div>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">หน้าหลัก</a></li>
            <li class='active'>จัดการข้อมูลครูฝึก</li>
        </ol>
    </div>
    <div class='submenu'>
        <?php
        $submenu = array(
            'list' => array(
                'title' => 'รายชื่อครูฝึก',
                'url' => 'trainer/list-trainer',
                'cond' => true,
            ),
            'insert' => array(
                'title' => 'เพิ่มข้อมูล',
                'url' => 'trainer/insert-trainer',
                'cond' => true,
            ),
            'edit' => array(
                'title' => 'แก้ไขข้อมูล',
                'url' => 'trainer/edit-trainer',
                'cond' => true,
            ),
//            'check-data' => array(
//                'title' => 'ตรวจสอบข้อมูล',
//                'url' => 'admin/check-data',
//                'cond' => true,
//            ),
//            'list-user' => array(
//                'title' => 'รายชื่อผู้ใช้',
//                'url' => 'admin/list-user',
//                'cond' => false,
//            ),
//            'import-std-radius' => array(
//                'title' => 'โอน/ลบข้อมูล std',
//                'url' => 'admin/import-std-radius',
//                'cond' => true,
//            ),
//            'import-users-radius' => array(
//                'title' => 'โอน/ลบข้อมูล users',
//                'url' => 'admin/import-users-radius',
//                'cond' => true,
//            ),
//            'edit-group-config' => array(
//                'title' => 'ตั้งค่ากลุ่มผู้ใช้',
//                'url' => 'admin/edit-group-config',
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

