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
$trainerlist = get_trainer($page, $limit);
//    $total = get_total();
$url = site_url('trainer/list-trainer&') . $params;
//    var_dump($businesslist);
//    exit();
$total = get_total();
//if(!isset($total))redirect("/admin/index");
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['trainer_id']);
}
?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('คุณแน่ใจหรือจะลบ?');
}
</script>

<?php require_once INC_PATH . 'header.php'; ?>

<div class="container">
    <?php include_once INC_PATH . 'submenu-trainer.php'; ?>
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order, $limit) ?>
    <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <th>รหัสครูฝึก</th>
                    <th>ชื่อครูฝึก</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>วุฒิการศึกษาสูงสุด</th>
                    <th colspan="2">จัดการ</th>
                   <!--<th><a href="<?php echo site_url('trainer/form_insert_trainer'); ?>" >เพิ่มข้อมูล</a></th>-->

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($trainerlist as $trainer) :
                    ?>                            
                    <tr>
                        <td><?php echo $trainer['trainer_id']; ?></td>
                        <td><?php echo $trainer['trainer_name']; ?></td>
                        <td><?php echo $trainer['phone']; ?></td>
                        <td><?php echo getNameEducational($trainer['educational_id']); ?></td>
                        <td>                            
                             <a href="<?php echo site_url('trainer/list-trainer') . '&action=delete&trainer_id=' . $trainer['trainer_id']; ?>" class="delete"onclick="return confirm('คุณแน่ใจหรือจะลบ?')">ลบ</a>
                             <a href="<?php echo site_url('trainer/edit-trainer') . '&action=edit&trainer_id=' . $trainer['trainer_id']; ?>" >แก้ไข</a>
                        </td>                    
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php

function get_trainer($page = 0, $limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM trainer ORDER BY trainer_id ASC LIMIT " . $start . "," . $limit . "";
    $result = mysqli_query($db, $query);
    $trainerlist = array();
    while ($row = mysqli_fetch_array($result)) {
        $trainerlist[] = $row;
    }
    return $trainerlist;
}

function get_total() {
    global $db;
//    $val = $group."%";
    $query = "SELECT * FROM trainer ";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}
function do_delete($trainer_id) {
    global $db;
    if (empty($trainer_id)) {
        set_err('ค่าพารามิเตอร์ไม่ถูกต้อง');
        redirect('trainer/list-trainer');
    }
    $query = "DELETE FROM trainer WHERE trainer_id =" .pq($trainer_id);
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db)) {
        set_info('ลบข้อมูลสำเร็จ');
    }
    redirect('trainer/list-trainer');
}

function getNameEducational($s){
    global $db;
    $query = "SELECT * FROM educational where educational_id='".$s."'";
    $result = mysqli_query($db, $query);
    $row=mysqli_fetch_assoc($result);
    return $row['educational_name'];   
}

?>
