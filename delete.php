<?php
  session_start();
  if(!isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho'])) {
      echo "<p>로그인 해 주세요. <a href=\"login.php\">[로그인]</a></p>";
      echo("<script>location.href='login.php';</script>");
  } else {

    $dong=$_SESSION['ss_dong'];
    $ho=$_SESSION['ss_ho'];
    $carno=$_SESSION['ss_carno'];
    $loginID = $_SESSION['ss_loginID'];

    $seq = 0;
    $guestCarno="";
    $guestName="";
    $guestTel="";
    $guestSdata="";
    $guestEdata="";
    $dt = date("Y-m-d H:i:s");

    if(isset($_GET['no']))    {
      $seq = $_GET['no'];
    }
    if(isset($_GET['carno']))    {
      $guestCarno=$_GET['carno'];
    }
    if(isset($_GET['sdate']))    {
      $guestSdata=$_GET['sdate'];
    } else {
      $guestSdata=date("Y-m-d");
    }
    if(isset($_GET['edate']))    {
      $guestEdata=$_GET['edate'];
    } else {
      $guestEdata=date("Y-m-d");
    }

    //$conn=mysqli_connect("localhost", "admin", "jawootek", "jwt_sanps");
    include "dbinfo.inc";
    //$sql = "SELECT * FROM tb_guestReg WHERE seq = '$_GET[no]' AND PASS_YN = 'Y' ";
    $sql = "SELECT * FROM tb_guestReg WHERE seq = $seq AND PASS_YN = 'Y' ";

		$result=mysqli_query($conn, $sql);
		$num_match=mysqli_num_rows($result);
		if($num_match) {
      mysqli_close($conn);
      echo "<script>alert('입차차량은 삭제할 수 없습니다.');</script>";
      $param = "index.php?carno=".$guestCarno."&sdate=".$guestSdata."&edate=".$guestEdata;
      echo "<script>window.location.replace('".$param."');</script>";
      exit;
    }


    $sql = "delete from tb_guestReg where seq = $seq AND PASS_YN = 'N' ";
    $result = mysqli_query($conn, $sql);
    if( $result)
    {
      $sql = "insert into tb_reg_log (CAR_NO,CAR_GUBUN,DRIVER_NAME,DRIVER_PHONE,DRIVER_DEPT,DRIVER_CLASS,START_DATE,END_DATE,REG_DATE,ACTION_LOG,ACTION_ID) VALUES ( '$guestCarno','방문예약','$guestName','$guestTel','$dong','$ho','$guestSdata','$guestEdata','$dt','삭제','$loginID') ";
      $result = mysqli_query($conn, $sql);

      mysqli_close($conn);
      header("Content-Type: text/html; charset=UTF-8");
      echo "<script>alert('삭제되었습니다.');</script>";
      $param = "index.php?carno=".$guestCarno."&sdate=".$guestSdata."&edate=".$guestEdata;
      echo "<script>window.location.replace('".$param."');</script>";
    }
    else {
      mysqli_close($conn);
      $param = "index.php?carno=".$guestCarno."&sdate=".$guestSdata."&edate=".$guestEdata;
      echo "<script>window.location.replace('".$param."');</script>";
    }


  }
 ?>
