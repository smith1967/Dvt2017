<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
//is_admin('home/index');
$title = "ตรวจสอบข้อมูล";
$active = 'school';
$subactive = 'check-data';
if (!isset($_GET['filename']))
    redirect('school/file-manager');
?>

<?php require_once INC_PATH . 'header.php'; ?>
<?php require_once INC_PATH . 'config.php'; ?>
<div class="container">
    <?php include_once INC_PATH . 'submenu-school.php'; ?>
    <?php
    show_message();
    //yearid,sch_id,sch_tname,sch_ename,sch_typeid,director,build_date,homecode,homeid,moo,soi,street,districtid,postcode,tel,fax,website,email,area_rai,area_ngan,area_wa,utm_x,utm_y,utm_zone,std_comp,man_comp,subdirect1,subdirect2,subdirect3,subdirect4,pin_direct,pin_sub1,pin_sub2,pin_sub3,pin_sub4
   
    if (isset($_GET['action']) && $_GET['action'] == 'import' && $_GET['type'] == 'sch') {
        $filename = UPLOAD_DIR . $_GET['filename'];
        do_transfer_std($filename);
    }
    if (isset($_GET['action']) && $_GET['action'] == 'import' && $_GET['type'] == 'users') {
        $filename = UPLOAD_DIR . $_GET['filename'];
        do_transfer_users($filename);
    }
 //http://localhost/dvt2017/index.php?student/check-data&action=check&filename=2017-03-22_Sch_20026101_2560_2.CSV
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'check') {
            $filename = UPLOAD_DIR . $_GET['filename'];
            if (validate_sch_file($filename)) {
                $importlink = site_url('school/check-data') . '&action=import&type=sch&filename=' . $_GET['filename'];
                echo '<div class="alert alert-success col-md-4">ข้อมูลแฟ้ม sch ถูกต้อง <a href= ' . $importlink . '>โอนแฟ้มข้อมูลschool </a></div>';               
               
            } elseif (validate_users_file($filename)) {
                $importlink = site_url('school/check-data') . '&action=import&type=users&filename=' . $_GET['filename'];
                echo '<div class="alert alert-success col-md-4">ข้อมูลแฟ้มผู้ใช้งานถูกต้อง <a href= ' . $importlink . '>โอนแฟ้มข้อมูล </a></div>';

            } else {
                $uploadlink = site_url('school/file-manager');
                echo '<div class="alert alert-warning col-md-4">ข้อมูลไม่ถูกต้องกลับไป <a href= ' . $uploadlink . '>จัดการแฟ้มข้อมูล </a></div>';
                //die("not valid");
            }
            }
        }
        ?>     
    </div>

</div> <!--End Main container -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function validate_sch_file($filename) {
    $handle = fopen($filename, "r");
    print_r(fgetcsv($handle));
    $col_names = fgetcsv($handle);
    $valid = TRUE;
    // -- fields sch
    $schcol = array('yearid','sch_id','sch_tname','sch_ename','sch_typeid');
    //yearid,sch_id,sch_tname,sch_ename,sch_typeid,director,build_date,homecode,homeid,moo,soi,street,districtid,postcode,tel,fax,website,email,area_rai,area_ngan,area_wa,utm_x,utm_y,utm_zone,sch_comp,man_comp,subdirect1,subdirect2,subdirect3,subdirect4,pin_direct,pin_sub1,pin_sub2,pin_sub3,pin_sub4
    //years,semester,school_id,depart_id,people_id,perfix_id,stu_fname,stu_lname,gender_id,birthday,nation_id,home_id,moo,street,tumbol_id,cripple_id,tall,weight,fat_fname,fat_lname,fat_crippl,fat_status,fat_salary,fat_occupa,mot_fname,mot_lname,mot_crippl,mot_status,mot_salary,mot_occupa,marry_stat,brother,study_brot,par_fname,par_lname,par_salary,par_occupa,start_year,level_id,schedu_id,grade_id,major_id,gpa,stu_expert,student_id,group_id,nickname,religion,b_provite,graduate,fat_tell,par_tell,sch_blgr,sch_edu_id,bud_edu_id,type_id,bud_typeid,major_name,minor_name,homecode,endyear,end_edu_id,end_status,work_id,job_id,job_place,j_position,job_salary,knowlageid,knowlage,job_search,typeschool,moemajors,curri_id,scoo,da_prename,ma_prename,add1,moo1,road1,tumb1,post1,post2,day_in,sch_fname,sch_lname

//    $schcol = array('code','pin_id','fname','lname','gro');
//    code,pre_name,fname,lname,birt,pin_id,std_level,gro

//     check header csv
//print_r($col_names);
    foreach ($schcol as $col) {
        if (!in_array($col, $col_names)) {
            $valid = FALSE;
             
        }
    }
    
    fclose($handle);
    return $valid;
}

