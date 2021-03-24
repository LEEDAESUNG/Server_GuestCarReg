<?php
  function Console_log($data){
      echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
  }

    $output = '';
    $output = $output.'
              <table class="table table-striped">
                  <head>
                      <tr>
                          <th>번호</th>
                          <th>차량번호</th>
                          <th>방문객명</th>
                          <th>연락처</th>
                          <th>방문예약일자</th>
                          <th>등록일자</th>
                          <th>상태</th>
                      </tr>
                  </head>
                  <tbody>
              ';

          include "getGuestRegRecordCount.php";

          // if(isset($_GET['carno'])) {
          //   $carno = preg_replace("/\s+/", "", $_GET['carno']);
          // }
          // else {
          //   $carno = "";
          // }
          // if(isset($_GET['page'])) {
          //   $page = $_GET['page'];
          // }
          // else {
          //   $page = "1";
          // }
          //
          // if(isset($_GET['sdate'])) {
          //   $startDate = $_GET['sdate'];
          //   $startDate = $startDate." 00:00:00";
          // }
          // else {
          //   $startDate = "";
          // }
          // if(isset($_GET['edate'])) {
          //   $endDate = $_GET['edate'];
          //   $endDate = $endDate." 23:59:59";
          // }
          // else {
          //   $endDate = "";
          // }
          //
          // include "dbinfo.inc";
          // session_start();
          // $dong = $_SESSION['ss_dong'];
          // $ho = $_SESSION['ss_ho'];
          //
          // $dt = date("Y-m-d").' 00:00:00'; //오늘날짜
          //
          // if(strlen($carno) == 4 ) {
          //   if(strlen($startDate) > 0 && strlen($endDate) > 0) {
          //     $sql = " select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate' AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
          //   }
          //   else {
          //     $sql = " select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
          //   }
          // }
          // else {
          //     if(strlen($startDate) > 0 && strlen($endDate)>0) {
          //       $sql = " select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
          //     }
          //     else {
          //       $sql = " select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
          //     }
          // }

          $startIndex = $page*$dataSize-$dataSize;
          if($startIndex<0) $startIndex=0;
          $sql=$sql." limit $startIndex, $dataSize";


          include "dbinfo.inc";
          //$sql="select * from tb_guestReg order by seq limit $startIndex, $dataSize";
          $result=mysqli_query($conn, $sql);
          $total_rows = mysqli_num_rows($result);

echo "carno:".$carno.", page:".$page.", dataSize:".$dataSize.", total_rows:".$total_rows;
echo $sql;

          while($row = mysqli_fetch_array($result))
          {
            $db_seq = $row['SEQ'];
            $db_carno = $row['CAR_NO'];
            $db_drivername = $row['DRIVER_NAME'];
            $db_phone = $row['DRIVER_PHONE'];
            $db_startdate = $row['START_DATE'];   $db_startdate = substr($db_startdate, 0, 10);
            $db_enddate = $row['END_DATE'];       $db_enddate = substr($db_enddate, 0, 10);
            $db_regdate = $row['REG_DATE'];       $db_regdate = substr($db_regdate, 0, 10);
            $db_pass_yn = $row['PASS_YN'];

            $output = $output.'<tr>';
            $output = $output.'<th>'.$db_seq.'</th>';
            $output = $output.'<th>'.$db_carno.'</th>';
            $output = $output.'<th>'.$db_drivername.'</th>';
            $output = $output.'<th>'.$db_phone.'</th>';
            $output = $output.'<th>'.$db_startdate.'~'.$db_enddate.'</th>';
            $output = $output.'<th>'.$db_regdate.'</th>';
            $output = $output.'<th>';
              if( $db_pass_yn == 'N')
                $output = $output.'<a href="/delete.php?no='.$db_seq.'&guestCarno='.$db_carno.'&guestName='.$db_drivername.'&sdate='.$db_startdate.' role = "button" OnClick="return confirm'.'("정말 삭제하시겠습니까?"'.')">삭제가능</a>';
              else
                $output = $output.'입차완료';
            $output = $output.'</th></tr>';

          }
          mysqli_close($conn);

          $output = $output.'</tbody>></table>';
          echo $output;
