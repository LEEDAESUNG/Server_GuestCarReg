<?php

    // if(isset($_GET['totalCnt'])) {
    //   $totalCnt = $_GET['totalCnt'];
    // }
    // else {
    //   $totalCnt = "0";
    // }
    // if(isset($_GET['dataSize'])) {
    //   $dataSize = $_GET['dataSize'];
    // }
    // else {
    //   $dataSize = "0";
    // }
    // if(isset($_GET['pageSize'])) {
    //   $pageSize = $_GET['pageSize'];
    // }
    // else {
    //   $pageSize = "0";
    // }

    include "getGuestRegRecordCount.php";


    $return_arr = array();
    $return_arr[] = array("result" => "1",
                    "totalCnt" => $totalCnt,
                    "dataSize" => $dataSize,
                    "pageSize" => $pageSize);

    echo json_encode($return_arr);
?>
