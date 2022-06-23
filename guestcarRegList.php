
<?php
  function Console_log($data){
      echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
  }

  $output='
      <head>
           <tr>
               <th> 번호 </th>
               <th> 차량번호 </th>
               <th> 방문객명 </th>
               <th> 연락처 </th>
               <th> 방문예약일자 </th>
               <th> 등록일자 </th>
               <th> 상태 </th>
           </tr>
      </head> ';
              include "guestcarRegListSQL.php";
              include "dbinfo.inc";

              $result=mysqli_query($conn, $sql);
              $total_rows = mysqli_num_rows($result);
              if( $total_rows==0) {
              }
              else
              {
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

                        if($db_pass_yn == 'N'){
                            $output = $output.'<th>';
                           $output = $output.'<a href=/delete.php?no='.$db_seq.'&carno='.$searchCarno.'&sdate='.$searchStartDate.'&edate='.$searchEndDate.' role = button OnClick=return confirm("정말 삭제하시겠습니까?")>'.'삭제가능</a>';
                           $output = $output.'</th>';
                        }
                        else
                        {
                            $output = $output.'<th>'.'입차완료'.'</th>';
                        }
                        $output = $output.'</tr>';

                    }


                  mysqli_close($conn);
              }


              $output = '<table class="table table-striped"><tbody>'.$output.'</tbody></table>';
              echo $output;
?>
