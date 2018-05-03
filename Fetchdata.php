<?php
include_once("DBconnect.php");
$sql="select fromUnit from conversion;";
if ($result = $conn->query($sql)){
$select= '<select class="form-control" name="unit[]">';
 while($rs = $result->fetch_assoc()){
      $select.='<option value="'.$rs['fromUnit'].'">'.$rs['fromUnit'].'</option>';
  }
}
$select.='</select>';


$sql = 'select tagname from tags;';
$result = $conn->query($sql);
$checkbox='';
 while($row	 = $result->fetch_assoc()){
    $checkbox.=  "<input class='checkbox-inline' type='checkbox' name='tags[]' value='".$row['tagname']."'>"
     .$row['tagname'];
}



$title = $description = $prepTime = $cookTime = $servings = "";


?>









