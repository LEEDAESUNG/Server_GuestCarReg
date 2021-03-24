<?php
  session_start();
  if( !isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho']) || !isset($_SESSION['ss_carno']) ) {
      echo "<p>로그인 해 주세요. <a href=\"login.php\">[로그인]</a></p>";
      echo("<script>location.href='login.php';</script>");
  }

  else
  {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    include "getParkPoint.php";

    if( $db_maxparktime > 0 && $db_maxparktime <= $db_nowparktime) {
      echo("
				<script> window.alert('사전방문예약 주차시간 초과했습니다. 관리실에 문의바랍니다(IS_E001)')
				window.location.replace('guestcarreg.php');
				</script>
			");
      exit();
    }
    if( $db_maxparkcount > 0 && $db_maxparkcount <= $db_nowparkcount) {
      echo("
				<script> window.alert('사전방문예약 신청횟수 초과했습니다. 관리실에 문의바랍니다(IS_E002)')
				window.location.replace('guestcarreg.php');
				</script>
			");
      exit();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $dong = $_SESSION['ss_dong'];
    $ho = $_SESSION['ss_ho'];
    $carno = $_SESSION['ss_carno'];
    $loginID = $_SESSION['ss_loginID'];

    $guestCarno = "";
    $guestName = "";
    $guestTel = "";
    $guestInDate = "";
    $guestSdata="";
    $guestEdata="";
    if(isset($_POST['GuestCarno']))    {
      //$guestCarno=$_POST['GuestCarno'];
      //$guestCarno=preg_replace("/\s+/", "", $guestCarno); //모든 공백제거
      $guestCarno=preg_replace("/\s+/", "", $_POST['GuestCarno']); //모든 공백제거
    }
    if(isset($_POST['GuestName']))    {
      //$guestName=$_POST['GuestName'];
      $guestName=preg_replace("/\s+/", "", $_POST['GuestName']); //모든 공백제거
    }
    if(isset($_POST['GuestTel']))    {
      //$guestTel=$_POST['GuestTel'];
      $guestTel=preg_replace("/\s+/", "", $_POST['GuestTel']); //모든 공백제거
    }
    if(isset($_POST['GuestInDate']))    {
      $guestInDate=$_POST['GuestInDate'];
      $guestSdata=$guestInDate." 00:00:00";
      //$guestEdata=$guestInDate." 23:59:59";
    }
    if(isset($_POST['GuestOutDate']))    {
      $guestOutDate=$_POST['GuestOutDate'];
      $guestEdata=$guestOutDate." 23:59:59";
    }

    //한글:3byte
    if(strlen($guestCarno)<9)
    {
      //echo "<p>입력데이터 오류입니다. 다시 입력해주세요. <a href=\"guestcarreg.php\">[재시도2]</a></p>";
      //echo("<script>location.href='guestcarreg.php';</script>");
      echo("
        <script> window.alert('차량번호 전체 입력바랍니다. 다시 입력해주세요.(I00001)');
			           window.location.replace('guestcarreg.php');
        </script>
      ");
      exit;
    }
    if(strcmp($guestInDate,$guestOutDate)>0 )
    {
      echo("
        <script> window.alert('방문예약일자를 재확인해주세요.(I00003)');
			           window.location.replace('guestcarreg.php');
        </script>
      ");
      exit;
    }


    //$conn=mysqli_connect("localhost", "admin", "jawootek", "jwt_sanps");
    include "dbinfo.inc";
		if (!$conn)
    {
      mysqli_close($conn);
      echo("
        <script> window.alert('인터넷 접속이 원활하지 않습니다. 잠시후 재시도 바랍니다.(I00004)');
			           window.location.replace('guestcarreg.php');
        </script>
      ");
			exit();
		}
    $sql = "SELECT * FROM tb_guestReg WHERE CAR_NO = '$guestCarno' ";
		$result=mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result))
    {
        $sch_Carno = $row['CAR_NO'];
        $sch_StartDate = $row['START_DATE'];
        $sch_EndDate = $row['END_DATE'];

        if(strcmp($guestEdata,$sch_StartDate)<0 || strcmp($guestSdata,$sch_EndDate)>0 )
        {
             //신규등록 가능
        }
        else
        {
            mysqli_close($conn);
            echo("
            	  <script> window.alert('기존 등록차량의 방문예약일과 중복됩니다.(I00005)');
            	           window.location.replace('guestcarreg.php');
            	  </script>
            ");
            exit();
        }
    }


    //최대 중복입차건수 초과차량인지 확인
    include "getguestconfig.php";
    include "dbinfo.inc";
    $sql = "SELECT INCOUNT FROM tb_guestReg_limit WHERE CAR_NO = '$guestCarno' AND DRIVER_DEPT = '$dong' AND DRIVER_CLASS = '$ho' ";
		$result=mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($result);
    if($total_rows > 0)
    {
      if($row = mysqli_fetch_array($result)) {

          $DupinCount = $row['INCOUNT'];

          if($DupinCount>=$db_guestcar_MaxDupInCar){ //limit 값 조회
                mysqli_close($conn);

                echo("
                    <script> window.alert('중복입차횟수 초과 차량번호입니다\\n해당 차량번호는 이번 달 말까지 등록할 수 없습니다.\\n기타 문의사항은 관리실로 문의바랍니다.');
                             window.location.replace('guestcarreg.php');
                	  </script>
                ");
                exit();
            }
        }
    }

    $dt = date("Y-m-d H:i:s");
    $sql = "insert into tb_guestReg (CAR_NO,CAR_GUBUN,CAR_FEE,DRIVER_NAME,DRIVER_PHONE,DRIVER_DEPT,DRIVER_CLASS,START_DATE,END_DATE,REG_DATE,DAY_ROTATION_YN,LANE1,LANE2,LANE3,LANE4,LANE5,LANE6,WEEK1,WEEK2,WEEK3,WEEK4,WEEK5,WEEK6,WEEK7,ROTATION,PASS_YN,GUESTREG_ID) VALUES ( '$guestCarno','방문예약','0','$guestName','$guestTel','$dong','$ho','$guestSdata','$guestEdata','$dt','적용','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','N','N','$loginID') ";
    $result = mysqli_query($conn, $sql);
    if( $result)
    {
      $sql = "UPDATE tb_guestreg_admin SET NOWPARKCOUNT=NOWPARKCOUNT+1 WHERE ID = '$loginID' ";
      $result = mysqli_query($conn, $sql);

      $sql = "insert into tb_reg_log (CAR_NO,CAR_GUBUN,CAR_FEE,DRIVER_NAME,DRIVER_PHONE,DRIVER_DEPT,DRIVER_CLASS,START_DATE,END_DATE,REG_DATE,ACTION_LOG,ACTION_ID,LANE1,LANE2,LANE3,LANE4,LANE5,LANE6,WEEK1,WEEK2,WEEK3,WEEK4,WEEK5,WEEK6,WEEK7,ROTATION) VALUES ( '$guestCarno','0','방문예약','$guestName','$guestTel','$dong','$ho','$guestSdata','$guestEdata','$dt','등록','$carno','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','N') ";
      $result = mysqli_query($conn, $sql);

      mysqli_close($conn);
      header("Content-Type: text/html; charset=UTF-8");
      echo "<script>alert('방문예약차량 등록했습니다.');";
      echo "window.location.replace('guestcarreg.php');</script>";
    }
    else {
      mysqli_close($conn);
      header("Content-Type: text/html; charset=UTF-8");
      echo "<script>alert('방문예약차량 등록실패했습니다. 재시도하세요.(I00006)');";
      echo "window.location.replace('guestcarreg.php');</script>";
    }

  }
 ?>
