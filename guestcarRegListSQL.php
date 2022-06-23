<?php
    $searchCarno = "";
    $searchStartDate = "";
    $searchEndDate = "";

    if(isset($_GET['carno'])) {
      $carno = $_GET['carno'];
    }
    else {
      $carno = "";
    }

    if(isset($_GET['sdate'])) {
      $sdate = $_GET['sdate'];
      $startDate = $sdate." 00:00:00";
    }
    else {
      $startDate = date("Y-m-d").' 00:00:00';
    }

    if(isset($_GET['edate'])) {
      $edate = $_GET['edate'];
      $endDate = $edate." 23:59:59";
    }
    else {
      $endDate = date("Y-m-d").' 23:59:59';
    }

    $searchCarno = $carno;
    $searchStartDate = $sdate;
    $searchEndDate = $edate;

    $dt = date("Y-m-d").' 00:00:00'; //오늘날짜

    session_start();
    $dong = $_SESSION['ss_dong'];
    $ho = $_SESSION['ss_ho'];

    //동,호수 3자리 경우 4자리로 변환
    $dong = (int)$dong;
    $dong2 = sprintf('%04d',$dong);
    $ho = (int)$ho;
    $ho2 = sprintf('%04d',$ho);

    if(strlen($carno) >= 4 ) {
      if(strlen($startDate) > 0 && strlen($endDate) > 0) {
        //$sql = "select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND '$startDate' <= REG_DATE AND REG_DATE<='$endDate' ORDER BY REG_DATE DESC ";
        //$sql = "select * from tb_guestReg where CAR_NO like '%$carno%' AND (DRIVER_DEPT = '$dong' OR DRIVER_DEPT = '$dong2') AND (DRIVER_CLASS = '$ho' OR DRIVER_CLASS = '$ho2') AND ('$startDate' <= START_DATE AND END_DATE<='$endDate') ORDER BY START_DATE ";
        $sql = "select * from tb_guestReg where CAR_NO like '%$carno%' AND (DRIVER_DEPT = '$dong' OR DRIVER_DEPT = '$dong2') AND (DRIVER_CLASS = '$ho' OR DRIVER_CLASS = '$ho2') AND ('$startDate' <= START_DATE AND END_DATE<='$endDate') ORDER BY REG_DATE ";
      }
    }
    else {
        if(strlen($startDate) > 0 && strlen($endDate)>0) {
          //$sql = "select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND '$startDate' <= REG_DATE AND REG_DATE<='$endDate' ORDER BY REG_DATE DESC ";
          //$sql = "select * from tb_guestReg where (DRIVER_DEPT = '$dong' OR DRIVER_DEPT = '$dong2') AND (DRIVER_CLASS = '$ho' OR DRIVER_CLASS = '$ho2') AND ('$startDate' <= START_DATE AND END_DATE<='$endDate') ORDER BY START_DATE ";
          $sql = "select * from tb_guestReg where (DRIVER_DEPT = '$dong' OR DRIVER_DEPT = '$dong2') AND (DRIVER_CLASS = '$ho' OR DRIVER_CLASS = '$ho2') AND ('$startDate' <= START_DATE AND END_DATE<='$endDate') ORDER BY REG_DATE ";
        }
    }

?>
