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
if (isset($_POST['submit'])) {
	$data = $_POST;
    	$valid = do_validate($data);
	// 	check ความถูกต้องของข้อมูล
    if (!$valid) {
      //  show_message();
        foreach ($_POST as $k => $v) {
            $k = $v;
            // 			set variable to form
        }
        }else {
            do_update();
            echo  "school=>".$school_id;
            	//	ไม่มี error บันทึกข้อมูล
       }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'edit') {
        list_form_edit();
     }
    if ($_GET['action'] == 'del') {
        do_delete($school_id);
        echo "scho=>".$school_id;
    }
}else{
    list_form_init();
}
?>
        </table>
        </div>
    </div>  

<?php require_once INC_PATH . 'footer.php';?>

<script>
   $(function() {
     
      $( "#institute_id" ).autocomplete({
         source: "<?php echo SITE_URL ?>ajax/search_institute_1.php",
         minLength: 1
      });   
      
});
</script>
<?php function do_delete($school_id) {
    global $db;
    if (empty($school_id)) {
        set_err('ค่าพารามิเตอร์รหัสสถานศึกษาไม่ถูกต้อง11');
        redirect('school/list-school');
    }
    $query = "DELETE FROM school WHERE school_id =" . pq($school_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('school/list-school');
}

function do_update() {
global $db;
//$data = &$_POST;
$data = &$_POST;
//	var_dump($data);
//  exit();
    foreach ($_POST as $k => $v) {
    $k = pq($v);
		// 		set variable to form
	}
    $sql = "update school  set
	school_name=".pq($data['school_name']).","
            . "school_type_id=" . pq($data['school_type_id']) . ","
            . "address_no=" . pq($data['address_no']) . ","
            . "road=" . pq($data['road']) . ","
            . "address_no=" . pq($data['address_no']) . ","
            . "road=" . pq($data['road']) . ","
            . "tumbon=" . pq($data['district_id']) . ","
            . "aumphur=" . pq($data['aumphur_id']) . ","
            . "province=" . pq($data['province_id']) . ","
            . "postcode=" . pq($data['postcode']) . ","
            . "phone=" . pq($data['phone']) . ","
            . "fax=" . pq($data['fax']) . ","
            . "zone=" . pq($data['zone']) . ","
            . "location=" . pq($data['location']) . ","
            . "catagory=" . pq($data['catagory']) . ","
            . "institute_id=" . pq($data['institute'])
            . " WHERE "
            . "school_id = " . pq($data['school_id']) . "";
    $result = mysqli_query($db, $sql);
	if ($result) {
		$_SESSION['info'][] = "แก้ไขเรียบร้อยครับ";
		redirect('school/list-data-school');
	}else {
		$_SESSION['err'][] = "แก้ไขข้อมูลไม่สำเร็จกรุณาตรวจสอบข้อมูล" . mysqli_error($db) . $sql;
		//redirect('school/list-data_school');
	}
}
function do_validate($data) {
	$valid = TRUE;

	if (empty($data['school_type_id'])) {
		set_err('กรุณาใส่รหัสประเภทของสถานศึกษา');
		$valid = FALSE;
	}
	if (empty($data['address_no'])) {
		set_err('กรุณาใส่ชื่อที่อยู่');
		$valid = FALSE;
	}
	if (empty($data['road'])) {
		set_err('กรุณาใส่ชื่อถนน');
		$valid = FALSE;
	}
	if (empty($data['district_id'])) {
		set_err('กรุณาใส่ตำบล');
		$valid = FALSE;
	}
	if (empty($data['aumphur_id'])) {
		set_err('กรุณาใส่ชื่ออำเภอ');
		$valid = FALSE;
	}
	if (empty($data['province_id'])) {
		set_err('กรุณาใส่ชื่อจังหวัด');
		$valid = FALSE;
	}
	if (empty($data['postcode'])) {
		set_err('กรุณาใส่รหัสไปรษณีย์');
		$valid = FALSE;
	}
	if (empty($data['phone'])) {
		set_err('กรุณาใส่เบอร์โทรศัพท์');
		$valid = FALSE;
	}
	if (empty($data['fax'])) {
		set_err('กรุณาใส่เบอร์ Fax');
		$valid = FALSE;
	}
	if (empty($data['zone'])) {
		set_err('กรุณาใส่ภาค');
		$valid = FALSE;
	}
	return $valid;
	/* ----End Validate ---- */
}
function list_form_edit(){
    global $school_id;
    global $db;
    	$sql = "SELECT * from school WHERE school_id='$school_id'";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result);
 ?>
  <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="school_id">รหัสสถานศึกษา:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="school_id" value="<?php echo $row['school_id'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="school_name">ชื่อสถานศึกษา:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="school_name" value="<?php echo $row['school_name'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="school_type_id">ประเภทของสถานศึกษา:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="school_type_id" value="<?php echo $row['school_type_id'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="address_no">ที่อยู่:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="address_no" value="<?php echo $row['address_no'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="road">ถนน:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="road" value="<?php echo $row['road'] ?>">
                    </div>
                </div>
               
                
                 <div class="form-group">
                        <label for="province_id" class="col-md-2 control-label">จังหวัด</label>
                        <div class="col-md-3">
                            <select class="form-control select2-single" id="province_id" name="province_id">
                                <option id="province_id_list"> -- กรุณาเลือกจังหวัด -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aumphur_id" class="col-md-2 control-label">อำเภอ</label>
                        <div class="col-md-3">
                            <select class="form-control select2-single" id="aumphur_id" name="aumphur_id">
                                    <option id="amphur_id_list"> -- กรุณาเลือกอำเภอ -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="district_id" class="col-md-2 control-label">ตำบล</label>
                        <div class="col-md-3">
                            <select class="form-control select2-single" id="district_id" name="district_id">
                                    <option id="district_id_list"> -- กรุณาเลือกตำบล -- </option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="postcode">รหัสไปรษณีย์:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="postcode" value="<?php echo $row['postcode'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="phone">โทรศัพท์:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="postcode">โทรสาร:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="fax" value="<?php echo $row['fax'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="zone">ภาค:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="zone" value="<?php echo $row['zone'] ?>">
                    </div>
                </div>
                 <div class="form-group">
                        <label for="location" class="col-md-2 control-label">พิกัดที่ตั้ง</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="do_location" name="location" value="<?php echo $row['location']  ?>" placeholder="x,y" >
                        </div>
                    </div>
                 <div class="form-group">
                        <label for="catagory1" class="col-md-2 control-label">สังกัดหน่วยงาน</label>
                        <div class="col-md-6">
                            <select class="form-control" id="do_catagory" name="catagory">
                             <option value="รัฐบาล">รัฐบาล</option>
                             <option value="เอกชน">เอกชน</option>
                             <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>                      
                 </div>
                 <div class="form-group"> 
                    <label class="control-label col-md-2 control-label " for="institute_id">รหัสสถาบัน</label>
                    <div class="col-md-6 "><input type="text" class="form-control" id="institute_id" placeholder="ชื่อสถาบัน" name="institute" value="<?php set_var($institute_id)?>">
                
                  </div>
                </div>
                
                   

                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-6">
                        <input type="submit" name="submit" value="บันทึกแก้ไขข้อมูล" class="btn btn-default" >
                    </div>
                </div>
                
            </form>
<?php
} // end list_form_edit()

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
sh.tumbon,
sh.aumphur,
sh.province,
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
sh.province = pv.PROVINCE_CODE AND
sh.tumbon = dt.DISTRICT_CODE AND
sh.aumphur = am.AMPHUR_CODE AND
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
        echo $row['province'];
        echo "(" ;
        echo $row['PROVINCE_NAME'];
        echo ")";     
        
        ?> </td>
     </tr>
      <tr>
      <td>อำเภอ</td>
       <td> <?php 
        echo $row['aumphur'];
        echo "(" ;
        echo $row['AMPHUR_NAME'];
        echo ")";     
        
        ?> </td>
     </tr>
     
     <tr>
     <td>ตำบล</td>
        <td> <?php 
        echo $row['tumbon'];
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
     <td>  <a href="index.php?school/list-data-school&action=edit">แก้ไขข้อมูล<span class="glyphicon glyphicon-pencil"></span></a> </td>
     </tr>  
     
    </tbody>
  </table>
</div>


<?php
}//end list_form_init(){
?>
    
<script>
			
$(function(){

        //เรียกใช้งาน Select2
        $(".select2-single").select2();

        //ดึงข้อมูล province จากไฟล์ get_data.php
        $.ajax({
                url:"<?php echo SITE_URL ?>ajax/get_data.php",
                dataType: "json", //กำหนดให้มีรูปแบบเป็น Json
                data:{show_province:'show_province'}, //ส่งค่าตัวแปร show_province เพื่อดึงข้อมูล จังหวัด
                success:function(data){

                        //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data
                        $.each(data, function( index, value ) {
                                //แทรก Elements ใน id province  ด้วยคำสั่ง append
                                  $("#province_id").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                        });
                }
        });


        //แสดงข้อมูล อำเภอ  โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่ #province
        $("#province_id").change(function(){

                //กำหนดให้ ตัวแปร province มีค่าเท่ากับ ค่าของ #province ที่กำลังถูกเลือกในขณะนั้น
                var province_id = $(this).val();

                $.ajax({
                        url:"<?php echo SITE_URL ?>ajax/get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{province_id:province_id},//ส่งค่าตัวแปร province_id เพื่อดึงข้อมูล อำเภอ ที่มี province_id เท่ากับค่าที่ส่งไป
                        success:function(data){

                                //กำหนดให้ข้อมูลใน #amphur เป็นค่าว่าง
                                $("#aumphur_id").text("");

                                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                                $.each(data, function( index, value ) {

                                        //แทรก Elements ข้อมูลที่ได้  ใน id amphur  ด้วยคำสั่ง append
                                          $("#aumphur_id").append("<option value='"+ value.id +"'> " + value.name + "</option>");
                                });
                                $("#aumphur_id").change();
                        }
                });

        });

        //แสดงข้อมูลตำบล โดยใช้คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #amphur
        $("#aumphur_id").change(function(){
                //กำหนดให้ ตัวแปร amphur_id มีค่าเท่ากับ ค่าของ  #amphur ที่กำลังถูกเลือกในขณะนั้น
                var amphur_id = $(this).val();
                $.ajax({
                        url:"<?php echo SITE_URL ?>ajax/get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{amphur_id:amphur_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                        success:function(data){
//                                console.log(JSON.stringify(data))
                                //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
                                $("#district_id").text("");

                                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                                $.each(data, function( index, value ) {
                                //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
                                    $("#district_id").append("<option value='" + value.id + "'> " + value.name + "</option>");

                                });
                                $("#district_id").change();
                        }
                });

        });

        //คำสั่ง change จะทำงานกรณีมีการเปลี่ยนแปลงที่  #district 
        $("#district_id").change(function(){
                var district_id = $(this).val();
                $.ajax({
                        url:"<?php echo SITE_URL ?>ajax/get_data.php",
                        dataType: "json",//กำหนดให้มีรูปแบบเป็น Json
                        data:{district_id:district_id},//ส่งค่าตัวแปร amphur_id เพื่อดึงข้อมูล ตำบล ที่มี amphur_id เท่ากับค่าที่ส่งไป
                        success:function(data){
//                                console.log(JSON.stringify(data))
                                //กำหนดให้ข้อมูลใน #district เป็นค่าว่าง
//                                $("#postcode").val(JSON.stringify(data));

                                //วนลูปแสดงข้อมูล ที่ได้จาก ตัวแปร data  
                                $.each(data, function( index, value ) {
                                //แทรก Elements ข้อมูลที่ได้  ใน id district  ด้วยคำสั่ง append
//                                   console.log(index);
                                    $("#postcode").val(value.id);                     
//                                $("#district_id").append("<option value='" + value.id + "'> " + value.name + "</option>");
                                });
                        }
                });

                //นำข้อมูลรายการ จังหวัด ที่เลือก มาใส่ไว้ในตัวแปร province
                var province = $("#province_id option:selected").text();

                //นำข้อมูลรายการ อำเภอ ที่เลือก มาใส่ไว้ในตัวแปร amphur
                var amphur = $("#aumphur_id option:selected").text();

                //นำข้อมูลรายการ ตำบล ที่เลือก มาใส่ไว้ในตัวแปร district
                var district = $("#district_id option:selected").text();

                //ใช้คำสั่ง alert แสดงข้อมูลที่ได้
//                alert("คุณได้เลือก :  จังหวัด : " + province + " อำเภอ : "+ amphur + "  ตำบล : " + district );
        });
});

</script>


    