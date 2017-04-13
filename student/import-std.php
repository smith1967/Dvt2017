<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "โอนข้อมูล std เข้า table เฉพาะทวิภาคี";
$active = 'admin';
$subactive = 'import-std';
is_admin('home/index');

 // do_import_all_std();
 //do_import_std();

?>
<?php require_once INC_PATH . 'header.php'; ?>
<div class="container">
    <?php include_once INC_PATH . 'submenu-student.php'; ?>
    <?php
    show_message();
   
    ?>     
<p></p>
    <div class="col-md-8">
        <div class="panel panel-default">
        <?php
            $school_id=$_SESSION['user']['school_id'];
            $data=do_show_std();
            //print_r($data);
        ?>
            <div class="table-responsive">
                <table class="table">
                     <thead>
                        <tr>
                            <th>จำนวนนักเรียนทั้งหมด <?php echo $data['sum_student'] ?> คน</th>
                            <th>จำนวนนักเรียนทวิภาคี <?php echo $data['sum_dvt_student'] ?> คน</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <p></p>
            <center>
            <button type="button" id="button1" class="btn btn-warning">ข้อมูลไม่ถูกต้อง ส่งข้อมูลใหม่</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" id="button2" class="btn btn-success">ข้อมูลถูกต้อง ไปขั้นตอนต่อไป</button>
            </center>
            <p></p>
        </div>
    </div>
<?php
      

?>

    <div class="table-responsive col-md-6">

    </div>   
</div>  
</div> <!--End Main container -->
<script>
    $('#button1').click(function() {
        // alert("aaa");
       // window.location = "www.example.com/index.php?id=" + this.id;
       window.location = "index.php?student/file-manager";
    });
    $('#button2').click(function() {
        // alert("aaa");
       // window.location = "www.example.com/index.php?id=" + this.id;
       window.location = "index.php?student/import-dvt-student&action=import_dvt_std";
    });

    $('.delete').click(function() {
        if (!confirm('ยืนยันลบข้อมูล')) {
            return false;
        }
    });
</script>
<?php require_once INC_PATH . 'footer.php'; ?>
<?php



function do_delete($val) {
    global $db;
   
    redirect('student/import-std');
}


function do_import_std() {
    global $db;
   //  transfer new data from tmp to student
    $sql = "REPLACE INTO student (`std_id`,`school_id`,`citizen_id`,`std_name`,`dateofbirth`,`sex`,`minor_id`,`major_id`,`type_code`,`end_edu_id`) 
    SELECT `std_id`,`school_id`,`citizen_id`,`std_name`,`dateofbirth`,`sex`,`minor_id`,`major_id`,`type_code`,`end_edu_id` 
    FROM `student_tmp` 
    WHERE `edu_id`=2;";
   // echo "sql= ".$sql; exit();
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) < 1) {
        set_err("การเพิ่มข้อมูลเข้าตาราง student ผิดพลาด  : " . mysqli_error($db));
        //redirect('form.php');
    } else {
        set_info('โอนข้อมูลนักเรียนทวิภาคี เข้าตาราง student จำนวน ' . mysqli_affected_rows($db) . ' รายการ');
      //  echo 'โอนข้อมูลเข้าตาราง student จำนวน ' . mysqli_affected_rows($db) . ' รายการ' ;
        //show_info($_SESSION['info']);
        echo '<div class="table-responsive col-md-6">';
        show_info($_SESSION['info']);
        echo '</div>';   
    }
   // redirect('student/import-std');
}

function do_show_std(){
    global $db;
    $sql="select 
    (SELECT count(`std_id`) FROM `student_tmp`) as sum_student,
    (SELECT count(`std_id`) FROM `student_tmp` where `edu_id`=2) as sum_dvt_student
    ";
    //echo $sql;
    $res=mysqli_query($db, $sql);
    $row=mysqli_fetch_assoc($res);
    //echo $row['sum_student'];
    return $row;
}


