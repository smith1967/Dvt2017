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
                'title' => 'ข้อมูลนักเรียน',
                'url' => 'student/index',
                'cond' => true,
            ),
            'list-alluser' => array(
                'title' => 'จัดการผู้ใช้',
                'url' => 'student/list-alluser',
                'cond' => false,
            ),
            'upload-std' => array(
                'title' => 'จัดการไฟล์',
                'url' => 'student/file-manager',
                'cond' => true,
            ),
            'check-data' => array(
                'title' => 'ตรวจสอบข้อมูลไฟล์',
                'url' => 'student/check-data',
                'cond' => true,
            ),
            'import-std' => array(
                'title' => 'โอนเข้าแฟ้มชั่วคราว ตรวจสอบจำนวนนักเรียน',
                'url' => 'student/import-std',
                'cond' => true,
            ),
            'import-dvt-student' => array(
                'title' => 'โอนข้อมูลนักเรียนทวิภาคี',
                'url' => 'student/import-dvt-student',
                'cond' => true,
            ),
            'list-student' => array(
                'title' => 'แก้ไขข้อมูลนักเรียน',
                'url' => 'student/list-student',
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

