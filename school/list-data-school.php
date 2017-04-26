<?php
global $school_id;
$school_id=$_SESSION['user']['school_id'];
//$check=$_GET['action'];
if (!defined('BASE_PATH'))exit('No direct script access allowed');
$title = "อัพโหลดไฟล์และตรวจสอบข้อมูล";
$active = 'school';
$subactive = 'list-school';
// is_admin('home/index');
?>
<?php require_once INC_PATH . 'header.php';?>

<div class='container'>
    <?php include_once INC_PATH . 'submenu-school.php';?>
    <?php
 show_message();
?> 
    <div class="page-header">
        <h3>รายชื่อสถานศึกษา</h3>
    </div>
<?php

list_form_init();

?>
        </table>
        </div>
    </div>  

<?php require_once INC_PATH . 'footer.php';?>

<?php
function list_form_init(){
    global $school_id;
    global $db;
// $sql1 = "SELECT * from school WHERE school_id='$school_id'";
// $result1 = mysqli_query($db, $sql);
// $row1 = mysqli_fetch_array($result1);
$sql = "SELECT
pv.PROVINCE_CODE,
pv.PROVINCE_NAME,
dt.DISTRICT_CODE,
dt.DISTRICT_NAME,
am.AMPHUR_CODE,
am.AMPHUR_NAME,
sh.school_id,
sh.school_name,
sh.school_type_id,
sh.address_no,
sh.road,
sh.district_id,
sh.aumphur_id,
sh.province_id,
sh.postcode,
sh.phone,
sh.fax,
sh.zone,
sh.location,
sh.catagory,
sh.institute_id,
ins.institute_id,
ins.institute_name
FROM
school AS sh ,
province AS pv ,
district AS dt ,
amphur AS am ,
institute AS ins
WHERE
sh.province_id = pv.PROVINCE_CODE AND
sh.district_id = dt.DISTRICT_CODE AND
sh.aumphur_id = am.AMPHUR_CODE AND
sh.institute_id = ins.institute_id AND 
sh.school_id = '$school_id' ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

?>
<div class="table-responsive  col-md-7">
 <table class="table table-hover table-striped">
    <thead>
      <tr>
        <th>คำนำหน้า</th>
        <th>รายการ</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>รหัส</td>
        <td> <?php echo $row['school_id'];?></td>
     </tr>
     <tr>
        <td>ชื่อสถานศึกษา</td>
        <td> <?php echo $row['school_name'];?></td>
     </tr>
     <tr>
        <td>ประเภทสถานศึกษา</td>
        <td> <?php echo $row['school_type_id']; ?></td>
     </tr>
     <tr>
        <td>ที่อยู่</td>
        <td> <?php echo $row['address_no'];?> </td>
     </tr>
     <tr>
        <td>ถนน</td>
       <td> <?php echo $row['road']; ?> </td>
     </tr>
     <tr>
        <td>จังหวัด</td>
        <td> <?php 
        echo $row['province_id'];
        echo "(" ;
        echo $row['PROVINCE_NAME'];
        echo ")";     
        
        ?> </td>
     </tr>
      <tr>
      <td>อำเภอ</td>
       <td> <?php 
        echo $row['aumphur_id'];
        echo "(" ;
        echo $row['AMPHUR_NAME'];
        echo ")";     
        
        ?> </td>
     </tr>
     
     <tr>
     <td>ตำบล</td>
        <td> <?php 
        echo $row['district_id'];
        echo "(" ;
        echo $row['DISTRICT_NAME'];
        echo ")";     
        
        ?> </td>
      
     <tr>
        <td>รหัสไปรษณีย์</td>
         <td> <?php echo $row['postcode'];?> </td>
     </tr>
     <tr>
        <td>โทรศัพท์</td>
        <td> <?php echo $row['phone'];?> </td>
     </tr>
     <tr>
        <td>โทรสาร</td>
        <td> <?php echo $row['fax'];?> </td>
     </tr>
     <tr>
        <td>ภาค</td>
        <td> <?php echo $row['zone'];?> </td>
     </tr>
     <tr>
        <td>พิกัด</td>
       <td> <?php echo $row['location'];?> </td>
     </tr>
      <tr>
        <td>สังกัดหน่วยงาน</td>
         <td> <?php echo $row['catagory'];?> </td>
     </tr>
     <tr>
        <td>สังกัดหน่วยงาน</td>
        <td> <?php 
        echo $row['institute_id'];
        echo "(" ;
        echo $row['institute_name'];
        echo ")";     
        
        ?> </td>
         
      <tr>
     <td>  <a href="index.php?school/edit-data-school&action=edit&school_id=<?php echo $school_id ?>">แก้ไขข้อมูล<span class="glyphicon glyphicon-pencil"></span></a> </td>
     </tr>  
     
    </tbody>
  </table>
</div>


<?php
}//end list_form_init(){
?>


    