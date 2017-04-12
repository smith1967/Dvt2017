<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "สถานประกอบการ";
$active = 'busines';
$subactive = 'home';
//is_admin('home/index');
// check condition
if (isset($_GET['action']) && $_GET['action'] == 'list-business') {
    $page = isset($_GET['page']) ? $_GET['page'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "list";
    $group = isset($_GET['group']) ? $_GET['group'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $params = array(
        'action' => $action,
        'group' => $group
    );
    $params = http_build_query($params);
    $userslist = get_std_list($page, $group);
    $total = get_total($group);
    $url = site_url('business/list-business&') . $params;
    //var_dump($userlist);
}
require_once INC_PATH . 'header.php';
?>


<div class="container">
    <div class="page-header" style="margin-top: 0px;"><h4>จัดการข้อมูลลงทะเบียนผู้ใช้ใหม่</h4></div>
    <?php
    show_message();
    ?> 



</div> <!-- Main contianer -->
<?php
require_once INC_PATH . 'footer.php';

function get_business() {
    global $db;
    if (isset($_GET['action']) && $_GET['action'] == 'list-business') {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;
        $action = isset($_GET['action']) ? $_GET['action'] : "list";
        $group = isset($_GET['group']) ? $_GET['group'] : '';
        $order = isset($_GET['order']) ? $_GET['order'] : '';
        $params = array(
            'action' => $action,
            'group' => $group
        );
        $params = http_build_query($params);
        $userslist = get_std_list($page, $group);
        $total = get_total($group);
        $url = site_url('business/list-business&') . $params;
        //var_dump($userlist);
    }
//    $sql = "SELECT * FROM business LIMIT "
}
