<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
$title = "ผู้ดูแลระบบ";
$active = 'admin';
$subactive = 'home';
is_admin('home/index');
// check condition
if (isset($_POST)) {
    $data = $_POST;
    // transfer data
    if (isset($data['tid'])) {
        do_transfer($data);
    }
    /*     * *** delete data ****** */
    if (isset($data['did'])) {
        do_delete($data);
    }
}
require_once INC_PATH . 'header.php'; 
?>
<script>
    $(document).ready(function() {
        $("#sel_gid").change(function() {
            $("#form_gid").submit();
        });
    });

    function didcheck(o) {
        //var f = document.transfer_form;
        //alert(o.name);
        if (o.checked == true) {
            var v = o.value;
            $('input:checkbox[name^=tid]:checked').each(function() {
                //alert($(this).val());
                if (v == $(this).val()) {
                    //alert(v);
                    $(this).attr('checked', false);
                }
            });
        }

    }

    function tidcheck(o) {
        //alert(o.value);
        if (o.checked == true) {
            var v = o.value;
            $('input:checkbox[name^=did]:checked').each(function() {
                //alert($(this).val());
                if (v == $(this).val()) {
                    // alert(v);
                    $(this).attr('checked', false);
                }
            });
        }
    }

</script>

<div class="container">
    <?php include_once INC_PATH . 'submenu-admin.php'; ?>
    <div class="page-header" style="margin-top: 0px;"><h4>จัดการข้อมูลลงทะเบียนผู้ใช้ใหม่</h4></div>
    <?php
    show_message();
    ?> 

    <?php
    // check new user register        
    $sql = "SELECT register.gid,group_desc,count(id) num  FROM register LEFT JOIN group_config ON register.gid = group_config.gid WHERE register.comfirm = 'N' GROUP BY register.gid;";
//echo $sql."<br />";
    $rs = mysqli_query($db, $sql);
    if (mysqli_num_rows($rs) > 0) :
        while ($row = mysqli_fetch_array($rs))
            echo "<div>จำนวน<strong>" . $row['group_desc'] . "</strong>ที่ลงทะเบียนใหม่ " . $row['num'] . " รายการ</div>";
        // select user group
        $sql = "SELECT gid,group_desc FROM group_config";
        ?>
        <div class="container">
            <form method="post" id="form_gid" role="form" >
                <div class="col-xs-6 col-md-2" style="margin: 2px 0 5px 0px">
                    <select class="form-control" id="sel_gid" name="gid">
                        <option value="">-เลือกกลุ่มผู้ใช้-</option>
                        <?php
                        echo gen_option($sql, isset($_POST['gid']) ? $_POST['gid'] : "");
                        ?>
                    </select>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class='alert-warning'><p style="padding: 5px 0 5px 10px">ไม่มีข้อมูลผู้ลงทะเบียนใหม่ครับ</p></div>
    <?php
    endif;
    ?>

    <?php
    // list new user by gid
    if (isset($_POST['gid'])) {
        $data = $_POST;
        $sql = "SELECT * FROM register WHERE comfirm LIKE 'N' AND gid = " . pq($data['gid']) . ";";
        //$sql = "SELECT * FROM register WHERE gid = ".pq($data['gid']).";";
        $rs = mysqli_query($db, $sql);
        if (mysqli_num_rows($rs) > 0) {
    ?>
            <div class="table-responsive">
                <form action="" method="post" id="transfer_form">

                    <table class="table table-bordered table-hover">
                        <?php
                        $array = array(
                            'ลำดับ',
                            'ชื่อผู้ใช้',
                            'ชื่อ',
                            'นามสกุล',
                            'วันที่ลงทะเบียน',
                            'IP Address',
                            'แผนก/งาน',
                            'โอน',
                            'ลบ'
                        );
                        echo gen_thead($array);
                        $n = 1;
                        $i = 0;
                        while ($row = mysqli_fetch_array($rs)) {
                            //var_dump($row);
                            $array = array(
                                $n++,
                                $row['username'],
                                $row['fname'],
                                $row['lname'],
                                $row['created'],
                                $row['hostname'],
                                $row['department']
                            );
                            $s = gen_td($array);
                            $s .= '<td><input type="checkbox" class="tid" name="tid[' . $i++ . ']" id="tid"';  // <-- transfer data
                            $s .= ' value="' . $row['id'] . '" onclick=tidcheck(this) /></td>';
                            $s .= '<td><input type="checkbox" class="did" name="did[' . $i++ . ']" id="did"';  // <-- delete data
                            $s .= ' value="' . $row['id'] . '" onclick=didcheck(this) /></td>';
                            $s .= '</tr>';
                            echo $s;

                            //echo json_encode($row);
                        }

                        echo '</table>';
                        echo '<p><input type="submit" value="โอน/ลบ ข้อมูล"/></p>';
                        echo '</form>';
                        ?>
                        </div>
                        <?php
                    } else {
                        echo "<div class='alert-warning'><p>ยังไม่มีข้อมูลครับ</p></div>";
                    }
                }
                ?>        


                </div> <!-- Main contianer -->
<?php require_once INC_PATH . 'footer.php'; ?>

