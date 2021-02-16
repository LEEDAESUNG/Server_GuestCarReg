
<?php
              // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              // // 사전방문예약 남은건수/최대주차가능건수 표시
              // include "dbinfo.inc";
              // $loginID = $_SESSION['ss_loginID'];
              // $ParkCount = 0; // 사전방문 최대등록수(월) - default
              // $UseCount = 0; // 등록건수(월)
              // $ParkTime = 0; // 주차시간
              // $UseTime = 0; // 주차시간
              // $sql = "SELECT * FROM tb_guestreg_admin WHERE ID = '$loginID' ";
              // $result=mysqli_query($conn, $sql);
          		// $num_match=mysqli_num_rows($result);
          		// if(!$num_match) {
              //   mysqli_close($conn);
              //
          		// 	echo("
          		// 		<script> window.alert('아이디 정보가 만료됐습니다. 다시 로그인해주세요(L000002)')
          		// 		window.location.replace('logout.php');
          		// 		</script>
          		// 	");
              //   exit();
              //
          		// } else {
          		// 	$row = mysqli_fetch_array($result);
              //   $ParkTime = $row['MAXPARKTIME']; // 사전방문 최대등록가능건수(월)
              //   $UseTime = $row['NOWPARKTIME']; // 사전방문 등록건수(월)
              //   $ParkCount = $row['MAXPARKCOUNT']; // 사전방문 최대등록가능건수(월)
              //   $UseCount = $row['NOWPARKCOUNT']; // 사전방문 등록건수(월)
              // }
              // mysqli_close($conn);
              // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

                // 방법1) 가장 정확하지만 다중 접속시 시간지연 발생소지
                // $startDT = date("Y-m").'-01 00:00:00'; //매달 1일
                // $sql = "select sum(PARKTIME) as PARKTIME from tb_guestReg_daily where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND REG_DATE>'$startDT' GROUP BY DRIVER_DEPT,DRIVER_CLASS ";
                // $result=mysqli_query($conn, $sql);
                // $total_rows = mysqli_num_rows($result);
                // if($row = mysqli_fetch_array($result))
                // {
                //   $db_parktime = $row['PARKTIME']; //주차시간
                // }

                //방법2)
                // $startDT = date("Y-m").'-01 00:00:00'; //매달 1일
                // $sql = "select sum(NOWPARKTIME) as PARKTIME from tb_guestreg_admin where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' GROUP BY DRIVER_DEPT,DRIVER_CLASS ";
                // $result=mysqli_query($conn, $sql);
                // $total_rows = mysqli_num_rows($result);
                // if($row = mysqli_fetch_array($result))
                // {
                //   $db_parktime = $row['PARKTIME']; //주차시간
                // }


                //동호수별 최대 주치가능 시간
                //$sql = "select * from tb_guestReg_admin where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' ";
                //$sql = "select * from tb_guestReg_admin where ID = '$id' ";
                $sql = "select * from tb_guestReg_admin where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' ";
                $result=mysqli_query($conn, $sql);
                $total_rows = mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result))
                {
                  $db_maxparkcount = $row['MAXPARKCOUNT']; //최대 주차횟수(월)
                  $db_nowparkcount = $db_nowparkcount + $row['NOWPARKCOUNT']; //1일~현재까지 주차횟수(월)
                  $db_maxparktime = $row['MAXPARKTIME']; //주차시간
                  $db_nowparktime = $db_nowparktime + $row['NOWPARKTIME']; //1일~현재까지 주차시간(월)
                }
                $db_nowparktime = $db_nowparktime;

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
                    echo "</span>";
                    echo "<br>";
                }


?>
