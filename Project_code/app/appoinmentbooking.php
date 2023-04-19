<?php
	require '../config/config.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

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
				$stmt = $connect->prepare('INSERT INTO appointment (Username, Email, Phonenumber, services, date, second, third, additionalrequest) VALUES (:fullname, :mobile, :username, :email, :password)');
				$stmt->execute(array(
					':fullname' => $fullname,
					
					
					':email' => $email,
					':mobile' => $mobile,
					
					
					':services' => $services,
					':Date' => $Date,
					':Second' => $Second,
					':Third' => $Third,
					
					':Additional' => $Additional,
		

					
					
					
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'Registration successfull. Now you can login';
	}
?>

<?php include '../include/header.php';?>
	<!-- <nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="../index.php">WebSiteName</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right">
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Register</a></li>
	    </ul>
	  </div>
	</nav> -->
	<!-- Services -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
      <div class="container">
       
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <!-- <a class="nav-link" href="register.php">Register</a> -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
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
			  		<h2 class="text-center">Register</h2>
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
							    <input type="email" class="form-control" id="Second" placeholder="Second" name="Second" required>
							  </div>
							 </div>
						</div>
					  <div class="row">
					  	    <div class="col-6">
							  <div class="form-group">
							    <label for="Third">Third Preference</label>
							    <input type="text" class="form-control" pattern="Third" id="mobile" title="Third" placeholder="Third" name="Third" required>
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
<?php include '../include/footer.php';?>
