<?php
include_once 'include/config.php';
    $data = &$_GET; 
    echo $query = "UPDATE school_type SET type_name=".pq($data['type_name'])." WHERE type_id=".pq($data['type_id'])."";
    $result=mysqli_query($db,$query);
    header("location: school_type.php"); 
?>

