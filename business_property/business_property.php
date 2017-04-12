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
$propertylist = get_property($page, $limit);
//    $total = get_total();
$url = site_url('rain/business_property&') . $params; //ชื่อ foder และชื่อ file นี้
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['property_id']);
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
                <tr><th><a href="<?php echo site_url('business_property/form_insert_business_benefit'); ?>" >เพิ่มข้อมูลสำเร็จ</a></th></tr>
                <tr>
                    <td>รหัสคุณสมบัติ</td>
                    <td>ชื่อคุณสมบัติ</td>
                    <td>รายละเอียด</td>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($propertylist as $property) :
                    ?>                            
                    <tr>

                        <td><?php echo $property['property_id'] ?></td>
                        <td><?php echo $property['name'] ?></td>
                        <td><?php echo $property['descript'] ?></td>

                        <td><a href="<?php echo site_url('rain/form_update_business_property') . '&action=edit&property_id=' . $property['property_id']; ?>" >แก้ไข</a></td>
                        <td><a href="<?php echo site_url('rain/business_property') . '&action=delete&property_id=' . $property['property_id']; ?>" class="delete">ลบ</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function get_property($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM business_property LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $propertylist = array();
    while ($row = mysqli_fetch_array($result)) {
        $propertylist[] = $row;
    }
    return $propertylist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM business_property ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($benefit_id) {
    global $db;
    if (empty($benefit_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('rain/business_benefit');
    }
    $query = "DELETE FROM business_benefit WHERE benefit_id =" . pq($benefit_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('rain/business_benefit');
}
?>







