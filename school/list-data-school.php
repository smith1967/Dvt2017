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
            . "tumbon=" . pq($data['tumbon']) . ","
            . "aumphur=" . pq($data['aumphur']) . ","
            . "province=" . pq($data['province']) . ","
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
	if (empty($data['tumbon'])) {
		set_err('กรุณาใส่ตำบล');
		$valid = FALSE;
	}
	if (empty($data['aumphur'])) {
		set_err('กรุณาใส่ชื่ออำเภอ');
		$valid = FALSE;
	}
	if (empty($data['province'])) {
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
                    <label class="control-label col-sm-2" for="tumbon">ตำบล:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="tumbon" value="<?php echo $row['tumbon'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="aumphur">อำเภอ:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="aumphur" value="<?php echo $row['aumphur'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="province">จังหวัด:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="province" value="<?php echo $row['province'] ?>">
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
$sql = "SELECT * from school WHERE school_id='$school_id'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

?>
    <div class="table-responsive col-md-12">
        <table class="table table-hover">
            <thead><th>รหัส</th><th>ชื่อ</th><th>ประเภท</th><th>ที่อยู่</th><th>ถนน</th><th>ตำบล</th>
            <th>อำเภอ</th><th>จังหวัด</th><th>รหัสไปรษณีย์</th><th>โทรศัพท์</th><th>โทรสาร</th><th>ภาค</th><th>พิกัด</th><th>สังกัดหน่วยงาน</th><th>สังกัดสถาบัน</th><th>แก้ไข</th></thead>
            <tbody>   <tr>
                    <td> <?php echo $row['school_id'];?></td>
                    <td> <?php echo $row['school_name'];?></td>
                    <td> <?php echo $row['school_type_id']; ?></td>
                    <td> <?php echo $row['address_no'];?> </td>
                    <td> <?php echo $row['road']; ?> </td>
                    <td> <?php echo $row['tumbon'];?> </td>
                    <td> <?php echo $row['aumphur'];?> </td>
                    <td> <?php echo $row['province'];?> </td>
                    <td> <?php echo $row['postcode'];?> </td>
                    <td> <?php echo $row['phone'];?> </td>
                    <td> <?php echo $row['fax'];?> </td>
                    <td> <?php echo $row['zone'];?> </td>
                    <td> <?php echo $row['location'];?> </td>
                    <td> <?php echo $row['catagory'];?> </td>
                    <td> <?php echo $row['institute_id'];?> </td>
                    <td class="text-center"><a href="index.php?school/list-data-school&action=edit"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    
                </tr>
                </tbody>

<?php
}//end list_form_init(){
?>
    


    