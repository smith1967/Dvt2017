
<?php
include_once 'include/config.php';
    $data = &$_GET;
    $query = "INSERT INTO school_type  VALUES (".pq($data['type_id']).",".pq($data['type_name']).")";
    mysqli_query($db,$query);
    header("location: school_type.php");
    
?>