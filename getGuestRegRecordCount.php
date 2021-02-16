<?php

    include "dbinfo.inc";

    if(isset($_GET['carno'])) {
      $carno = preg_replace("/\s+/", "", $_GET['carno']);
    }
    else {
      $carno = "";
    }
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
    }
    else {
      $page = "1";
    }

    if(isset($_GET['sdate'])) {
      $startDate = $_GET['sdate'];
      $startDate = $startDate." 00:00:00";
    }
    else {
      $startDate = "";
    }
    if(isset($_GET['edate'])) {
      $endDate = $_GET['edate'];
      $endDate = $endDate." 23:59:59";
    }
    else {
      $endDate = "";
    }

    session_start();
    $dong = $_SESSION['ss_dong'];
    $ho = $_SESSION['ss_ho'];

    $dt = date("Y-m-d").' 00:00:00'; //오늘날짜

    if(strlen($carno) == 4 ) {
      if(strlen($startDate) > 0 && strlen($endDate) > 0) {
        $sql = " select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate' AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
      }
      else {
        $sql = " select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
      }
    }
    else {
        if(strlen($startDate) > 0 && strlen($endDate)>0) {
          $sql = " select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
        }
        else {
          $sql = " select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
        }
    }

//echo $dt; // ajax에서 처리할 경우 에러발생



    // $sql = "select * from tb_guestReg ";
    $result = mysqli_query($conn, $sql);
    $total_rows = mysqli_num_rows($result);
    mysqli_close($conn);

    $totalCnt = $total_rows;
    //$totalCnt = 100;  // 전체레코드수
    $dataSize = 10;   // 한 페이지에 보여질 레코드 수
    $pageSize = 10;   // 페이지 표시 수( 1 2 3 4 5 6 7 8 9 10)

?>
