
<?php
                //방문예약차량 주차시간 잔량
                include "dbinfo.inc";
                $id = $_SESSION['ss_loginID'];
                $dong = $_SESSION['ss_dong'];
                $ho = $_SESSION['ss_ho'];
                $db_nowparktime = 0;
                $db_maxparktime = 0;
                $db_maxparkcount = 0;
                $db_nowparkcount = 0;
                //$dt = date("Y-m-d").' 00:00:00'; //오늘날짜
                $thisMonth = date("Y-m").'-01 00:00:00';

                //동,호수 4자리로 변환
                $dong = (int)$dong;
                $dong2 = sprintf('%04d',$dong);
                $ho = (int)$ho;
                $ho2 = sprintf('%04d',$ho);


                //월 최대 등록횟수, 최대 주차시간 가져오기
                $sql = "select * from tb_guestreg_admin where ID='$id' ";
                $result=mysqli_query($conn, $sql);
                $total_rows = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result))
                {
                  $db_maxparkcount = $row['MAXPARKCOUNT']; //월 최대등록 횟수
                  $db_maxparktime = $row['MAXPARKTIME']; //월 최대주차 시간(출구LPR 필요함)
                }
                //mysqli_close($conn);


                //이번달 등록횟수 가져오기
                $sql = "select COUNT(*) AS regcount from tb_guestreg where GUESTREG_ID='$id' and REG_DATE >= '$thisMonth' ";
                $result=mysqli_query($conn, $sql);
                $total_rows = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result))
                {
                  $db_nowparkcount = $row['regcount'];
                }
                //mysqli_close($conn);


                //이번달 주차시간 가져오기
                $sql = "select * from tb_guestReg_parktime where (DRIVER_DEPT='$dong' or DRIVER_DEPT='$dong2') and (DRIVER_CLASS='$ho' or DRIVER_CLASS='$ho2') and REG_DATE >= '$thisMonth' ";
                $result=mysqli_query($conn, $sql);
                $total_rows = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result))
                {
                  $db_nowparktime = $db_nowparktime + $row['PARKTIME']; //1일~현재까지 주차시간(월)
                }
                mysqli_close($conn);


                if( $db_maxparktime >0) {
                    if( $db_maxparktime-$db_nowparktime>0) {
                      echo "<span style='color:orange; font-weight:bold; font-size:0.9em;'>주차시간 : ";
                    }
                    else {
                      echo "<span style='color:red; font-weight:bold; font-size:0.9em;'>주차시간 : ";
                    }
                    echo $db_nowparktime;
                    echo " / ";
                    echo $db_maxparktime;
                    echo " (분,매월)";
                    echo "</span>";
                    echo "<br>";

                    // echo "<span style='color:orange; font-weight:bold; font-size:0.9em;'>남은주차시간 : ";
                    // echo $db_maxparktime-$db_nowparktime;
                    // echo " (분)";
                    // //echo "* 주차시간 최근 날짜:업데이트됩니다";
                    // echo "</span>";
                    // echo "<br>";
                }

                if( $db_maxparkcount > 0) {
                    if( $db_maxparkcount-$db_nowparkcount>0) {
                      echo "<span style='color:orange; font-weight:bold; font-size:0.9em;'>신청횟수 : ";
                    }
                    else {
                      echo "<span style='color:red; font-weight:bold; font-size:0.9em;'>신청횟수 : ";
                    }
                    echo $db_nowparkcount;
                    echo " / ";
                    echo $db_maxparkcount;
                    echo " (회,매월)";
                    if( $db_maxparkcount<$db_nowparkcount) {
                      echo "<span style='color:red; font-weight:bold; font-size:0.9em;'> - 월 이용횟수를 초과했습니다 ";
                    }
                    echo "</span>";
                    echo "<br>";
                }


?>