function validate_users_file($filename) {
    $handle = fopen($filename, "r");
    //print_r(fgetcsv($file));
    $col_names = fgetcsv($handle);
    //var_dump($col_names);
    $valid = TRUE;
// -- table cols
    $dbcol = array('username', 'password', 'fname', 'lname', 'groupname');
    // check header csv
    foreach ($dbcol as $col) {
        if (!in_array($col, $col_names)) {
            $valid = FALSE;
        }
    }
    fclose($handle);
    return $valid;
}

function do_transfer_std($stdfile) {
   // echo "ssss";exit();
    global $db;
// -- fields std
    //$stdcol = array('student_id', 'people_id', 'stu_fname', 'stu_lname', 'group_id');
// -- table cols
    //$dbcol = array('std_id', 'pid', 'fname', 'lname', 'groupname');
    /* insert data to table tmp */
    $handle = fopen($stdfile, "r");
// get header column from file     
    //$cols = fgetcsv($handle);
   // $colindex = array();   // --- get index of array
    //foreach ($stdcol as $value) {
   //     $colindex[] = array_search($value, $cols);
   // }
    //$stdcharset = "";
    //ลบข้อมูล temp table
   // $sql_t = "TRUNCATE TABLE student_tmp ";
  //  $res=mysqli_query($db, $sql_t);


    $num_row=0;
    $count =0;
	$count2 =0;
    while (!feof($handle)) {
        $data_str = fgetcsv($handle);
  //    print_r($data); exit(); //====================
        if ($data_str[0]!=''){
            $str_comma = implode(",", $data_str);
        
 //       print_r($str_comma);exit(); //====================
 //       if (empty($stdcharset))
        //    $stdcharset = mb_detect_encoding($str, "UTF-8", TRUE) ? "UTF-8" : "TIS-620";

      //      $line = iconv("TIS-620", "UTF-8", $data) ;  //แปลง ansi เป็น utf-8
    //  mb_internal_encoding("UTF-8");
            $line = iconv("TIS-620", "UTF-8", $str_comma);
            $data = explode(",", $line);
        }
        //    print_r($line); exit();
     //   echo $line; exit();
       //     $str_comma = explode(",", $str);
        //die($line);

//print_r($data);exit(); //====================
//std_edu_id =$data[53]=>1=ปกติ  2=ทวิภาคี

        $num_row++;
        if ($num_row>2 && $data[0]!=null ){            
			$count++;
			//$name=getSerName($data[5]).$data[6]."  ".$data[7];
			//$dofb=chDay1($data[9]);
			//$sex=convSex($data[8]);
           // $minor_id=getminorId($data[58]);
            //$major_id=getmajorId($data[57]);
			$strsql = "update school SET ";
                        $strsql .= "type_id='$data[4]',";
                        $strsql .= "address_no='$data[8]',";
                        $strsql .= "road='$data[11]',";
                        $strsql .= "postcode='$data[13]',";
                        $strsql .= "phone='$data[14]',";
                        $strsql .= "fax='$data[15]'";
                        $strsql .= "WHERE school_id ='$data[1]'";
			$strsql .=";";
			//echo "sql=".$strsql.'<br>';exit();
       // echo 'zzz='.$count;
			$res = mysqli_query($db,$strsql);
         //   if ($count==3)exit();
			if ($res){
				$count2++;
			}
		}
    }
     echo "school <br />";
    echo "ข้อมูลจำนวน ".$count." แถว <br>";
    echo "นำเข้าข้อมูลจำนวน ".$count2." แถว";
    redirect('school/list-data_school');
    
        /*
        if (strlen($line)) {
            $row = array();
            $row = explode(",", $line);
            $val = array();
            foreach ($colindex as $v) {
                $val[] = pq($row[$v]);
            }
            $arr[] = '(' . implode(",", $val) . ')';    //  set of data array((1,2,3),(4,5,6),..);
        }
    }
    fclose($handle);
    $values = implode(",", $arr);                   // -- group set data  (1,2,3),(4,5,6),...
    $cols = "(" . implode(",", $dbcol) . ")";
    


    

    $query = "INSERT INTO stdtemp " . $cols . " VALUES " . $values;
    //die($query);
    mysqli_query($db, $query);
    */

   
    if (mysqli_affected_rows($db)) {
        set_info('โอนข้อมูลจำนวน ' . mysqli_affected_rows($db) . ' ใส่ตารางชั่วคราว');
        redirect('school/file-manager');
    } else {
        set_err("การโอนข้อมูลใส่ตารางชั่วคราวผิดพลาด : " . mysqli_error($db));
        //die();
    }
   // redirect('student/file-manager');
}

