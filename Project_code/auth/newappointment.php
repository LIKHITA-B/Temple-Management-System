<?php
	require '../config/config.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

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




	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FROM
		
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		
		$fullname = $_POST['fullname'];
		
		$services = $_POST['services'];
		$Date = $_POST['Date'];
		$Second = $_POST['Second'];
		$Third = $_POST['Third'];
		$Additional = $_POST['Additional'];

		// $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		// try {
		//     //Server settings
		//     $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		//     $mail->isSMTP();                                      // Set mailer to use SMTP
		//     $mail->Host = 'ssl://smtp.gmail.com:465';  // Specify main and backup SMTP servers
		//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
		//     $mail->Username = 'xxxx@gmail.com';                 // SMTP username
		//     $mail->Password = 'xxxx';                           // SMTP password
		//     $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		//     $mail->Port = 465;                                    // TCP port to connect to

		//     //Recipients
		//     $mail->setFrom('xxxxx@gmail.com', 'Mailer');
		// 	$mail->addAddress($email, 'Name Of the person');     // Add a recipient

		//     //Content
		//     $mail->isHTML(true);                                  // Set email format to HTML
		//     $mail->Subject = "Registration successfull $fullname";
		//     $mail->Body    = "Credentials To login into our site <br> Name: $fullname <br>Email : $email<br> Username: $username <br>Password: $password";

		//    	$mail->send();
		//    // echo 'Message has been sent';
		// } catch (Exception $e) {
		//    // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		// }	

			try {
				$stmt = $connect->prepare('INSERT INTO appointment (Username, Email, Phonenumber, services, date, second, third, additionalrequest) VALUES (:fullname, :email, :mobile, :services, :Date, :Second, :Third, :Additional)');
				$stmt->execute(array(
					':fullname' => $fullname,
					
					
					':email' => $email,
					':mobile' => intval($mobile),
					
					
					':services' => $services,
					':Date' => $Date,
					':Second' => $Second,
					':Third' => $Third,
					
					':Additional' => $Additional,
		

					
					
					
					));
				header('Location: appointmentbooking.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'Appointment Booked.';
	}
?>


<!DOCTYPE html>
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
    background-image:url('back2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
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
  background-color: #de572a;
  color: white;
}
.topnav-right {
  float: right;
 margin:0 1.5%;
}
.container {
    width: 320px;
    max-width: 320px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #e58723;
}
.main_container{
    width: 680px;
    max-width: 680px;
    margin: 1rem;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #eba349;
}
.container_sub{
    width: 400px;
    max-width: 400px;
    margin: 3rem;
    position:center;
    padding: 2rem;
    box-shadow: 0 0 40px rgba(0, 0, 0, 0.2);
    border-radius: var(--border-radius);
    background: #e58723;
    
}

.right {
  background-color: #eba349;
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
  background-color: #de572a;
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


 <a  href="home.php">Home</a>
    <a  href="mission.php">Mission</a>
    <a  href="priest.php">Priest</a>
    <a  href="services.php">Services</a>
    <a href="Calender/display_calender.php">Calender</a>
    <a href="gallery.php">Gallery</a>
    <a href="donation.php">Donations</a>
    <a href="education.php">Education</a>
    <a class="active" href="contact.php">Contact</a>
	<?php if($_SESSION['role'] == 'admin'){ 
	
	 echo '<a  href="../auth/admin_dashboard.php">Registered Users</a>';
	 echo '<a   href="Calender/index.php">Add Calender Events</a>';
	      	 	} ?>
					<?php if($_SESSION['role'] == 'priest'){ 
	
	 echo '<a  href="../app/priest_sms.php">Send sms</a>';
	   echo '<a  href="../app/Upload_Image.php">Upload Images</a>';
	      	 	} ?> 
				<?php if($_SESSION['role'] == 'user'){ 
	
	 echo '<a  href="../auth/appointmentbooking.php">Book Appointment</a>';
	      	 	} ?> 
    <div class="topnav-right">
	<a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } ?></a>
     
      <a  href="../auth/login.php">Logout</a>
  </div> 
 
</div>

<br>

<!-- main part of the code-->

<div style="overflow:auto">

<div class=" main">
    <div class="main_container">
   
    
        
<?php include '../include/header.php';?>


<!-- <section> --><br>
	<div class="container">
		<div class="row">				
			  <div class="col-md-8 mx-auto">
			  	<div class="alert alert-info" role="alert">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h2 class="text-center">Appointment</h2>
				  	<form action="" method="post">
				  		<div class="row">
					  	    <div class="col-6">
						  	  <div class="form-group">
							    <label for="fullname">Full Name</label>
							    <input type="text" class="form-control" id="fullname" placeholder="Full Name" name="fullname" required>
							  </div>
							</div>
							<div class="col-6">
							  <div class="form-group">
							    <label for="email">Email</label>
							    <input type="email" class="form-control" id="email" placeholder="email" name="email" required>
							  </div>
						    </div>
					   </div>
					   <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="mobile">Mobile</label>
							    <input type="text" class="form-control" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" required>
							  </div>
							 </div>
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="services">services</label>
							    <input type="text" class="form-control" id="services" placeholder="services" name="services" required>
							  </div>
							 </div>
						</div>
					   <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="Date">Date and Time Preferred</label>
							    <input type="text" class="form-control" id="Date" title="Date" placeholder="Date" name="Date" required>
							  </div>
							 </div>
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="Second">Second Preference</label>
							    <input type="text" class="form-control" id="Second" placeholder="Second" name="Second" required>
							  </div>
							 </div>
						</div>
					  <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="Third">Third Preference</label>
							    <input type="text" class="form-control"  id="mobile" title="Third" placeholder="Third" name="Third" required>
							  </div>
							 </div>
							<div class="col-6">					  
							  <div class="form-group">
							    <label for="Additional">Additional Request</label>
							    <input type="text" class="form-control" id="Additional" placeholder="Additional" name="Additional" required>
							  </div>
							 </div>
						</div>

					  <button type="submit" class="btn btn-primary" name='register' value="register">Submit</button>
					</form>				
				</div>
			</div>
		</div>
	</div>
<!-- </section> -->














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
