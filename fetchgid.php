<?php
include_once("DBconnect.php");


$sql = "select gid,gname from group_members natural join cooking_group where uid='$uid';";
if ($result = $conn->query($sql)){
$selectGroup= '<select class="form-control" name="group">';
$selectGroup.='<option selected="selected">Select the group</option>';
 while($rs = $result->fetch_assoc()){
      $selectGroup.='<option value="'.$rs['gid'].'">'.$rs['gname'].'</option>';
  }
}
$selectGroup.='</select>';




?>









