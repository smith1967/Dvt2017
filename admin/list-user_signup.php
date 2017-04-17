<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'list-user';

if(isset($_GET['action']) && $_GET['action'] == 'list'){
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "list";
    $params = array(
        'action' => $action,
    );
    $params = http_build_query($params);
    $userslist = get_user_signup($page);
    $total = get_total();
    $url = site_url('admin/list-user&').$params;
    //var_dump($userlist);
}else{
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "list";
    $params = array(
        'action' => $action,
    );
    $params = http_build_query($params);
    $userslist = get_user_signup($page);
    $total = get_total();
    $url = site_url('admin/list-user&').$params;    
}

if(!isset($total))redirect("/admin/index");
?>

<?php require_once INC_PATH . 'header.php'; ?>

<div class="container">
    <!--<?php include_once INC_PATH . 'submenu-admin.php'; ?>-->
    <?php
    show_message();
    ?> 
    <?php echo pagination($total, $url, $page, $order) ?>
        <div class="table-responsive"> 
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <!--<th>ID</th>-->
                    <th>ชื่อผู้ใช้</th>
                    <th>ชื่อ-นามสกุล</th>
                    <!--<th>Last Na</th>-->
                    <th>ประเภทผู้ใช้งาน</th>
                    <th>กระทำการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($userslist as $user) :
                ?>                            
                <tr>
                    <!--<td><?php echo $user['user_id'] ?></td>-->
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['fname'] . " " .$user['lname']  ?></td>
                    <!--<td><?php echo $user['lname'] ?></td>-->
                    <td><?php echo $user['user_type_id'] ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/list-user') . '&action=confirm&user_id=' . $user['id']; ?>" >ยืนยัน</a>
                        <a href="<?php echo site_url('admin/list-user') . '&action=delete&user_id=' . $user['id']; ?>" class="delete">ลบ</a>
                        <a href="<?php echo site_url('admin/edit-user') . '&action=edit&user_id=' . $user['id']; ?>" >แก้ไข</a>                      
                    </td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>
<?php 
function get_user_signup($page=0,$limit=20){
    global $db;
    $start = $page*$limit;
    $val = $group."%";
    $query = "SELECT * FROM user WHERE status LIKE 'N' ORDER BY user_id LIMIT ".$start.",".$limit;
   $result = mysqli_query($db, $query);
   $userlist = array();
   while ($row = mysqli_fetch_array($result)) {
       $userlist[] = $row;
   }
   return $userlist;            
}
function get_users_list($page=0,$group,$limit=10){
    global $db;
    $start = $page*$limit;
    $val = $group."%";
    $query = "SELECT * FROM users WHERE groupname LIKE ".pq($val)." LIMIT ".$start.",".$limit;
   $result = mysqli_query($db, $query);
   $userlist = array();
   while ($row = mysqli_fetch_array($result)) {
       $userlist[] = $row;
   }
   return $userlist;            
}
function get_total(){
    global $db;
    $query = "SELECT * FROM user WHERE status = 'N'";
   $result = mysqli_query($db, $query);
   return mysqli_num_rows($result);            
}
function get_users_total($group){
    global $db;
    $val = $group."%";
    $query = "SELECT * FROM users WHERE groupname LIKE ".pq($val);
   $result = mysqli_query($db, $query);
   return mysqli_num_rows($result);            
}
