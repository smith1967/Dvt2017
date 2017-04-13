<?php
include_once 'include/config.php';
    $data = &$_GET; 
    echo $query = "DELETE from school_type WHERE type_id=".pq($data['id'])."";
    $result=mysqli_query($db,$query);
    header("location: school_type.php"); 
?>

