
<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');

	if(isset($_POST['bookappointment'])) {
			$errMsg = '';
			// Get data from FROM
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$Services = $_POST['Services'];
			$Preference = $_POST['Preference'];
			$Preference2 = $_POST['Preference2'];
			$Preference3 = $_POST['Preference3'];
			$additional = $_POST['additional'];
			


			

			try {
					$sql="INSERT INTO appointment (Username, Email, Phonenumber, Services, date, second, third, additionalrequest) VALUES ($fullname, $email, $mobile, $Services, $Preference, $Preference2, $Preference3, $additional )";
					
					if($connect->query($stmt==TRUE){
						echo "New record created successfully";
					}
					else{
						echo "Error";
					}
                header('Location: bookappointment.php?action=joined');
				//header('Location: register.php?action=reg');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
	}

?>
	
	
	
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="shortcut icon" href="/assets/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <title>Login / Sign Up Form</title>
   
    

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
  padding: 14px 16px;
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
    width: 275px;
    max-width: 275px;
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
    <a  href="../Frontend/priest.php">Priest</a>
    <a  href="../Frontend/services.php">Services</a>
    <a href="../Frontend/calender.php">Calender</a>
    <a  href="../Frontend/gallery.php">Gallery</a>
    <a href="../Frontend/donation.php">Donations</a>
    <a href="../Frontend/education.php">Education</a>
	 <a  href="../Frontend/contact.php">Contact</a>
	 <?php if($_SESSION['role'] == 'admin'){ 
	
	 echo '<a  href="../auth/admin_dashboard.php">Registered Users</a>';
	      	 	} ?>
					<?php if($_SESSION['role'] == 'priest'){ 
	
	 echo '<a  href="../app/priest_sms.php">Send sms</a>';
	      	 	} ?> 
				<?php if($_SESSION['role'] == 'user'){ 
	
	 echo '<a class="active" href="../app/Bookappointment.php">Book Appointment</a>';
	      	 	} ?>
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
   
     
        <center>

        <div class="container_sub">
		<h1>
		
		</h1>
          	
						

<?php
	if(empty($_SESSION['role']))
		header('Location: login.php');

?>

    
        <form class="form" id="bookappointment" method="post">
            <h1 class="form__title">Book an Appointment</h1>
            <div class="form__message form__message--error"></div>
            <div class="form__input-group">
                <input type="text" class="form__input" id="fullname" placeholder="Full Name" name="fullname" required>
				  <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
               
				  <input type="email" class="form__inputl" id="email" placeholder="Email" name="email" required>
				 
                <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
                 <input type="text" class="form__input" pattern="^(\d{10})$" id="mobile" title="10 digit mobile number" placeholder="10 digit mobile number" name="mobile" required>
				 <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
                
				<input type="Services" class="form__input" id="Services" placeholder="Services" name="Services" required>
				 
                <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
               <input type="Preference" class="form__input" id="Preference" placeholder="Date and Time Preferred" name="Preference" required>
				
                <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
               <input type="Preference2" class="form__input" id="Preference2" placeholder="Second Preference" name="Preference2" required>
				
                <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
                <input type="Preference3" class="form__input" id="Preference3" placeholder="Third Preference" name="Preference3" required>
				 <div class="form__input-error-message"></div>
            </div>
			<br>
            <div class="form__input-group">
                <input type="additional" class="form__input" id="additional" name="additional" placeholder="Additional Requests">
                <div class="form__input-error-message"></div>
            </div>
			<br>
              <button type="submit" class="form__button" name='submit' value="submit">Submit</button>
			
        </form>
        
    	
												
						
    
     </div>
  

        

    </center>











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


<script type="text/javascript">
	var rowCount = 1;
	function addMoreRows(frm) {
		rowCount ++;
		var recRow = '<div id="rowCount'+rowCount+'"><div class="row"><div class="col-md-4"><div class="form-group"><br> <a href="javascript:void(0);" onclick="removeRow('+rowCount+');" class="btn btn-danger btn-sm">Delete</a> </div> </div></div><div class="row"> <div class="col-md-4"><div class="form-group"> <label for="fullname">Full Name</label> <input type="fullname" class="form-control" id="fullname" placeholder="Full Name" name="fullname[]" required> </div> </div> <div class="col-md-4"><div class="form-group"> <label for="ap_number_of_plats">Flat Number</label> <input type="ap_number_of_plats" class="form-control" id="ap_number_of_plats" placeholder="Flat Number" name="ap_number_of_plats[]" required> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="rooms">Rooms</label> <input type="rooms" class="form-control" id="rooms" placeholder="2BHK/3BHK/1RK" name="rooms[]" required> </div> </div></div><div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="area">Area</label> <input type="area" class="form-control" id="area" placeholder="Area" name="area[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="purpose">Purpose</label> <select class="form-control" id="purpose" name="purpose[]"> <option value="Residential">Residential</option> <option value="Commercial">Commercial</option> </select> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="floor">Floor</label> <select class="form-control" id="floor" name="floor[]"> <option value="Ground Floor">Ground Floor</option> <option value="1st">1st</option> <option value="2nd">2nd</option> <option value="3rd">3rd</option> <option value="4th">4th</option> <option value="5th">5th</option> <option value="6th">6th</option> <option value="7th">7th</option> <option value="8th">8th</option> </select> </div> </div> </div> <div class="row"><div class="col-md-4"> <div class="form-group"> <label for="ownership">Owner/Rented</label> <select class="form-control" id="ownership" name="own[]"> <option value="owner">Owner</option> <option value="rented">Rented</option> </select> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="rent">Rent</label> <input type="rent" class="form-control" id="rent" placeholder="Rent" name="rent[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="deposit">Deposit</label> <input type="deposit" class="form-control" id="deposit" placeholder="Deposit" name="deposit[]"> </div> </div>  </div><div class="row"><div class="col-md-4"> <div class="form-group"> <label for="accommodation">Facilities</label> <input type="accommodation" class="form-control" id="accommodation" placeholder="Facilities" name="accommodation[]"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="description">Description</label> <input type="description" class="form-control" id="description" placeholder="Description" name="description[]" required> </div> </div> <div class="col-4"> <div class="form-group"> <label for="vacant">Vacant/Occupied</label> <select class="form-control" id="vacant" name="vacant[]"> <option value="1">Vacant</option> <option value="0">Occupied</option> </select> </div> </div> </div></div>'; $('#addedRows').append(recRow);
	}
	function removeRow(removeNum) {
		$('#rowCount'+removeNum).remove();
	}
</script>