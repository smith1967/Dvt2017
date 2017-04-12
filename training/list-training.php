<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>training</title>
        <?php
        include_once 'include/config.php';

        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
//nclude_once 'include/config.php';
        ?>

        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap.min.css" rel = "stylesheet">
        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap.css" rel = "stylesheet">
        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap-theme.min.css" rel = "stylesheet">
        <link href = "<?php echo BOOTSTRAP_URL ?>css/bootstrap-theme.css" rel = "stylesheet">

    </head>
    <body>
    <center>
        <table class="table ">

            <tr class="active">
            <td><center>รหัสการฝึกอาชีพ</center></td>
            <td><center>id ประชาชน นักเรียน</center></td>
            <td><center>รหัสสถานประกอบการ</center></td>
            <td><center>รหัสสถานศึกษา</center></td>
            <td><center>รหัสสาขางาน</center></td>
            <td><center>ครูฝึก</center></td>
            <td><center>วันที่ทำสัญญา</center></td>
            <td><center>วันที่เริ่มต้นการฝึก</center></td>
            <td><center>วันที่สิ้นสุดการฝึก</center></td>
            <td colspan="2">
            <center>
                <form action="form_insert_training.php">
                    <button type="submit" class="btn btn-success"name="submit">เพิ่ม</button>
                </form>
            </center>
            </td>
            </tr>
            <?php
            $sql = "SELECT * FROM training;";
            $rs = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($rs)) {
                ?>

                <tr>
                    <td><center><?php echo $row['VocationTrain_id']; ?></td>
                    <td><center><?php echo $row['citizen_id']; ?></center></td>
                    <td><center><?php echo $row['business_id']; ?></center></td>
                    <td><center><?php echo $row['school_id']; ?></center></td>
                    <td><center><?php echo $row['minor_id']; ?></center></td>
                    <td><center><?php echo $row['trainer_id']; ?></center></td>
                    <td><center><?php echo $row['contract_date']; ?></center></td>
                    <td><center><?php echo $row['start_date']; ?></center></td>
                    <td><center><?php echo $row['end_date']; ?></center></td>

                    <td>
                        <form action="form_update_training.php">
                            <input type="hidden" name="VocationTrain_id"value="<?php echo $row['VocationTrain_id'] ?>">
                            <button type="submit" class="btn btn-warning">แก้ไข</button>
                        </form>
                    </td>
                    <td>
                        <form action="del_training.php">
                            <input type="hidden" name="VocationTrain_id"value="<?php echo $row['VocationTrain_id'] ?>">
                            <button type="submit" class="btn btn-danger">ลบ</button>
                        </form>
                    </td>
                    </tr>
                <?php } ?>
        </table>
    </center>
</body>
</html>