function do_transfer_users($usersfile) {
    global $db;
    $stdcol = array('student_id', 'people_id', 'stu_fname', 'stu_lname', 'group_id');
// -- table cols
    $dbcol = array('username', 'password', 'fname', 'lname', 'groupname');
    /* insert data to table tmp */
    $handle = fopen($usersfile, "r");
// get header column from file     
    $cols = fgetcsv($handle);
    $colindex = array();   // --- get index of array
    foreach ($dbcol as $value) {
        $colindex[] = array_search($value, $cols);
    }
    $stdcharset = "";
    while (!feof($handle)) {
        $str = fgetcsv($handle);
        $str_comma = implode(",", $str);
        if (empty($stdcharset))
            $stdcharset = mb_detect_encoding($str_comma, "UTF-8", TRUE) ? "UTF-8" : "TIS-620";
        $line = ($stdcharset == 'TIS-620') ? iconv("tis-620", "utf-8", $str_comma) : $line = $str_comma;
        //die($line);
        if (strlen($line)) {
            $row = array();
            $row = explode(",", $line);
            $val = array();
            foreach ($colindex as $v) {
                $val[] = pq($row[$v]);
            }
            $arr[] = '(' . implode(",", $val) . ')';    //  set of data array((1,2,3),(4,5,6),..);
        }
    }
    fclose($handle);
    $values = implode(",", $arr);                   // -- group set data  (1,2,3),(4,5,6),...
    $cols = "(" . implode(",", $dbcol) . ")";
    $sql = "TRUNCATE TABLE `users_temp`";
    mysqli_query($db, $sql);
    $query = "INSERT INTO users_temp " . $cols . " VALUES " . $values;
   // die($query);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('โอนข้อมูลจำนวน ' . mysqli_affected_rows($db) . ' ใส่ตารางชั่วคราว');
        //redirect('admin/file-manager');
    } else {
        set_err("การโอนข้อมูลใส่ตารางชั่วคราวผิดพลาด : " . mysqli_error($db));
        //die();
    }
    redirect('school/file-manager');
}

function getSerName($id){
	if ($id==002){
		return "นาย";
	}else if($id==003){
		return "นางสาว";
	}
}

function chDay1($s){
	$d=explode("/",$s);
//print_r($d);
	$y=$d[2]-543;
	return $y."-".$d[1]."-".$d[0];
}

function getmajorId($s){
    global $db;
    $sql="select * from major where major_name='$s' " ; 
    $res=mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);
	return $row['major_id'];
}
function getminorId($s){
    global $db;
    $sql="select * from minor where minor_name='$s' " ; 
    $res=mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($res);
	return $row['minor_id'];
}