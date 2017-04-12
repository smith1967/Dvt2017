
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
$edu_typelist = get_edu_type($page, $limit);
//    $total = get_total();
$url = site_url('sinphong/show_edu_type&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['typcode']);
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
                     <th><a href="<?php echo site_url('sinphong/from_insertedu_type'); ?>" >เพิ่มข้อมูล</a></th>
                    </tr>
            <tr>
                    <td>รหัสประเภทวิชา</td>
                    <td>ชื่อประเภทวิชา</td>
                    <td>ชื่อภาษาอังกฤษ</td>
                    <td>แก้ไข</td>
                    <td>ลบ</td>
                   
                </tr>
            </thead>
            <tbody>
               <?php
                foreach ($edu_typelist as $edu_type) :
                    ?>
                    <tr>	
                        <td><?php echo $edu_type['typcode']; ?></td>
                        <td><?php echo $edu_type['typname']; ?></td>
                        <td><?php echo $edu_type['etypname']; ?></td>


                        <td>
       <a href="<?php echo site_url('sinphong/from_editedu_type') . '&action=edit&typcode=' . $edu_type['typcode']; ?>" >แก้ไข</a>
    </td><td> 
	<a href="<?php echo site_url('sinphong/show_edu_type') . '&action=delete&typcode=' . $edu_type['typcode']; ?>" class="delete">ลบ</a>
                            
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>    
</div>
<?php require_once INC_PATH . 'footer.php'; ?>
	<script>
    $('.delete').click(function() {
        if (!confirm('ยืนยันลบข้อมูล')) {
            return false;
        }
    });
</script>
<?php

function get_edu_type($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM edu_type  LIMIT " . $start . "," . $limit ."";
    $result = mysqli_query($db, $query);
    $edu_typelist = array();
    while ($row = mysqli_fetch_array($result)) {
        $edu_typelist[] = $row;
    }
    return $edu_typelist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM edu_type ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_delete($typcode) {
    global $db;
    if (empty($typcode)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('sinphong/show_edu_type');
    }
    $query = "DELETE FROM edu_type WHERE typcode =" . pq($typcode);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('sinphong/show_edu_type');
}
?>
