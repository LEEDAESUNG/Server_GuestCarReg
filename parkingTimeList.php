
<?php
  function Console_log($data){
      echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
  }
  $output='
      <head>
           <tr>

               <th> 차량번호 </th>
               <th> 주차일시 </th>
               <th> 주차시간(분) </th>
           </tr>
      </head> ';

              include "parkingTimeListSQL.php";

              include "dbinfo.inc";
              $total_parktime = 0;

              $result=mysqli_query($conn, $sql);
              $total_rows = mysqli_num_rows($result);
              if( $total_rows==0) {
              }
              else
              {
                  while($row = mysqli_fetch_array($result))
                  {
                        $db_carno = $row['CAR_NO'];
                        // $db_dong = $row['DRIVER_DEPT']; // 텍스트박스 입력값
                        // $db_ho = $row['DRIVER_CLASS'];     // 텍스트박스 입력값
                        $db_start = substr($row['IN_TIME'], 0, 16);     // 텍스트박스 입력값
                        $db_end = substr($row['OUT_TIME'], 0, 16);     // 텍스트박스 입력값
                        $parktime =(int)(strtotime($db_end)-strtotime($db_start))/60;
                        $total_parktime = $total_parktime + $parktime;

                        $output = $output.'<tr>';
                        // $output = $output.'<th>'.$db_dong.'</th>';
                        // $output = $output.'<th>'.$db_ho.'</th>';
                        $output = $output.'<th>'.$db_carno.'</th>';
                        $output = $output.'<th>'.$db_start.' ~ '.$db_end.'</th>';
                        $output = $output.'<th>'.$parktime.'</th>';
                        $output = $output.'</tr>';
                  }

                  mysqli_close($conn);
              }

              //echo '<table class="table table-striped"><tbody> 전체:'.$total_parktime.'(분)</tbody></table>';

              $output = '<table class="table table-striped"><tbody>'.$output.'</tbody></table>';
              echo $output;
