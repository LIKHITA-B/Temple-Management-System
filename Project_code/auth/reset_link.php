<?php
	require '../config/config.php';

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
			
              <a class="nav-link" href="login.php">Login</a>
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
			  	
			  		<h2 class="text-center" style="color:#000000">Check Your Email!</h2>
				    <form action="" method="post">
					  <div class="form-group">
					   <p> we just sent you an email with a link to reset your password</p>
					  </div>
					

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