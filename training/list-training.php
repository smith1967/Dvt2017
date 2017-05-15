<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "การฝึกงาน";
$active = 'training';
$subactive = 'list';
$school_id = $_SESSION['user']['school_id'];
//is_admin('home/index');

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
$traininglist = get_training($school_id,$page, $limit);
//var_dump($traininglist);
//die();
//    $total = get_total();
$url = site_url('training/list-training&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['training_id']);
}
?>
<?php require_once INC_PATH . 'header.php'; ?>

<div class="container">
    <?php include_once INC_PATH . 'submenu-training.php'; ?>
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
    <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
            <th><center>รหัสการฝึกอาชีพ</center></th>
            <th><center>รหัสนักศึกษา</center></th>
            <th><center>รหัสนักศึกษา</center></th>
            <th><center>ชื่อสถานประกอบการ</center></th>
            <th><center>สถานศึกษา</center></th>
            <th><center>ชื่อสาขางาน</center></th>
            <th><center>ครูฝึก</center></th>
            <th><center>วันที่ทำสัญญา</center></th>
            <th><center>วันที่เริ่มต้นการฝึก</center></th>
            <th><center>วันที่สิ้นสุดการฝึก</center></th>
            <th><center>ดำเนินการ</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($traininglist as $training) :
                    ?>                            
                    <tr>
                    <td><center><?php echo $training['training_id']; ?></td>
                    <td><center><?php echo $training['std_id']; ?></center></td>
                    <td><center><?php echo $training['std_name']; ?></center></td>
                    <td><center><?php echo $training['business_name']; ?></center></td>
                    <td><center><?php echo $training['school_name']; ?></center></td>
                    <td><center><?php echo $training['minor_name']; ?></center></td>
                    <td><center><?php echo $training['trainer_name']; ?></center></td>
                    <td><center><?php echo $training['contract_date']; ?></center></td>
                    <td><center><?php echo $training['start_date']; ?></center></td>
                    <td><center><?php echo $training['end_date']; ?></center></td>
                        <td>                            
                             <a href="<?php echo site_url('training/list-training') . '&action=delete&training_id=' . $training['training_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                             <a href="<?php echo site_url('training/edit-training') . '&action=edit&training_id=' . $training['training_id']; ?>" >แก้ไข</a>
                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>

<?php

function get_training($school_id,$page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
//    $query = "SELECT * FROM training WHERE school_id = ".pq($school_id)." LIMIT " . $start . "," . $limit . "";
    $query = "SELECT t1.std_id,t1.std_name,t2.business_name,t3.*,t4.minor_name,t5.trainer_name,t6.school_name "
            . "FROM training AS t3 "
            . "LEFT JOIN student AS t1 ON t1.citizen_id=t3.citizen_id "
            . "LEFT JOIN business AS t2 ON t2.business_id=t3.business_id "
            . "LEFT JOIN minor AS t4 ON t4.minor_id=t3.minor_id "
            . "LEFT JOIN school AS t6 ON t3.school_id = t6.school_id "
            . "LEFT JOIN trainer AS t5 ON t5.trainer_id=t3.trainer_id "            
            . " WHERE t3.school_id = ".pq($school_id)." LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
//    var_dump($query);
//    die();
    $traininglist = array();
    while ($training = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
        $traininglist[] = $training;
    }
    return $traininglist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM training WHERE "
            . "school_id = ".pq($school_id)." ORDER BY training_id";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}
function do_delete($training_id) {
    global $db;
    if (empty($training_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('training/list-training');
    }
    $query = "DELETE FROM training WHERE training_id =" .pq($training_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('training/list-training');
}

?>
