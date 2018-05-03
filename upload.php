<?php
session_start();
include_once("DBconnect.php");
// to inset into recipe table

function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$error= "";
if(isset($_POST["title"]))
$title = $_POST["title"];
$servings = $_POST["servings"];
$prepTime = $_POST["prepTime"];
$cookTime = $_POST["cookTime"];
$description = $_POST["description"];
$cookTimeUnit=$_POST["cookTimeUnit"];
$cookTime= $cookTime * $cookTimeUnit;	
$prepTimeUnit=$_POST["prepTimeUnit"];
$prepTime= $prepTime * $prepTimeUnit;
$rid = 1;

  $description = cleanData($description);
  $servings = cleanData($servings);
 

$uid=$_SESSION['uid'];

$conn->begin_transaction();
try{
		$sql ="call add_recipe('$uid', '$title',$servings , '$prepTime', '$cookTime', '$description',@return)";
		if ($result = $conn->query($sql))
		{
			$result = $conn->query('SELECT @return');
			$rid = $result->fetch_assoc();
			$rid = $rid['@return'];
			$total = count($_FILES['filesToUpload']['name']);
			if ($total != 0){	{
				for ($i = 0; $i < $total; $i++)
				{	
					$tmpName = $_FILES["filesToUpload"]["tmp_name"][$i];
					$fp      = fopen($tmpName, 'r');
					$image = fread($fp, filesize($tmpName));
					$image = addslashes($image);
					fclose($fp);
					$target_file = basename($_FILES["filesToUpload"]["name"][$i]);
					$uploadOk = 1;
					$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
					// Check if image file is a actual image or fake image
					if (isset($_POST["submit"]))
					{
						$check = getimagesize($_FILES["filesToUpload"]["tmp_name"][$i]);
						if ($check != false)
						{
							$uploadOk = 1;
						}
						else
						{
							$error = "File is not an image.";
							$uploadOk = 0;
						}
					}
					$photoid=$i+1;
					$sql = "insert into recipe_photo values('$rid','$image','$photoid');";
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk != 0)
					{
						$conn->query($sql);
						// if everything is ok, try to upload file
					}
				}
			}
			//header("Location: createRecipe.php"); /* Redirect browser */
			$total = count($_POST['ingredient'])-1;
			for ($i = 0; $i < $total; $i++)
			{
				$ingredient=$_POST['ingredient'][$i];
				$quantity=$_POST['quantity'][$i];
				$unit=$_POST['unit'][$i];
				$sql = "insert into contains_ingredient values($rid,'$ingredient','$quantity','$unit');";
				$conn->query($sql);
			}
			if(isset($_POST['tags'])){
			$tags=$_POST['tags'];
			$tid=0;
			foreach($tags as $tag)
			{
				$query="SELECT tid from tags where tagname='$tag';";
				$result = $conn->query($query);
				while($row= $result->fetch_assoc()){
					$tid= $row['tid'];
				}
				$query="Insert INTO recipe_has_tag values ($rid,$tid );";
				$conn->query($query);
			}
			}
		}
		$conn->commit();
		echo "success";
		sleep(1);
		//To do: update it with user first page
		header("Location: createRecipe.php");
		}
		else
			{
				$error= "Error in form data";
			//sleep(2);
			header("Location: createRecipe.php");
		
		}
}
catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
	$error = $e;
	
    $conn->rollback();
	//sleep(2);
	header("Location: createRecipe.php");
}
?>

