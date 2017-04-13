<div class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $project; ?></a>
        </div>
        <div class="collapse navbar-collapse">
            <!--ul class="nav navbar-nav"-->
            <?php
            $menu = array(
                'home' => array(
                    'title' => 'หน้าหลัก',
                    'url' => 'home/index',
                    'cond' => true,
                ),
                'training' => array(
                    'title' => 'ข้อมูลการฝึกงาน',
                    'url' => 'training/list-training',
                    'cond' => isset($_SESSION['user']),
                ),
                'school' => array(
                    'title' => 'ข้อมูลสถานศึกษา',
                    'url' => 'school/list-school-type',
                    'cond' => isset($_SESSION['user']),
                ),
                'student' => array(
                    'title' => 'ข้อมูลนักศึกษา',
                    'url' => 'student/list-student',
                    'cond' => isset($_SESSION['user']),
                ),
                'signup' => array(
                    'title' => 'ลงทะเบียน',
                    'url' => 'user/signup',
                    'cond' => !isset($_SESSION['user']),
                ),
//                'change-password' => array(
//                    'title' => 'แก้ไขรหัสผ่าน',
//                    'url' => 'user/change-password',
//                    'cond' => true,
//                ),
                'business' => array(
                    'title' => 'ข้อมูลสถานประกอบการ',
                    'url' => 'business/list-business',
                    'cond' => isset($_SESSION['user']),
                ),
                'edit-user' => array(
                    'title' => 'แก้ไขข้อมูลผู้ใช้',
                    'url' => 'user/edit-user',
                    'cond' => is_auth(),
                ),
//                'admin' => array(
//                    'title' => 'จัดการระบบ',
//                    'url' => 'admin/index',
//                    'cond' => is_admin(),
//                ),

                'logout' => array(
                    'title' => 'ออกระบบ',
                    'url' => 'user/logout',
                    'cond' => isset($_SESSION['user']),
                ),
                'login' => array(
                    'title' => 'เข้าระบบ',
                    'url' => 'user/login',
                    'cond' => !isset($_SESSION['user']),
                ),
            );
            $menu_class = "nav navbar-nav";
            echo gen_menu($menu_class, $menu, $active);
            ?> 
            <?php
            echo isset($_SESSION['user']) ? '<p class="navbar-text navbar-right">คุณ' . $_SESSION['user']['fname'] . ' กำลังอยู่ในระบบ</p>' : '';
            ?>

        </div><!--/.nav-collapse -->
    </div>
</div>
