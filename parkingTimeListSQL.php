<?php
session_start();

    if(isset($_GET['carno'])) {
      $carno = $_GET['carno'];
    }
    else {
      $carno = "";
    }
    // if(isset($_GET['dong'])) {
    //   //$dong = $_GET['dong'];
    //   $dong = (int)$_GET['dong'];
    //   $dong2 = sprintf('%04d',$dong);
    // }
    // else {
    //   $dong = "";
    //   $dong2 = "";
    // }
    // if(isset($_GET['ho'])) {
    //   //$ho = $_GET['ho'];
    //   $ho = (int)$_GET['ho'];
    //   $ho2 = sprintf('%04d',$ho);
    // }
    // else {
    //   $ho = "";
    //   $ho2 = "";
    // }
    if(isset($_SESSION['ss_dong'])){
      $dong = $_SESSION['ss_dong'];
      $dong2 = $_SESSION['ss_dong'];
    }
    else{
      $dong = "-";
      $dong2 = "-";
    }
    if(isset($_SESSION['ss_ho'])){
      $ho = $_SESSION['ss_ho'];
      $ho2 = $_SESSION['ss_ho'];
    }
    else{
      $ho = "-";
      $ho2 = "-";
    }

    //동,호수 3자리 경우 4자리로 변환
    $dong = (int)$dong;
    $dong2 = sprintf('%04d',$dong);
    $ho = (int)$ho;
    $ho2 = sprintf('%04d',$ho);

    if(isset($_GET['id'])) {
      $id = $_GET['id'];
    }
    else {
      $id = "";
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
      //$endDate = date("Y-m-d").' 00:00:00';
      $endDate = date("Y-m-d").' 23:59:59';
    }
    $dt = date("Y-m-d").' 00:00:00'; //오늘날짜


    //$sql = "SELECT DRIVER_DEPT, DRIVER_CLASS, CAR_NO, count(*) as INCOUNT from tb_guestReg where '$startDate' <= START_DATE AND END_DATE<='$endDate' AND";
    //$sql = "SELECT * from tb_guestReg_parktime where '$startDate' <= REG_DATE AND REG_DATE<='$endDate' AND";
    //$sql = "SELECT * from tb_guestReg_parktime where '$startDate' <= IN_TIME AND OUT_TIME<='$endDate' AND";
    //$sql = "SELECT * from tb_guestReg_parktime where '$startDate' <= REG_DATE AND REG_DATE<='$endDate' AND";
    $sql = "SELECT * from tb_guestReg_parktime where '$startDate' <= IN_TIME AND IN_TIME<='$endDate' AND";

    if($carno) { //차량별 입차내역
        $sql = $sql." CAR_NO like '%$carno%' AND";
    }

    if($dong){
      $sql = $sql." (DRIVER_DEPT = '$dong' OR DRIVER_DEPT = '$dong2') AND";
    }
    if($ho){
      $sql = $sql." (DRIVER_CLASS = '$ho' OR DRIVER_CLASS = '$ho2') AND";
    }
    // if($id){
    //   $sql = $sql." GUESTREG_ID = '$id' AND";
    // }
    $sql = substr($sql, 0, -3); //마지막 3문자 제거("AND" 삭제함)
    //$sql = $sql." GROUP BY DRIVER_DEPT, DRIVER_CLASS ORDER BY INCOUNT DESC";
    // $sql = $sql." ORDER BY REG_DATE";
    // $sql = $sql." ORDER BY PARKTIME DESC";
    //$sql = $sql." ORDER BY DRIVER_DEPT, DRIVER_CLASS";
    $sql = $sql." ORDER BY IN_TIME";

?>
