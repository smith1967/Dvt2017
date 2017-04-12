<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'list-vocation_group';
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
    'limit'=>$limit,
//        'group' => $group
);
$params = http_build_query($params);
$vocation_grouplist = get_vocation_group($page,$limit);
//    $total = get_total();
$url = site_url('vocation_group/list-vocation_group&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
?>

<?php 
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['vg_id']);
}

require_once INC_PATH . 'header.php'; 
?>

<div class="container">
    <?php include_once INC_PATH . 'submenu-admin.php'; ?>
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
    <div class="right"><a href="<?php echo site_url('vocation_group/form_insert_vocation_group'); ?>" >เพิ่มข้อมูล</a></div>
    <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    
                    <th>รหัสกลุ่มอาชีพ</th>
                    <th>ชื่อกลุ่มอาชีพ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($vocation_grouplist as $vocation_group) :
                    ?>                            
                    <tr>
                        <td><?php echo $vocation_group['vg_id']; ?></td>
                        <td><?php echo $vocation_group['vg_name']; ?></td>

                        <td>
                            <a href="<?php echo site_url('vocation_group/form_edit_vocation_group') . '&action=edit&vg_id=' . $vocation_group['vg_id']; ?>" >แก้ไข</a>
                            <a href="<?php echo site_url('vocation_group/list-vocation_group') . '&action=delete&vg_id=' . $vocation_group['vg_id']; ?>" class="delete">ลบ</a>
                            
                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>

<script>
    $('.delete').click(function() {
        if (!confirm('ยืนยันลบข้อมูล')) {
            return false;
        }
    });
</script>
<?php

function get_vocation_group($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM vocation_group  LIMIT " . $start . "," . $limit ."";
    $result = mysqli_query($db, $query);
    $vocation_grouplist = array();
    while ($row = mysqli_fetch_array($result)) {
        $vocation_grouplist[] = $row;
    }
    return $vocation_grouplist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM vocation_group ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($vg_id) {
    global $db;
    if (empty($vg_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('student/list-student');
    }
    $query = "DELETE FROM vocation_group WHERE vg_id =" . pq($vg_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('vocation_group/list-vocation_group');
}
?>
