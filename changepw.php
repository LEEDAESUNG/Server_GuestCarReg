<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>방문예약시스템(입주민)</title>
  <link rel="icon" type="image/png" href="images/icons/Parking_Red.ico"/>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

	<script src="vendor/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

		$('#changePW-submit').click(function(e){
				e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다
				if($("#InputNowPassword").val() ==''){
						alert('현재 비밀번호를 입력하세요');
						$("#InputNowPassword").focus();
						return false;
				}
				if($("#InputNewPassword").val() ==''){
						alert('변경할 비밀번호를 입력하세요');
						$("#InputNewPassword").focus();
						return false;
				}

				$.ajax({
						url: 'changepw_ok.php',
						type: 'POST',
						data: {
									nowPassword:$("#InputNowPassword").val(),
									newPassword:$("#InputNewPassword").val()
						},
						dataType: "json",
						success: function (response) {
							if(response.result == 1){
									alert('비밀번호 변경 완료했습니다.ok!');
									location.replace('/changepw.php');
							} else if(response.result == 0){
									alert('현재 비밀번호가 틀립니다(PW_E000)');
							} else if(response.result == -1){
									alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E001)');
							} else if(response.result == -2){
									alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E002)');
							} else if(response.result == -3){
									alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E003)');
							} else if(response.result == -4){
									alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E004)');
								} else if(response.result == -5){
										alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E005)');
							} else {
									alert('비밀번호 변경중 에러가 발생했습니다. 잠시후 재시도하세요(PW_E006)');
							}
										$("#InputNowPassword").val("");
										$("#InputNewPassword").val("");
						},
						error: function(jqXHR, textStatus, errorThrown) {
								//alert("ajax error : " + textStatus + "\n" + errorThrown);
                alert('정의되지 않은 에러 발생. 동일현상 반복 발생시 관리실 문의바랍니다(PW_E999)');
						//error: function(request,status,error) {
						//			alert("ajax code : " + request.status + "\n" + "ajax message : "+ request.responseText + "\n" + "ajax error : " + error);
									$("#InputNowPassword").val("");
									$("#InputNewPassword").val("");
						}
				});
		});


});

</script>


</head>



  <?php

    session_start();
    if( !isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho']) ) {
        echo "<p>로그인을 해 주세요. <a href=\"login.php\">[로그인]</a></p>";
        echo("<script>location.href='login.php';</script>");
        exit();
    } else {
        //$username = $_SESSION['username'];
        //$userpass = $_SESSION['userpass'];
        //echo "<p><strong>$_SESSION['username'].</strong>님 환영합니다.";
        //echo "<a href=\"logout.php\">[로그아웃]</a></p>";
    }
  ?>

  <body>
		<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href = "/guestcarreg.php" >
      <div style="color:black; font-weight:bold; font-size:1.0em;">
      <img src="/images/icons/Parking_Red.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      방문예약시스템</div>
    </a>
    </nav>

  <div class="d-flex" id="wrapper">

    <?php include "Leftmenu.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">메뉴</button>

&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn btn-info" value="비밀번호변경">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>

      <div class="container-fluid">

				<table class="table table-striped">
		      <form role="form">
		        <head>
								<br>
						    <div >
						      <!-- <img src="/images/icons/key2.ico" width="30" height="30"/> -->
                  <img src="/images/icons/key2.png" />
						    </div>
						    <div>
						      <input type="text" id="InputNowPassword" name="InputNowPassword" placeholder="현재 비밀번호">
						      <input type="text" id="InputNewPassword" name="InputNewPassword" placeholder="변경할 비밀번호">
						      <!--<input type="submit" id="changePW-submit" class="fadeIn fourth" value="비밀번호 변경"> -->
									<button type="submit" id="changePW-submit" class="btn btn-primary" >
										비밀번호 변경<i class="fa fa-check spaceLeft"></i></button> <!--fa-check:awesome font -->
						    </div>
						</head>
					</form>
				</table>
				</div>
			</div>




  <!-- Bootstrap core JavaScript -->
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
