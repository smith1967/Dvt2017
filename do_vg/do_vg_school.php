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
$url = site_url('rain/do_vg_school&') . $params; //ชื่อ foder และชื่อ file นี้
//    var_dump($businesslist);
//    exit();
$total = get_total();
if($total == 0){
    set_err('ยังไม่มีข้อมูลการทำความร่วมมือ');
    redirect('/home/index.php');
}   
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['dovg_school_id']);
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
                    <td>รหัสการร่วมมือ กรอ กับสถานศึกษา</td>
                    <td>รหัส กรอ</td>
                    <td>รหัส สถานศึกษา</td>
                    <td>แก้ไข</td>
                    <td>ลบ</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($schoollist as $school) :
                    ?>                            
                    <tr>
                        <td><?php echo $school['dovg_school_id'] ?></td>
                        <td><?php echo $school['dovg_id'] ?></td>
                        <td><?php echo $school['school_id'] ?></td>
                        
                        
                        <td><a href="<?php echo site_url('do_vg/update_do_vg_school') . '&action=edit&dovg_school_id=' . $school['dovg_school_id']; ?>" >แก้ไข</a></td>
                        <td><a href="<?php echo site_url('do_vg/do_vg_school') . '&action=delete&dovg_school_id=' . $school['dovg_school_id']; ?>" class="delete">ลบ</a>
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

function get_school($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    echo $query = "SELECT * FROM do_vg_school LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    if(!$result){
        return 0;
    }        
    $schoollist = array();
    while ($row = mysqli_fetch_array($result)) {
        $schoollist[] = $row;
    }
    return $schoollist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM do_vg_school ";
    $result = mysqli_query($db, $query);
    if($result){
        return mysqli_num_rows($result);
    }else {
        return 0;
    }
}



function do_delete($dovg_school_id) {
    global $db;   
    echo $query = "DELETE FROM do_vg_school WHERE dovg_school_id =" . pq($dovg_school_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('rain/do_vg_school');
}
?>






















