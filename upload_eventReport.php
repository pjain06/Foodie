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
$eid=$_GET['eid'];
$description = $_POST["description"];

$description = cleanData($description);

$uid=$_SESSION['uid'];

$conn->begin_transaction();
try{
		$sql= "insert into event_report values($eid,'$uid','$description')";
		
		if ($result = $conn->query($sql))
		{
			$total = count($_FILES['filesToUpload']['name']);
			if ($total != 0){	{
				for ($i = 0; $i < $total; $i++)
				{	
					$tmpName = $_FILES["filesToUpload"]["tmp_name"][$i];
					$fp      = fopen($tmpName, 'r');
					$image = fread($fp, filesize($tmpName));
					$image = addslashes($image);
					fclose($fp);
					//$image = $_FILES["filesToUpload"]["name"][$i];
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
					$value=$i+1;
					$sql = "insert into event_photo values($eid,'$uid','$image',$value);";
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk != 0)
					{
						$conn->query($sql);
						// if everything is ok, try to upload file
					}
				}
			}
			
		}
		$conn->commit();
		echo "success";
		sleep(1);
		//To do: update it with user first page
		header("Location: attendedEvents.php");
		}
		else
			{
				echo "Error in form data";
			//sleep(2);
			exit();
			header("Location: upcomingEvents.php");
		
		}
}
catch (Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
	$error = $e;
	
    $conn->rollback();
	//sleep(2);
	header("Location: home.php");
}
?>

