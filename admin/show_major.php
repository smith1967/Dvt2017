
<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'list-major';
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
$majorlist = get_major($page, $limit);
//var_dump($majorlist);
//    $total = get_total();
$url = site_url('admin/show_major&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['major_id']);
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
                    <th><a href="<?php echo site_url('admin/from_insert_major'); ?>" >เพิ่มข้อมูล</a></th>
                </tr>
                <tr>
                    <td>รหัสสาขาวิชา</td>
                    <td>ชื่อสาขาวิชา</td>
                    <td>ประเภทวิชา</td>
                    <td>ชื่อภาษาอังกฤษ</td>
                    <td>แก้ไข</td>
                    <td>ลบ</td>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($majorlist as $major) :
                    ?>
                    <tr>	
                        <td><?php echo $major['major_id']; ?></td>
                        <td><?php echo $major['major_name']; ?></td>
                        <td><?php echo $major['type_code']; ?></td>
                        <td><?php echo $major['major_eng']; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/from_editmajor') . '&action=edit&major_id=' . $major['major_id']; ?>" >แก้ไข</a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('admin/show_major') . '&action=delete&major_id=' . $major['major_id']; ?>" class="delete" >ลบ</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>    
</div><!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<script>
    $('.delete').click(function () {
        if (!confirm('ยืนยันลบข้อมูล')) {
            return false;
        }
    });
</script>
<?php

function get_major($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM major  LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $majorlist = array();
    while ($row = mysqli_fetch_array($result)) {
        $majorlist[] = $row;
    }
    return $majorlist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM major";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($major_id) {
    global $db;
    if (empty($major_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('admin/show_major');
    }
    $query = "DELETE FROM major WHERE major_id =" . pq($major_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('admin/show_major');
}
?>
