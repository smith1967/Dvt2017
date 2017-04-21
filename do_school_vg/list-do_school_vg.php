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
$DoSchoolVg = get_DoSchoolVg($page, $limit);
//var_dump($DoSchoolVg);
//    $total = get_total();
$url = site_url('do_school_vg/list-do_school_vg&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['do_school_vg_id']);
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

                 
                    <th>ชื่อกลุ่มอาชีพ</th>
                    <th>ชื่อสถานศึกษา</th>
                    <th>วันที่เข้าร่วม กรอ.</th>
                    <th colspan="2">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($DoSchoolVg as $doschool) :
                    ?>                            
                    <tr>
                    
                        <td><?php echo $doschool['vg_name']; ?></td>
                        <td><?php echo getSchoolName($doschool['school_id']); ?></td>
                        <td><?php echo $doschool['date_vg']; ?></td>
                        <td>
                            <a href="<?php echo site_url('do_school_vg/list-do_school_vg').'&action=delete&do_school_vg_id=' . $doschool['do_school_vg_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                            <a href="<?php echo site_url('do_school_vg/edit-do_school_vg').'&action=edit&do_school_vg_id=' . $doschool['do_school_vg_id']; ?>" >แก้ไข</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>

<?php
function getvocationgroup($vg_id){
    global $db;
    $query = "SELECT * FROM vocation_group where vg_id='".$vg_id."'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($rs);
    return $row['vg_name'];
}
function get_DoSchoolVg($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT ds.*,vg.vg_name FROM do_school_vg AS ds,vocation_group AS vg WHERE ds.vg_id = vg.vg_id LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
//    if(mysqli_error($db)){
//        var_dump(mysqli_error($db));
//        die();
//    }
    $DoSchoolVg = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $DoSchoolVg[] = $row;
    }
    return $DoSchoolVg;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM do_school_vg ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($do_school_vg_id) {
    global $db;
    if (empty($do_school_vg_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('do_school_vg/list-do_school_vg');
    }
    $query = "DELETE FROM do_school_vg WHERE do_school_vg_id =" . pq($do_school_vg_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('do_school_vg/list-do_school_vg');
}
?>
