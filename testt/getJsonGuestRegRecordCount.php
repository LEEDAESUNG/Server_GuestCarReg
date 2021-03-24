<?php

    include "getGuestRegRecordCount.php";


    $return_arr = array();
    $return_arr[] = array("result" => "1",
                    "totalCnt" => $totalCnt,
                    "dataSize" => $dataSize,
                    "pageSize" => $pageSize);

    echo json_encode($return_arr);
?>
