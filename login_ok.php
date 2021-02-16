<?php
    if ( !isset($_POST['LoginID']) ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('입력정보가 틀립니다.재시도 바랍니다!(LE_001)');";
        echo "window.location.replace('login.php');</script>";
        exit;
    }

    $LoginID = $_POST['LoginID'];
    $LoginPW = $_POST['LoginPW'];

		//$conn=mysqli_connect("localhost", "admin", "jawootek", "jwt_sanps");
    include "dbinfo.inc";
		if (!$conn) {
			echo "<script>alert('인터넷 접속이 원활하지 않습니다. 잠시후 재시도 바랍니다!(LE_002)');";
			echo("<script>location.href='login.php';</script>");
			exit;
		}


    $sql = "SELECT * FROM tb_config WHERE NAME = 'GuestCarReg' ";

		$result=mysqli_query($conn, $sql);
		$num_match=mysqli_num_rows($result);
		if(!$num_match) {
      mysqli_close($conn);
			echo("
				<script> window.alert('관리자에게 방문차량 사전등록 설정문의바랍니다(LE_003)')
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
    				<script> window.alert('관리자에게 방문차량 사전등록 설정문의바랍니다(LE_004)')
    				window.location.replace('login.php');
    				</script>
    			");
          exit;
        }
      }
      else
      {
        echo "<script>alert('인터넷 접속이 원활하지 않습니다. 잠시후 재시도 바랍니다(LE_005)');";// echo mysqli_connect_error();
  			echo("<script>location.href='login.php';</script>");
  			exit;
      }
    }

		//$sql = "SELECT * FROM tb_reg WHERE CAR_GUBUN = '입주민' AND DRIVER_DEPT = '$dong' AND DRIVER_CLASS = '$ho' ";
    $sql = "SELECT * FROM tb_guestreg_admin WHERE ID = '$LoginID' ";

		$result=mysqli_query($conn, $sql);
		$num_match=mysqli_num_rows($result);

		if(!$num_match) {
      mysqli_close($conn);
			echo("
				<script> window.alert('입력정보를 다시 확인해주세요(LE_006)')
				window.location.replace('login.php');
				</script>
			");

		} else {
			$row = mysqli_fetch_array($result);
      $db_use_yn = $row['USE_YN'];

      if($db_use_yn=="Y") {
    			$db_passwrod = $row['PASSWORD'];

    			//if(!password_verify($userpass, $db_pass)) {
          if($LoginPW == $db_passwrod) {

            $carno = $row['CARNO'];
            $dong = $row['DRIVER_DEPT'];
            $ho = $row['DRIVER_CLASS'];
            $name = $row['NAME'];
            $tel = $row['TEL'];

    				session_start();
    				$_SESSION['ss_loginID'] = $LoginID; //위로 이동
    		    $_SESSION['ss_loginPW'] = $LoginPW;
            $_SESSION['ss_carno'] = $carno;
            $_SESSION['ss_dong'] = $dong;
            $_SESSION['ss_ho'] = $ho;
            $_SESSION['ss_name'] = $name;
            $_SESSION['ss_tel'] = $tel;
            mysqli_close($conn);

            setcookie('cookie_SelectDC', '1', time()+(86400*1000), '/');
    				echo("<script>location.href='guestcarreg.php';</script>");
    			}
          else {
            mysqli_close($conn);

    				header("Content-Type: text/html; charset=UTF-8");
            echo "<script>alert('아이디 또는 비밀번호를 다시 확인해주세요!!(LE_007)');";
            echo "window.location.replace('login.php');</script>";
            exit;
          }
      }
      else {

        $db_passwrod = $row['PASSWORD'];

        if($LoginPW == $db_passwrod)
        {

            if($LoginPW=='0000')
            {
                mysqli_close($conn);

                echo "<form style='display: hidden' action='personinfo.php' method='POST' id='form'> ";
                    echo "<input type='hidden' id='loginID' name='loginID' value=" . (string)$LoginID . ">";
                echo "</form> ";
                echo "$('#form').submit()";
                ?>
                <script> form.submit(); </script>

                <?php
                exit;
            }
            else
            {
                header("Content-Type: text/html; charset=UTF-8");
                echo "<script>alert('관리실 사용승인 대기중입니다(LE_008)');";
                echo "window.location.replace('login.php');</script>";
            }
        }
        else
        {
          mysqli_close($conn);

          header("Content-Type: text/html; charset=UTF-8");
          echo "<script>alert('아이디 또는 비밀번호를 다시 확인해주세요!!(LE_009)');";
          echo "window.location.replace('login.php');</script>";
          exit;
        }
		}
  }

?>
<!-- <meta http-equiv="refresh" content="0;url=index.php" /> -->
