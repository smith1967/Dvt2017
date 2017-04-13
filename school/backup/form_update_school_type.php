
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
 	.cen{
width:400px;
height:200px;
margin:auto;
display:block;

text-align:center;

}
</style>
<?php 
$sql = "SELECT * FROM school_type where type_id='$_GET[id]';";
    $rs = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($rs);
?>
        <form class="cen" action="update_school_type.php"> 
    <div class="form-group has-success has-feedback">
    <table>
    <input type="hidden" name="type_id"value="<?php echo $row['type_id']?>">
    <tr>
    <td><br><label class="control-label" for="inputSuccess4">ชื่อคุณสมบัติ</label></td>
    <td><br><input type="text" class="form-control" id="inputSuccess4" name="type_name"value="<?php echo $row['type_name']?>"></td>
    </tr>
  </table><br>

<button type="submit" class="btn btn-warning">แก้ไข</button>
</table>
</form>
