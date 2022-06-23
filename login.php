<?php
session_start();
if(isset($_SESSION['ss_dong']) && isset($_SESSION['ss_ho']) ) {
		echo("<script>location.href='index.php';</script>");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--<title>방문차량 예약 시스템</title>-->
	<title>방문예약 시스템</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<!--<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>-->
	<link rel="icon" type="image/png" href="images/icons/Parking_Red.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand mb-0 h1" href = "/guestcarreg.php" >
			<div style="color:black; font-weight:bold; font-size:1.0em;">
      <img src="/images/icons/Parking_Red.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      방문예약 시스템</div>
		</a>
	</nav>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				<form class="login100-form validate-form flex-sb flex-w" method="post" action="login_ok.php">
					<!-- <span class="login100-form-title p-b-51">
						방문예약 시스템
					</span> -->
					<img class="wrap-input100 validate-input m-b-16"  src="/images/icons/bi.jpg" align = 'center' ></a>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "아이디를 입력하세요">
						<input class="input100" type="text" name="LoginID" placeholder="아이디" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='아이디';">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "비밀번호를 입력하세요">
						<input class="input100" type="text" name="LoginPW" placeholder="비밀번호" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='비밀번호';">
						<span class="focus-input100"></span>
					</div>

<!--
					<div class="wrap-input100 validate-input m-b-16" data-validate = "차량번호를 입력하세요">
						<input class="input100" type="text" name="carno" placeholder="차량번호 전체 또는 휴대폰번호 입력" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='차량번호 전체 또는 휴대폰번호 입력';">
						<span class="focus-input100"></span>
					</div>
-->
<!--
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>

							<a href="#" class="txt1">
								Forgot?
							</a>
						</div>
					</div>
-->
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							로그인..
						</button>
					</div>


					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn" onclick="location.href='signup.php'">
							>가입신청<
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
