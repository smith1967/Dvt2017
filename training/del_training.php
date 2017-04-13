<?php
include_once 'include/config.php';
    $data = &$_GET; 
    echo $query = "DELETE from training WHERE VocationTrain_id=".pq($data['VocationTrain_id'])."";
    $result=mysqli_query($db,$query);
    header("location: training.php"); 
?>

