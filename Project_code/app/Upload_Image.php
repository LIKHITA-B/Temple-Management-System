<?php
	require '../config/config.php';
	

	
	if($_SESSION['role'] == 'priest'){
		$stmt = $connect->prepare('SELECT count(*) as register_user FROM users');
		$stmt->execute();
		$count = $stmt->fetch(PDO::FETCH_ASSOC);
       

		$stmt = $connect->prepare('SELECT count(*) as total_rent FROM room_rental_registrations');
		$stmt->execute();
		$total_rent = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt = $connect->prepare('SELECT count(*) as total_rent_apartment FROM room_rental_registrations_apartment');
		$stmt->execute();
		$total_rent_apartment = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	$stmt = $connect->prepare('SELECT count(*) as total_auth_user_rent FROM room_rental_registrations WHERE user_id = :user_id');
	$stmt->execute(array(
		':user_id' => $_SESSION['id']
		));
	$total_auth_user_rent = $stmt->fetch(PDO::FETCH_ASSOC);

	$stmt = $connect->prepare('SELECT count(*) as total_auth_user_rent_ap FROM room_rental_registrations_apartment WHERE user_id = :user_id');
	$stmt->execute(array(
		':user_id' => $_SESSION['id']
		));
	$total_auth_user_rent_ap = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['register_apartment'])) {
			$errMsg = '';
			// Get data from FROM
			
			$image = $_FILES['image']['name'];
			//$other = $_POST['other'];	

			//upload an images
			$target_file = "";
			if (isset($image)) {
				# code...
				$target_file = "uploads/".basename($_FILES["image"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
			    //$check = getimagesize($_FILES["image"]["tmp_name"]);			
			    //if($check !== false) {
			    	move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
			        $uploadOk = 1;
			   // } else {
			       // echo "File is not an image.";
			        //$uploadOk = 0;
			   // }
			}			
			//end of image upload		
			
			try {
				$stmt = $connect->prepare('INSERT INTO upload_image (image) VALUES (:image)');
				
				
					# code...					
					$stmt->execute(array(

						':image' => $target_file,
						
					));
								
				header('Location: Upload_Image.php?action=reg');
				exit;
			}catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'reg') {
		$errMsg = 'Image Uploaded successfull. Thank you';
	}
?>



    
	
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="shortcut icon" href="/assets/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 10px 10px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
.topnav-right {
  float: right;
 margin:0 1.5%;
}
.container {
    width: 305px;
    max-width: 305px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #ffffff;
	
}
.main_container{
    width: 680px;
    max-width: 680px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #ffffff;
}
.container_sub{
    width: 400px;
    max-width: 400px;
    margin: 3rem;
    position:center;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #ffffff;
    
}

.right {
  background-color: #e5e5e5;
  float: right;
  width: 30%;
  padding: 15px;
  margin-top: 7px;
  text-align: center;
}
.main {
  float: left;
  width: 60%;
  padding: 0 20px;
}
footer {
  text-align: center;
  padding: 3px;
  background-color: DarkSalmon;
  color: white;
}
.float-container {
    border: 3px solid #fff;
    padding: 20px;
}








</style>
</head>
<body>
    <div style="padding-left:16px">
        <h1 align= "center" font-family="monospace">OMKAAR TEMPLE</h1>
        <h4 align= "center" font-family="monospace">Hindu Temple of Fort Wayne</h2>
      </div>


<div class="topnav">


    <a  href="../Frontend/home.php">Home</a>
    <a  href="../Frontend/mission.php">Mission</a>
    <a href="../Frontend/priest.php">Priest</a>
    <a  href="../Frontend/services.php">Services</a>
    <a href="../Frontend/Calender/display_calender.php">Calender</a>
    <a href="../Frontend/gallery.php">Gallery</a>
    <a href="../Frontend/donation.php">Donations</a>
    <a href="../Frontend/education.php">Education</a>
    <a  href="../Frontend/contact.php">Contact</a>
	<a href="../app/priest_sms.php">Send sms</a>
	<a class="active" href="../app/Upload_Image.php">Upload Images</a>
    <div class="topnav-right">
	 <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'priest'){ echo "(priest)"; } ?></a>
            
      <a  href="../auth/login.php">Logout</a>
    </div> 
	
 
</div>

<br>
<?php?>
<!-- main part of the code-->
 
<div style="overflow:auto">

<div class=" main">
    <div class="main_container">
   
     

<?php include '../include/header.php';?>


 <div class="col-md-11 col-xs-12 col-sm-12"><br>  	
  	<div class="alert alert-info" role="alert">
  		<?php
			if(isset($errMsg)){
				echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
			}
		?>
  		<h2 class="text-center">Upload Image</h2>
  		<form action="" method="post" enctype="multipart/form-data">
		  	 <div class="row">
		  	 	

			

			<div class="row">
				<div class="col-md-4">
				  <div class="form-group">
				    <label for="description">Image</label>
				    <input type="file" name="image" id="image">
				  </div>
				</div>
			</div>


			 <button type="submit" class="btn btn-primary" name='register_apartment' value="register_apartment">Submit</button>
			</form>	
		</div>			
  	</div>
</div>







</div>

</div>


<!-- side conatiner-->
<div class="right">
  <div class="container">
  <h2>Temple Hours</h2>
  <h3><b>Mon-Fri</b></h3>
  <h4>9:30am - 11:00am</h4>
  <h4>5:30am - 8:00pm</h4>
  <h3><b>Sat-Sun</b></h3>
  <h4>9:30am - 12:00am</h4>
  <h4>5:30am - 8:00pm</h4>
  <h4>Abhishekam @6pm</h4>
  <h4>Aarthu @6:30pm</h4>
</div>

  
  <form action="action_page.php">
    <div class="container">
      <h2>Subscribe to our Newsletter</h2>
      <input type="text" placeholder="Name" name="name" required>
      <input type="text" placeholder="Email address" name="mail" required>
      <br>
      <label>
        <input type="checkbox" checked="checked" name="subscribe"> Daily Newsletter
      </label>
   
      <input type="submit" value="Subscribe">
    </div>
  </form>
</div>
</div>
  


<footer>
  
    <h4> Copyright &copy; : 2022-2024 | Omkaar Temple. All right reserved </h4>
  </footer>
   
    
    
  
    
    
    
 






</body>
</html>

				</div>
			<!-- </div> -->
		<!-- </div> -->
	</section>
<?php include '../include/footer.php';?>