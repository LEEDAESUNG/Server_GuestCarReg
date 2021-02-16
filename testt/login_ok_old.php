<?php
    if ( !isset($_POST['dong']) || !isset($_POST['ho']) || !isset($_POST['carno']) ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('입력정보가 틀립니다!');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }
    $dong = $_POST['dong'];
    $ho = $_POST['ho'];
    $carno = $_POST['carno'];
//echo $_POST['dong'];
//echo $_POST['ho'];
//echo $_POST['carno'];
//exit;
		//$conn=mysqli_connect("localhost", "admin", "jawootek", "jwt_sanps");
    include "dbinfo.inc";
		if (!$conn) {
			echo "<script>alert('인터넷 접속이 원활하지 않습니다. 잠시후 재시도 바랍니다!'(I00001));";// echo mysqli_connect_error();
			echo("<script>location.href='login.php';</script>");
			exit;
		}


    $sql = "SELECT * FROM tb_config WHERE NAME = 'GuestCarReg' ";
		$result=mysqli_query($conn, $sql);
		$num_match=mysqli_num_rows($result);
		if(!$num_match) {
      mysqli_close($conn);
			echo("
				<script> window.alert('관리자에게 방문차량 사전등록 설정문의바랍니다(C00001)')
				window.location.replace('login.php');
				</script>
			");
      exit;
    }
    else {
      if($row = mysqli_fetch_array($result))
      {
        if( $row['Content'] <> "Y")
        {
          mysqli_close($conn);
    			echo("
    				<script> window.alert('관리자에게 방문차량 사전등록 설정문의바랍니다(C00002)')
    				window.location.replace('login.php');
    				</script>
    			");
          exit;
        }
      }
      else
      {
        echo "<script>alert('인터넷 접속이 원활하지 않습니다. 잠시후 재시도 바랍니다!'(I00002));";// echo mysqli_connect_error();
  			echo("<script>location.href='login.php';</script>");
  			exit;
      }
    }

		$sql = "SELECT * FROM tb_reg WHERE CAR_GUBUN = '입주민' AND DRIVER_DEPT = '$dong' AND DRIVER_CLASS = '$ho' ";
		$result=mysqli_query($conn, $sql);
		$num_match=mysqli_num_rows($result);

		if(!$num_match) {
      mysqli_close($conn);
			echo("
				<script> window.alert('입력정보를 다시 확인해주세요!')
				window.location.replace('login.php');
				</script>
			");
		} else {
			$row = mysqli_fetch_array($result);
			$db_carno = $row['CAR_NO'];
			mysqli_close($conn);

			//if(!password_verify($userpass, $db_pass)) {
      if($carno != $db_carno) {
				header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호를 다시 확인해주세요!!');";
        echo "window.location.replace('login.php');</script>";
        exit;
			} else {

				session_start();
				$_SESSION['ss_dong'] = $dong;
		    $_SESSION['ss_ho'] = $ho;
        $_SESSION['ss_carno'] = $carno;

        //할인권 라디오버튼 초기값
        setcookie('cookie_SelectDC', '1', time()+(86400*1000), '/');

				echo("<script>location.href='guestcarreg.php';</script>");
			}
		}


		//echo $_SESSION['username']."<br>"; echo $_SESSION['userpass']."<br>";

?>
<!-- <meta http-equiv="refresh" content="0;url=index.php" /> -->
