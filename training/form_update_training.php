<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>update_training</title>
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


        <?php
        $sql = "SELECT * FROM training where VocationTrain_id='$_GET[VocationTrain_id]';";
        $rs = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($rs);
        ?>
    </head>
    <body>
        <div class='container'>
            <form class="form-inline" action="update_training.php"> 
                <div class="form-group has-success has-feedback">

                    <input type="hidden"name="VocationTrain_id"value="<?php echo $row['VocationTrain_id'] ?>">

                    <div class="row"> 
                        <label class="control-label col-md-6" for="citizen_id">id ประชาชน นักเรียน</label>
                        <div class="col-md-4 "><input type="text" class="form-control" id="citizen_id" name="citizen_id"value="<?php echo $row['citizen_id'] ?>"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="business_id">รหัสสถาณประกอบการ</label>
                        <div class="col-md-4 "><input type="text" class="form-control" id="business_id"name="business_id"value="<?php echo $row['business_id'] ?>"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="education_id">รหัสสถานศึกษา</label>
                        <div class="col-md-4 "><input type="text" class="form-control" id="education_id"name="education_id"value="<?php echo $row['education_id'] ?>"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="branch_id">รหัสสาขางาน</label>
                        <div class="col-md-4 "><input type="text" class="form-control" id="branch_id"name="branch_id"value="<?php echo $row['branch_id'] ?>"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="trainer_id">ครูฝึก</label>
                        <div class="col-md-4 "><input type="text" class="form-control" id="trainer_id"name="trainer_id"value="<?php echo $row['trainer_id'] ?>"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="contract_date">วันที่ทำสัญญา</label>
                        <div class="col-md-4 "><input type="date" name="contract_date" value="<?php echo $row['contract_date'] ?>"/></div>
                    </div>

                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="start_date">วันที่เริ่มต้นการฝึก</label>
                        <div class="col-md-4 "><input type="date" name="start_date" value="<?php echo $row['start_date'] ?>"/></div>
                    </div>

                    <br>
                    <div class="row"> 
                        <label class="control-label col-md-6" for="end_date">วันที่สิ้นสุดการฝึก</label>
                        <div class="col-md-4 "><input type="date" name="end_date" value="<?php echo $row['end_date'] ?>"/></div>
                    </div>

                </div>
                <br>
                <br>
                <div class="row"><div class="col-md-1 col-md-offset-3"><button type="submit" class="btn btn-warning" name="submit">แก้ไข</button></div></div>
            </form>
        </div> 
    </body>
</html>

