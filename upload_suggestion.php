<?php
session_start();
include_once("DBconnect.php");
// to inset into recipe table
 $reviewDate= date("Y-m-d h:i:s");

function cleanData($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$error= "";
if(isset($_POST["title"]))
{
$title = $_POST["title"];
$suggestion = $_POST["suggestion"];
$stars = $_POST["stars"];
$text=$_POST["text"];
echo $stars;
$uid = $_GET["uid"];
$rid = $_GET["rid"];

$uid=$_SESSION['uid'];


 


		$sqlreviewid="select max(Review_id) as reviewid from review";
		$resultreviewid = mysqli_query($conn, $sqlreviewid);
		$reviewidarray = mysqli_fetch_assoc($resultreviewid);
		$review_id=$reviewidarray["reviewid"];
		$review_id++;
		echo $review_id;
		echo $rid;
		echo "<br>";
		echo $uid;
		echo "<br>";
		echo $stars;
		echo "<br>";
		echo $text;
		echo "<br>";
		echo $title;
		echo "<br>";
		echo $suggestion;
		echo $reviewDate."<br>";
		
		
			
		$sql="insert into review(rid,uid,stars,text,title,suggestion,reviewDate,Review_id) 
		values($rid,'$uid',$stars,'$text','$title','$suggestion','$reviewDate',$review_id)";
		if (mysqli_query($conn, $sql)) {
			
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
					$value=$i+1;
					$sql = "insert into review_photo values('$image','$value',$review_id);";
					//echo $sql;
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk != 0)
					{
						if($conn->query($sql))
						{
							echo "done";
						}
						else
						{
							echo "not done";
							exit();
						}
						// if everything is ok, try to upload file
					}
				}
			}
		}
			
			echo "New record created successfully";
			header("Location: displayrecipe.php?rid=$rid");
			}			
			
			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
}


else {  echo "error error"; }
?>



