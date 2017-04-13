
<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'list-user';
//is_admin('home/index');
?>
<?php
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
$schoollist = get_school($page, $limit);
//    $total = get_total();
$url = site_url('natthapon/show_school&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['school_id']);
}

?>



<?php require_once INC_PATH . 'header.php'; ?> 
<div class="container">
    <?php include_once INC_PATH . 'submenu-admin.php'; ?>
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
    <div class="table-responsive">
        <table class="table table-striped table-condensed table-hover">
            <thead>



                <tr>
                     <th><a href="<?php echo site_url('natthapon/from_insertschool'); ?>" >เพิ่มข้อมูล</a></th>
                    </tr>
            <tr>
                    <td>รหัสสถานศึกษา</td>
                    <td>รหัสผ่าน</td>
                    <td>ชื่อสถานศึกษา</td>
                    <td>ประเภทสถานศึกษา</td>
                    <td>เลขที่ตั้ง</td>
                    <td>ถนน</td>
                    <td>ตำบล</td>
                    <td>อำเภอ</td>
                    <td>จังหวัด</td>
                    <td>รหัสไปรษณีย์</td>
                    <td>เบอร์โทรศัพท์</td>
                    <td>เบอร์ Fax</td>
                    <td>ภาค</td>
                    <td>แก้ไข</td>
                    <td>ลบ</td>
                   
                </tr>
            </thead>
            <tbody>
               <?php
                foreach ($schoollist as $school) :
                    ?>
                    <tr>	
                        <td><?php echo $school['school_id']; ?></td>
                        <td><?php echo $school['password']; ?></td>
                        <td><?php echo $school['name']; ?></td>
                        <td><?php echo $school['type_id']; ?></td>
                        <td><?php echo $school['address_no']; ?></td>
                        <td><?php echo $school['road']; ?></td>
                        <td><?php echo $school['tumbon']; ?></td>
                        <td><?php echo $school['aumphur']; ?></td>
                        <td><?php echo $school['province']; ?></td>
                        <td><?php echo $school['postcode']; ?></td>
                        <td><?php echo $school['phone']; ?></td>
                        <td><?php echo $school['fax']; ?></td>
                        <td><?php echo $school['zone']; ?></td>


                        <td>
                            <a href="<?php echo site_url('natthapon/from_editschool') . '&action=edit&school_id=' . $school['school_id']; ?>" >แก้ไข</a>
                            </td><td> <a href="<?php echo site_url('natthapon/show_school') . '&action=delete&school_id=' . $school['school_id']; ?>" class="delete" onclick="return confirm('Are you sure?')">ลบ</a>
                            
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>    
</div><!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function get_school($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM school  LIMIT " . $start . "," . $limit ."";
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
function do_delete($school_id) {
    global $db;
    if (empty($school_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('natthapon/show_school');
    }
    $query = "DELETE FROM school WHERE school_id =" . pq($school_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('natthapon/show_school');
}
?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');