
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
        
	<style>
	.table1{
	margin:auto; display:block;
	width:60%;
	height:70%;
	}
</style>
<div class="table1">
<center><table class="table">

<tr>
<td><center>รหัสประเภทสถานศึกษา</td>
<td><center>ชื่อประเภทสถานศึกษา</td>
<td colspan="2"><center><form action="form_insert_school_type.php">
<button type="submit" class="btn btn-success"name="submit">เพิ่ม</button>
</form></td>
</tr>
<?php 
$sql = "SELECT * FROM school_type ";
    $rs = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($rs)) {
?>

<tr>
<td><center><?php echo $row['type_id']; ?></td>
<td><?php echo $row['type_name']; ?></td>
<form action="form_update_school_type.php">
<input type="hidden" name="id"value="<?php echo $row['type_id']?>">
<td><center><button type="submit" class="btn btn-warning">แก้ไข</button></td>
</form>
<form action="del_school_type.php">
<input type="hidden" name="id"value="<?php echo $row['type_id']?>">
<td><center><button type="submit" class="btn btn-danger">ลบ</button></td>
</form>
</tr>

    <?php }?>
</table>
