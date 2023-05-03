<?php
	require '../config/config.php';
	

	if($_SESSION['role'] == 'admin'){
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
    <a class="active" href="donation.php">Donations</a>
    <a href="education.php">Education</a>
    <a  href="contact.php">Contact</a>
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
   
    
        <center>
  <h2> Donations </h2>
      <h2><p>NPO ID#: 17053281338009</p></h2>
      <br>
      <p>Omkaar Temple is a Non-Profit Organization and all donations are tax deductible.</p>
      <p>Thank you for considering to donate to Omkaar Temple. The building of Omkaar Temple is truly an undertaking of epic proportions and a donation of any amount goes a long way. The growth of the Temple as well as associated religious activities depends greatly upon the generous donations of devotees like you. Thank you again for helping our community realize its collective dream for Omkaar Temple.</p>
     
<br>	 <p><b>-Omkaar Temple Administration</b></p>
        
<br>
        <div class="container_sub">
           <h4>One time Donation: </h4>
          <h5 class="price">via Credit Card, Bank Transfer,
            or PayPal</h5>
          <button onclick="window.location.href='https://www.paypal.com/donate?token=28uZwTndjibhseujJeBfDu1Ul3c952UgCsOYKNkK4a1rRqVibqnC3t1GFamX2KdvhqUC_J18VjherdCQ';">
            Donate
          </button>
          </div>

    <div class="container_sub">
    <h4>Monthly Donation: </h4>
          <h5 class="price">via Credit Card, Bank Transfer,
            or PayPal. Cancel anytime <a href="https://www.paypal.com/signin?returnUri=https%3A%2F%2Fwww.paypal.com%2Fmyaccount%2Fautopay&state=%2F">here</a>
          </h5>
          <label for="Pledge">Amount:</label>
          <select name="pledge" id="pledge">
            <option value="Pledge: $11 USD per month">Pledge: $11 USD per month</option>
            <option value="Pledge: $21 USD per month">Pledge: $21 USD per month</option>
            <option value="Pledge: $51 USD per month">Pledge: $51 USD per month</option>
            <option value="Pledge: $101 USD per month">Pledge: $101 USD per month</option>
            <option value="Pledge: $251 USD per month">Pledge: $251 USD per month</option>
            <option value="Pledge: $501 USD per month">Pledge: $501 USD per month</option>
            <option value="Pledge: $1001 USD per month">Pledge: $1001 USD per month</option>
          </select>
          <button onclick="window.location.href='https://www.paypal.com/signin?returnUri=https%3A%2F%2Fwww.paypal.com%2Fmyaccount%2Fautopay&state=%2F';">
            Donate
          </button>
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
