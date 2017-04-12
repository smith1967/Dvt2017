<?php
include_once 'include/config.php';
    $data = &$_GET; 
    echo $query = "UPDATE `training` SET `citizen_id`=".pq($data['citizen_id']).",`business_id`=".pq($data['business_id']).",`education_id`=".pq($data['education_id']).",`branch_id`=".pq($data['branch_id']).",`trainer_id`=".pq($data['trainer_id']).",`contract_date`=".pq($data['contract_date']).",`start_date`=".pq($data['start_date']).",`end_date`=".pq($data['end_date'])." WHERE `VocationTrain_id`=".pq($data['VocationTrain_id'])."";
    $result=mysqli_query($db,$query);
    header("location: training.php"); 
?>

