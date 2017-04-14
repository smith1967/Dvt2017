<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "สถานประกอบการทำกรอ.";
$active = 'business';
$subactive = 'list-do_business_vg';
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
$url = site_url('DoBusinessVg/list-DoBusinessVg&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['do_business_vg_id']);
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
                    <th>ชื่อกลุ่มอาชีพ</th>
                    <th>ชื่อสถานประกอบการ</th>
                    <th>วันที่เข้าร่วม กรอ.</th>
                    <th colspan="2">จัดการ</th>
                    <th><a href="<?php echo site_url('do_business_vg/insert-do_business_vg'); ?>" >เพิ่มข้อมูล</a></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($DoBusinessVg as $dobusiness) :
                    ?>                            
                    <tr>
                    
                        <td><?php echo getvocationgroup($dobusiness['vg_id']); ?></td>
                        <td><?php echo getBusiness($dobusiness['business_id']); ?></td>
                        <td><?php echo $dobusiness['date_vg']; ?></td>
                        <td>
                            <a href="<?php echo site_url('do_business_vg/list-do_business_vg') . '&action=delete&do_business_vg_id=' . $dobusiness['do_business_vg_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                            <a href="<?php echo site_url('do_business_vg/edit-do_business_vg') . '&action=edit&do_business_vg_id=' . $dobusiness['do_business_vg_id']; ?>" >แก้ไข</a>

                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php
function get_DoBusinessVg($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM do_business_vg LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $DoBusinessVg = array();
    while ($row = mysqli_fetch_array($result)) {
        $DoBusinessVg[] = $row;
    }
    return $DoBusinessVg;
}

function getvocationgroup($vg_id){
    global $db;
    $query = "SELECT * FROM vocation_group where vg_id='".$vg_id."'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['vg_name'];
}
function getBusiness($business_id){
    global $db;
    $query = "SELECT * FROM business where business_id='".$business_id."'";
    //echo $query;
    $rs = mysqli_query($db, $query);
    $row = mysqli_fetch_array($rs);
    return $row['business_name'];
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM do_business_vg ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($do_business_vg_id) {
    global $db;
    if (empty($do_business_vg_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('do_business_vg/list-do_business_vg');
    }
    $query = "DELETE FROM do_business_vg WHERE do_business_vg_id =" . pq($do_business_vg_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('do_business_vg/list-do_business_vg');
}
?>
