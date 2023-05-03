<?php
	require '../config/config.php';
	
	if(isset($_POST['login'])) {

		// Get data from FORM
		$username = $_POST['username'];
		$email = $_POST['username'];
		$password = $_POST['password'];

		try {
			$stmt = $connect->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
			$stmt->execute(array(
				':username' => $username,
				':email' => $email
				));
			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			if($data == false){
				$errMsg = "User $username not found.";
			}
			else {
				if(md5($password) == $data['password']) {
					$_SESSION['id'] = $data['id'];
					$_SESSION['username'] = $data['username'];
					$_SESSION['fullname'] = $data['fullname'];
					$_SESSION['role'] = $data['role'];
					if ($_SESSION['role'] =="admin"){
					header('Location: admin_dashboard.php');
					exit;}
					if ($_SESSION['role'] =="priest"){
					header('Location: ../Frontend/Home.php');
					exit;}
					if ($_SESSION['role'] =="user"){
					header('Location: ../Frontend/Home.php');
					exit;}
				}
				else
					$errMsg = 'Password not match.';
			}
		}
		catch(PDOException $e) {
			$errMsg = $e->getMessage();
		}
	}
?>

<html>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
    background-image:url('back2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
<body>



<?php include '../include/header.php';?>
	<!-- Services -->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#212529;" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="../Frontend/FrontPage.php">Home</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <!-- <a class="nav-link" href="login.php">Login</a> -->
            </li>
            <li class="nav-item">
			
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section id="services">
		<div class="container">
			<div class="row">				
			  <div class="col-md-4 mx-auto">
			  	<div class="alert alert-info" role="alert" style="background: #eba349;">
			  		<?php
						if(isset($errMsg)){
							echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
						}
					?>
			  		<h2 class="text-center" style="color:#000000">Login</h2>
				    <form action="" method="post">
					  <div class="form-group">
					    <label for="exampleInputEmail1" style="color:#000000">Email Address/User Name</label>
					    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="username" required>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1" style="color:#000000">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
					  </div>
					  <button type="submit" class="btn btn-primary" name='login' style="background-color: #de572a;" value="Login">Submit</button>
					  <a  href="forgot_password.php" style="color:#000000"><p> Forgot your password?</p></a>
					  <br>
					  
					  
					</form>				 
				 </div>
			</div>
			</div>
		</div>
	</section>
<?php include '../include/footer.php';?>



</body>
</html>