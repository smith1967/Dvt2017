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
$dovg = get_dovg($page, $limit);
//    $total = get_total();
$url = site_url('do_vg/list-do_vg&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['do_vg_id']);
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
                    <th>ชื่อกลุ่มวิทยาลัย</th>
                    <th>วันที่แต่งตั้งคณะกรรมการ</th>
                    <th>เลขที่คำสั่ง</th>
                    <th>ตำแหน่งอนุกรรมการและเลขานุการ</th>
                    <th>ประธานอนุกรรมการ</th>
                    <th colspan="2">จัดการ</th>
                    <th><a href="<?php echo site_url('do_vg/insert-do_vg'); ?>" >เพิ่มข้อมูล</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dovg as $dovg1) :
                    ?>                            
                    <tr>
                    
                        <td><?php echo getVg($dovg1['vg_id']); ?></td>
                         <td><?php echo $dovg1['do_vg_date']; ?></td>
                         <td><?php echo $dovg1['command_number']; ?></td>
                        <td><?php echo $dovg1['secretary_position_name']; ?></td>
                        <td><?php echo $dovg1['president_name']; ?></td>
                       
                        
                        <td>
                            <a href="<?php echo site_url('do_vg/list-do_vg').'&action=delete&do_vg_id=' . $dovg1['do_vg_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                            <a href="<?php echo site_url('do_vg/edit-do_vg').'&action=edit&do_vg_id=' . $dovg1['do_vg_id']; ?>" >แก้ไข</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php
function get_dovg($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM do_vg LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $dovg = array();
    while ($row = mysqli_fetch_array($result)) {
        $dovg[] = $row;
    }
    return $dovg;
}
function getVg($vg_id){
    global $db;
    $query = "SELECT * FROM vocation_group where vg_id='".$vg_id."'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['vg_name'];
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM do_vg ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($do_vg_id) {
    global $db;
    if (empty($do_vg_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('do_vg/list-do_vg');
    }
    $query = "DELETE FROM do_vg WHERE do_vg_id =" . pq($do_vg_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('do_vg/list-do_vg');
}
?>