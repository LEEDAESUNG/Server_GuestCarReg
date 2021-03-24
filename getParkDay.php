
<?php
              ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              // 사전방문예약차량 최대주차일수 가져오기
              include "dbinfo.inc";

              $id = $_SESSION['ss_loginID'];
              $dong = $_SESSION['ss_dong'];
              $ho = $_SESSION['ss_ho'];

              $ParkCount = 5; // 사전방문 최대등록수(월) - default
              $ParkDay = 3; // 사전방문 최대주차일수() - default
              $sql = "select Content from tb_config where Name = 'GuestCarReg_MaxParkDay' ";
              $result=mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($result))
              {
                  //$db_maxparkday = $row['MAXPARKDAY']; //최대 주차횟수(월)
                  $db_maxparkday = $row['Content']; //최대 주차횟수(월)
              }
              mysqli_close($conn);
              ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
