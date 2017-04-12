<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "โอนข้อมูล std เข้า table เฉพาะทวิภาคี";
$active = 'admin';
$subactive = 'import-dvt-student';
//is_admin('home/index');

 // do_import_all_std();
 //do_import_std();


?>
<?php require_once INC_PATH . 'header.php'; ?>
<div class="container">
    <?php include_once INC_PATH . 'submenu-student.php'; ?>
    
    <?php
    show_message();
    if (isset($_GET['action']) && $_GET['action'] == 'import_dvt_std' ) {
       do_import_all_std();
       do_import_std();
    }   
    
   
    ?>     
<p></p>
    <div class="col-md-8">
        <div class="panel panel-default">
       
        </div>
        <div class="table-responsive col-md-6">

        </div>   
    </div>  <!--end col-md-8-->
</div> <!--End Main container -->

<?php require_once INC_PATH . 'footer.php'; ?>



<?php
function do_import_all_std(){
    global $db;
    $sql="insert into sum_of_student 
        select `school_id`,`edu_year`,
        (SELECT count(`std_id`) FROM `student_tmp`) as sum_of_student,
        (SELECT count(`std_id`) FROM `student_tmp` where `edu_id`=2) as sum_of_dvt_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=2) as sum_of_vc_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=3) as sum_of_hvc_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=4) as sum_of_b_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=2 and `edu_id`=2) as sum_of_dvt_vc_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=3 and `edu_id`=2) as sum_of_dvt_hvc_student,
        (SELECT  count(`std_id`) FROM `student_tmp` WHERE substr(std_id,3,1)=4 and `edu_id`=2) as sum_of_dvt_b_student
        from `student_tmp` limit 0,1";
    $result= mysqli_query($db, $sql);
    if (!$result) {   
        $err="การเพิ่มข้อมูลเข้าตารางนับจำนวนนักเรียนผิดพลาด  : " . mysqli_error($db);
//        echo "<pre>";
//        print_r(mysqli_error_list($db));// [errno]=1062 =>Duplicate
//        echo "</pre>";       
        $errorlist=mysqli_error_list($db);
        //echo $errorlist[0]['errno'];
        $link = site_url('student/file-manager');
        if ($errorlist[0]['errno']==1062){
            echo '<div class="alert alert-danger">';
            echo "ข้อมูลในตารางนับจำนวนนักเรียนมีอยู่แล้วในระบบ ไม่สามารถส่งข้อมูลขึ้นระบบได้";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '<p class="text-info"> ต้องการส่งข้อมูลใหม่ กรุณาติดต่อผู้ดูแลระบบ</p>';
            echo '<a href="'.$link.'">กลับไปหน้าส่งไฟล์ข้อมูล</a>';
            echo '</div>';
        }else{
            echo '<div class="alert alert-danger">';
            echo $err.'<a href="'.$link.'">กลับไปหน้าส่งไฟล์ข้อมูล</a>';
            echo '</div>';
            
        }
    } else {
        $info='โอนข้อมูลเข้าตารางนับจำนวนนักเรียน จำนวน ' . mysqli_affected_rows($db) . ' รายการ';
      // echo 'โอนข้อมูลเข้าตาราง student จำนวน ' . mysqli_affected_rows($db) . ' รายการ' ;
        echo '<div class="alert alert-info">';
        echo $info;
        echo '</div>';
        
    }

}
function do_import_std() {
    global $db;
   //  transfer new data from tmp to student
    $sql = "insert INTO student (`std_id`,`school_id`,`citizen_id`,`std_name`,`dateofbirth`,`sex`,`minor_id`,`major_id`,`typcode`,`end_edu_id`) 
    SELECT `std_id`,`school_id`,`citizen_id`,`std_name`,`dateofbirth`,`sex`,`minor_id`,`major_id`,`typcode`,`end_edu_id` 
    FROM `student_tmp` 
    WHERE `edu_id`=2;";
   // echo "sql= ".$sql; exit();
    $result= mysqli_query($db, $sql);
    if (!$result) {
        $err="การเพิ่มข้อมูลเข้าตาราง student ผิดพลาด  : " . mysqli_error($db);
        $errorlist=mysqli_error_list($db);
        //echo $errorlist[0]['errno'];
        $link = site_url('student/file-manager');
        if ($errorlist[0]['errno']==1062){
            echo '<div class="alert alert-danger">';
            echo "ข้อมูลนักเรียนมีอยู่แล้วในระบบ ไม่สามารถส่งข้อมูลขึ้นระบบได้";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '<p class="text-info"> ต้องการส่งข้อมูลใหม่ กรุณาติดต่อผู้ดูแลระบบ</p>';
            echo '<a href="'.$link.'">กลับไปหน้าส่งไฟล์ข้อมูล</a>';
            echo '</div>';
        }else{
            echo '<div class="alert alert-danger">';
            echo $err;
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo '<p class="text-info"> ต้องการส่งข้อมูลใหม่ กรุณาติดต่อผู้ดูแลระบบ</p>';
            echo '<a href="'.$link.'">กลับไปหน้าส่งไฟล์ข้อมูล</a>';
            echo '</div>';
        }
        //redirect('form.php');
    } else {
        $info='โอนข้อมูลนักเรียนทวิภาคี เข้าตาราง student จำนวน ' . mysqli_affected_rows($db) . ' รายการ';
      //  echo 'โอนข้อมูลเข้าตาราง student จำนวน ' . mysqli_affected_rows($db) . ' รายการ' ;
        //show_info($_SESSION['info']);
        echo '<div class="alert alert-info">';
        echo $info;
        echo '</div>';   
    }
   // redirect('student/import-std');
}



