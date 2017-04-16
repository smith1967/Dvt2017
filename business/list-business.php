<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'business';
$subactive = 'list';
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
$businesslist = get_business($page, $limit);
//    $total = get_total();
$url = site_url('business/list-business&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['business_id']);
}
?>
<?php require_once INC_PATH . 'header.php'; ?>

<div class="container">
    <?php include_once INC_PATH . 'submenu-business.php'; ?>
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
    <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>

                    <th>รหัสสถานประกอบการ</th>
                    <th>ชื่อสถานประกอบการ</th>
                    <th>จังหวัด</th>
                    <th colspan="2">จัดการ</th>
                    <!--<th><a href="<?php echo site_url('business/business'); ?>" >เพิ่มข้อมูล</a></th>-->
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($businesslist as $business) :
                    ?>                            
                    <tr>
                        <td><?php echo $business['business_id']; ?></td>
                        <td><?php echo $business['business_name']; ?></td>
                        <td><?php echo $business['province_name']; ?></td>

                        <td>
                            <a href="<?php echo site_url('business/list-business') . '&action=delete&business_id=' . $business['business_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                            <a href="<?php echo site_url('business/edit-business') . '&action=edit&business_id=' . $business['business_id']; ?>" >แก้ไข</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function get_business($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT business.*,province.province_name FROM business,province LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $businesslist = array();
    while ($row = mysqli_fetch_array($result)) {
        $businesslist[] = $row;
    }
    return $businesslist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM business ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($business_id) {
    global $db;
    if (empty($business_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('business/list-business');
    }
    $query = "DELETE FROM business WHERE business_id =" . pq($business_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('business/list-business');
}
?>
