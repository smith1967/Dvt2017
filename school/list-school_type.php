<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'school_type';
//is_admin('home/index');
?>
<?php require_once INC_PATH . 'header.php'; ?>
<div class="container">
    <?php include_once INC_PATH . 'submenu-school.php'; ?>
<?php
show_message();
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$action = isset($_GET['action']) ? $_GET['action'] : "list";
//    $group = isset($_GET['group']) ? $_GET['group'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : '';
$limit = isset($_GET['limit']) ? $_GET['limit'] : 40;
$params = array(
    'action' => $action,
    'limit' => $limit,
//        'group' => $group
);
$params = http_build_query($params);
$schoollist = get_school_type($page, $limit);
//    $total = get_total();
$url = site_url('school/list-school_type&') . $params;
//    var_dump($schoollist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if(isset($_POST['submit'])){  // update data
    do_update($_POST['type_name'],$_POST['school_type_id']);
}
if(isset($_GET['action'])){
    if($_GET['action']=='edit'){
      do_edit($_GET['school_type_id']);
   }
    if($_GET['action']=='delete'){
      do_delete($_GET['school_type_id']);
   }
   if($_GET['action']=='add'){
      do_save($_GET['school_type_id']);
   }
   if($_GET['action']=='add_new'){
    redirect('school/form_insert_school_type');//add input data
   }
}else{

?>
<script language="JavaScript" type="text/javascript">

function checkDelete(){
    return confirm('คุณแน่ใจหรือจะลบ?');
}
</script>
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
     <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <th>รหัสสถานศึกษา</th>
                    <th>ชื่อสถานศึกษา</th>
                    <th colspan="2">จัดการ</th>                  
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($schoollist as $school) :
                    ?>                            
                    <tr>
                       <td><?php echo $school['school_type_id']; ?></td>
                        <td><?php echo $school['type_name']; ?></td>
                        <td>
                            <a href="<?php echo site_url('school/list-school_type') . '&action=delete&school_type_id=' . $school['school_type_id']; ?>" class="delete" >ลบ</a>
                            <a href="<?php echo site_url('school/list-school_type') . '&action=edit&school_type_id=' . $school['school_type_id']; ?>" >แก้ไข</a>
                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <span class="col-sm-offset-11 col-sm-12">
                <a href="<?php echo site_url('school/list-school_type') . '&action=add_new'; ?>" ><span style="height: 80%" class="glyphicon glyphicon-plus-sign"></span></a>    
                    
            <span>        
    </div>           
        </table>
    </div>
</div> <!-- Main contianer -->
<?php 
    } 

function get_school_type($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM school_type ORDER BY school_type_id ASC LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $schoollist = array();
    while ($row = mysqli_fetch_array($result)) {
        $schoollist[] = $row;
    }
    return $schoollist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM school ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_update($type_name,$school_type_id) {
    echo "update";
    global $db;
    if (empty($type_name)) {
        //echo "empty";
        set_err('กรุณาใส่ชื่อสถานศึกษา');
        redirect('school/list-school_type');
    }
        echo "school_type_id=".$school_type_id;
        $query = "UPDATE school_type SET type_name='$type_name' WHERE school_type_id =" . pq($school_type_id);
        $result=mysqli_query($db, $query);
        if ($result) {
            set_info('ปรับปรุงข้อมูลสำเร็จ');
        }else{
            set_err('ปรับปรุงข้อมูลไม่สำเร็จ');
        }
        redirect('school/list-school_type');
}

function do_delete($school_type_id) {
    global $db;
    if (empty($school_type_id)) {
        set_err('ค่าพารามิเตอร์รหัสสถานศึกษาไม่ถูกต้อง');
        redirect('school/list-school_type');
    }
    $query = "DELETE FROM school_type WHERE school_type_id =" . pq($school_type_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('school/list-school_type');
}

function do_save($type_id) {
    global $db;
    if (empty($school_type_id)) {
        set_err('ค่าพารามิเตอร์รหัสสถานศึกษาไม่ถูกต้อง');
        redirect('school/list-school_type');
    }
    $query = "DELETE FROM school_type WHERE school_type_id =" . pq($school_type_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('school/list-school_type');
}

function do_edit($school_type_id) {
    global $db;
   // echo "type_id=".$_GET['type_id'];
    if (empty($school_type_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
       // redirect('school/list-school');
    }
    $sql = "SELECT * FROM school_type WHERE school_type_id =" . pq($school_type_id);
  // $sql = "SELECT FROM school_type WHERE type_id ='08' ";
    $result=mysqli_query($db, $sql);
    $row=mysqli_fetch_array($result);
    ?>
    
       <div class="panel-body">
                <form class="form-horizontal" id="school_type_id" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-md-3"   for="school_type_id">รหัสสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="school_type_id" name="school_type_id" placeholder="school_type_id" value="<?php echo $row['school_type_id'] ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3" for="type_name">ชื่อประเภทสถานศึกษา</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="type_name" name="type_name" placeholder="type_name" value="<?php echo $row['type_name']; ?>">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-5">
                            <button type="submit" class="btn btn-primary" name='submit'>บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>       
    </div> 
<?php
   // redirect('school/list-school');
}
?>
<?php require_once INC_PATH . 'footer.php'; ?>

<script>
$('.delete').click(function() {
    if(!confirm("ยืนยันการลบข้อมูล22")){
    return false;
    }
});
</script>
