<?php
	require '../config/config.php';
	if(empty($_SESSION['username']))
		header('Location: login.php');	

		try {
			$stmt = $connect->prepare('SELECT * FROM users');
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}

		if(isset($_POST['sms_alert'])) {
			try {
				print_r($_POST);
				foreach ($_POST['check'] as $key => $value) {
					# code...
					//echo '<br>'.$value.'<br>';
					//send sms api code here
				}

				exit();
				header('Location: sms.php');
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}


		// print_r($data);	
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


    <a  href="home.html">Home</a>
    <a  href="mission.html">Mission</a>
    <a href="priest.html">Priest</a>
    <a  href="services.html">Services</a>
    <a href="calender.html">Calender</a>
    <a href="gallery.html">Gallery</a>
    <a href="donation.html">Donations</a>
    <a href="education.html">Education</a>
    <a class="active" href="contact.html">Contact</a>
    <div class="topnav-right">
	 <a class="nav-link" href="#"><?php echo $_SESSION['fullname']; ?> <?php if($_SESSION['role'] == 'admin'){ echo "(Admin)"; } ?></a>
            
      <a  href="logout.php">Logout</a>
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
					if(isset($errMsg)){
						echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
					}
				?>
				<h2>List Of Usres</h2>
				<div class="table-responsive text-center">
					<form action="" method="post">
						<table class="table table-bordered">
						  <thead>
						    <tr>
						      <th><input type="checkbox" name="" id="selectAll"></th>
						      <th>Full Name</th>
						      <th>Moblie</th>
						      <!-- <th>Username</th> -->
						      <!-- <th>Role</th> -->
						      <!-- <th>Action</th> -->
						    </tr>
						  </thead>
						  <tbody>
						  	<?php 
						  		foreach ($data as $key => $value) {
						  			# code...				  			
								   echo '<tr>';
								      echo '<th scope="row"><input type="checkbox" name="check[]" value="'.$value['mobile'].'" id="selectAll$key"></th>';
								      echo '<td>'.$value['fullname'].'</td>';
								      echo '<td>'.$value['mobile'].'</td>';
								      //echo '<td>'.$value['username'].'</td>';
								      //echo '<td>'.$value['role'].'</td>';
								      // echo '<td></td>';
								   echo '</tr>';
						  		}
						  	?>
						  </tbody>
						</table>
						<input type="textarea" name="message" class="form-control" placeholder="Enter Message(Message Body)" required>
						<br>
						<button type="submit" class="btn btn-success" name='sms_alert' value="sms_alert">Send SMS</button>
					</form>
				</div>
			
						
    
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









<?php include '../include/footer.php';?>
<script type="text/javascript">

	$('#selectAll').click(function(){
		console.log("Welcome to sms alert"+$(this).prop("checked"));	
		$("input:checkbox").prop('checked', $(this).prop("checked"));	
		//alert("Confirm Before sending SMS");
		//event.preventDefault();	
	});
	
	
</script>