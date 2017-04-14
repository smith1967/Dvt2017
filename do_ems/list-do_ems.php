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
$DoBusinessVg = get_DoBusinessVg($page, $limit);
//    $total = get_total();
$url = site_url('do_ems/list-do_ems&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['do_ems_id']);
}
?>
<script language="JavaScript" type="text/javascript">
    function checkDelete() {
        return confirm('คุณแน่ใจหรือจะลบ?');
    }
</script>
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
                    <th>ชื่อสถานประกอบการ</th>
                    <th>ชื่อสถานศึกษา</th>
                    <th>วันที่ลงนาม</th>
                    <th>สาขาวิชาที่ลงนาม</th>
                    <th>กลุ่มต้นแบบสานพลังประชารัฐ</th>
                    <th colspan="2">จัดการ</th>
                    <th><a href="<?php echo site_url('do_ems/insert-do_ems'); ?>" >เพิ่มข้อมูล</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($doems as $doems1) :
                    ?>                            
                    <tr>
                        <td><?php echo getBusiness($doems1['business_id']); ?></td>
                        <td><?php echo getSchoolName($doems1['school_id']); ?></td>
                        <td><?php echo $doems1['do_date']; ?></td>
                        <td><?php echo getMajorName($doems1['major_id']); ?></td>
                        <td><?php echo getEMSName($doems1['ems_id']); ?></td>
                        <td>
                            <a href="<?php echo site_url('do_ems/list-do_ems') . '&action=delete&do_ems_id=' . $doems1['do_ems_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                            <a href="<?php echo site_url('do_ems/edit-do_ems') . '&action=edit&do_ems_id=' . $doems1['do_ems_id']; ?>" >แก้ไข</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function getSchoolName($school_id) {
    global $db;
    $query = "SELECT * FROM school where school_id='" . $school_id . "'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['school_name'];
}
function getMajorName($major_id) {
    global $db;
    $query = "SELECT * FROM major where major_id='" . $major_id . "'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['major_name'];
}
function getEMSName($ems_id) {
    global $db;
    $query = "SELECT * FROM ems_detail where ems_id='" . $ems_id . "'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['EMS_name'];
}
function getBusiness($business_id) {
    global $db;
    $query = "SELECT * FROM business where business_id='" . $business_id . "'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['business_name'];
}

function get_doems($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM do_ems LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $doems = array();
    while ($row = mysqli_fetch_array($result)) {
        $doems[] = $row;
    }
    return $doems;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM do_ems ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($do_ems_id) {
    global $db;
    if (empty($do_ems_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('do_ems/list-do_ems');
    }
    $query = "DELETE FROM do_ems WHERE do_ems_id =" . pq($do_ems_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('do_ems/list-do_ems');
}
?>
