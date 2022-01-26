<?php
	session_start();
	require "config/config.php";
	require "config/common.php";

	if($_POST){

		if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['address']) ||
		   empty($_POST['password']) || strlen($_POST['password']) < 4 ){

			if(empty($_POST['name'])){
				$name_error = "name is required";
			}
			if(empty($_POST['email'])){
				$email_error = "email is required";
			}
			if(empty($_POST['phone'])){
				$phone_error = "phone is required";
			}
			if(empty($_POST['address'])){
				$address_error = "address is required";
			}
			if(empty($_POST['password'])){
				$password_error = "password is required";
			}
			if(strlen($_POST['password']) < 4 ){
				$password_error = "password should be 4 characters at least";
			}
		}else{
			
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$password = $_POST['password'];
			$password = password_hash($password,PASSWORD_DEFAULT);

			$statement = $pdo->prepare("SELECT * FROM users WHERE email='$email'");
			$statement->execute();
			$user = $statement->fetchAll();

			if($user){
				echo "<script>alert('this email already exist!');</script>";
			}else{

				$statement = $pdo->prepare("INSERT INTO users(name,email,phone,address,password) VALUES('$name','$email','$phone', '$address','$password')");
				$result  = $statement -> execute();			
				if($result){
					echo "<script>alert('Register successful!Now log in');window.location.href='login.php';</script>";
				}
			}

		}
	}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title> Shop</title>

	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<p class="navbar-brand logo_h m-4">A Programmer Shopping</p>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>A Programmer Shopping</h1>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="login.php">Sign in Here</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register Here</h3>
						<form class="row login_form" action="register.php" method="POST" id="contactForm" novalidate="novalidate">
							<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
								<p style="color:red;"><?php echo empty($name_error) ? "" : $name_error; ?></p>
							</div>	

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="email" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email'">
								<p style="color:red;"><?php echo empty($email_error) ? "" : $email_error; ?></p>
							</div>

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="phone" placeholder="Enter Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone'">
								<p style="color:red;"><?php echo empty($phone_error) ? "" : $phone_error; ?></p>
							</div>	

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="address" placeholder="Enter Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Address'">
								<p style="color:red;"><?php echo empty($address_error) ? "" : $address_error; ?></p>
							</div>	

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="name" name="password" placeholder="Enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'">
								<p style="color:red;"><?php echo empty($password_error) ? "" : $password_error; ?></p>
							</div>	

                            <div class="col-md-12 form-group">
                                <button type="submit" class="primary-btn">Register</button>
                            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	
<!-- start footer Area -->
<footer class="footer-area section_gap">
<div class="container">
<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
  <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
</div>
</div>
</footer>
<!-- End footer Area -->

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
crossorigin="anonymous"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!--gmaps Js-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/main.js"></script>
</body>

</html>

