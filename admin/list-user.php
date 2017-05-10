<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'list-user';


if (isset($_GET['action']) && $_GET['action'] == 'list') {
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "list";
    $params = array(
        'action' => $action,
    );
    $params = http_build_query($params);
    $userslist = get_user_signup($page);
    $total = get_total();
    $url = site_url('admin/list-user&') . $params;
    //var_dump($userlist);
} else if (isset($_GET['action']) && $_GET['action'] == 'enabled') {
    do_enabled($_GET['user_id']);
    //var_dump($userlist);
} else if (isset($_GET['action']) && $_GET['action'] == 'disabled') {
    do_disabled($_GET['user_id']);
    //var_dump($userlist);
}else if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    do_delete($_GET['user_id']);
    //var_dump($userlist);
} else {
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "list";
    $params = array(
        'action' => $action,
    );
    $params = http_build_query($params);
    $userslist = get_user($page);
    $total = get_total();
    $url = site_url('admin/list-user&') . $params;
}

if (!isset($total))
    redirect("/admin/index");
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
                    <th>ID</th>
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
                        <td><?php echo $user['user_id'] ?></td>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['fname'] . " " . $user['lname'] ?></td>
                        <!--<td><?php echo $user['lname'] ?></td>-->
                        <td><?php echo $user['user_type_id'] ?></td>
                        <td>
                            <?php if($user['status']=='Y') : ?>
                            <a href="<?php echo site_url('app/admin/list-user') . '&action=disabled&user_id=' . $user['user_id']; ?>" >
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo site_url('app/admin/list-user') . '&action=enabled&user_id=' . $user['user_id']; ?>" >
                                <span class="glyphicon glyphicon-ok-circle"></span>
                            </a>
                            <?php endif; ?>
                            <a href="<?php echo site_url('app/admin/list-user') . '&action=delete&user_id=' . $user['user_id']; ?>" class="delete">
                                <span class="glyphicon glyphicon-remove-circle"></span>
                            </a>
                            <a href="<?php echo site_url('app/admin/edit-user') . '&action=edit&user_id=' . $user['user_id']; ?>" >
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>                      
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
        return confirm('ยืนยันลบข้อมูล')
    });
</script>
<?php

function get_user_signup($page = 0, $limit = 20) {
    global $db;
    $start = $page * $limit;
    $val = $group . "%";
    $query = "SELECT * FROM user WHERE status LIKE 'N' ORDER BY user_id LIMIT " . $start . "," . $limit;
    $result = mysqli_query($db, $query);
    $userlist = array();
    while ($row = mysqli_fetch_array($result)) {
        $userlist[] = $row;
    }
    return $userlist;
}

function get_user($page = 0,$limit = 10) {
    global $db;
    $start = $page * $limit;
    $query = "SELECT * FROM user LIMIT " . $start . "," . $limit;
    $result = mysqli_query($db, $query);
    $userlist = array();
    while ($row = mysqli_fetch_array($result)) {
        $userlist[] = $row;
    }
    return $userlist;
}

function get_total() {
    global $db;
    $query = "SELECT * FROM user WHERE status = 'N'";
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function get_users_total($group) {
    global $db;
    $val = $group . "%";
    $query = "SELECT * FROM users WHERE groupname LIKE " . pq($val);
    $result = mysqli_query($db, $query);
    return mysqli_num_rows($result);
}

function do_enabled($user_id) {
    global $db;
    $query = "UPDATE user SET status='Y' WHERE user_id = " . pq($user_id);
//    var_dump($query);
//    die();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('ยืนยันข้อมูลสำเร็จ');
    }  else {
        set_err($query);
    }
    redirect('admin/list-user');
}

function do_disabled($user_id) {
    global $db;
    $query = "UPDATE user SET status='N' WHERE user_id = " . pq($user_id);
//        var_dump($query);
//    die();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('ระงับการใช้งานสำเร็จ');
    }  else {
        set_err($query);
    }
    redirect('admin/list-user');
}

function do_delete($user_id) {
    global $db;
    $query = "DELETE FROM user WHERE user_id = " . pq($user_id);
//        var_dump($query);
//    die();
    $result = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) > 0) {
        set_info('ลบข้อมูลผู้ใช้สำเร็จ');
    }  else {
        set_err($query);
    }
    redirect('admin/list-user');
}