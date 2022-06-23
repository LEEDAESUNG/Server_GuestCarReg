<?php

    extract($_POST);

    if (isset($_POST)) {
    $name = $_POST['name'];
    $dong = $_POST['dong'];
    $ho = $_POST['ho'];
    $id = $_POST['id'];
    $password = $_POST['password'];
    $carno = $_POST['carno'];
    $mobileno = $_POST['mobileno'];

    //앞자리 0 제거
    $dong = intval($dong, 10);
    $ho = intval($ho, 10);

		//$conn=mysqli_connect("localhost", "admin", "jawootek", "jwt_sanps");
    include "dbinfo.inc";
		if (!$conn) {
      echo json_encode(array('result' => '-1'));
			exit;
		}

    else {
        try {
          $maxparkcount = 1; //누적주차횟수(월)
          $maxparktime = 1; //누적주차시간(월)
          $maxparkday = 1; //차량별주차일수

          $sql = "select * from tb_config where NAME = 'GuestCarReg_MaxParkCount' or NAME = 'GuestCarReg_MaxParkDay' or NAME = 'GuestCarReg_MaxParkTime' ";
          $result=mysqli_query($conn, $sql);
          while($row = mysqli_fetch_array($result))
          {
              if($row['Name'] == 'GuestCarReg_MaxParkCount'){
                  $maxparkcount = $row['Content']; //누적주차횟수(월)
              }
              elseif($row['Name'] == 'GuestCarReg_MaxParkDay'){
                  $maxparkday = $row['Content'];   //차량별주차일수
              }
              elseif($row['Name'] == 'GuestCarReg_MaxParkTime'){
                  $maxparktime = $row['Content'];  //누적주차시간(월)
              }
          }


            $dt = date("Y-m-d H:i:s");

            $sql = "SELECT * FROM tb_guestreg_admin WHERE ID = '$id' ";
            $result=mysqli_query($conn, $sql);
            $num_match=mysqli_num_rows($result);
            if($num_match) {
                $row = mysqli_fetch_array($result);
                if($row['USE_YN'] == 'Y'){
                    //승인완료
                    echo json_encode(array('result' => '-3', 'message' => '해당 아이디는 [승인완료]상태입니다. 방문예약시스템을 즉시 이용할 수 있습니다. 자세한 문의사항은 관리실로 문의바랍니다'));
                }
                else {
                    //승인대기
                    echo json_encode(array('result' => '-2', 'message' => '해당 아이디는 [승인대기]상태입니다. 승인요청은 관리실로 문의바랍니다'));
                }
            }
            else {

              $sql = "INSERT INTO tb_guestreg_admin (VENDOR,SITE,NAME,ID,PASSWORD,CARNO,TEL,DRIVER_DEPT,DRIVER_CLASS,MAXPARKDAY,MAXPARKTIME,MAXPARKCOUNT,USE_YN, REG_DATE) VALUES (0,0,'$name','$id','$password','$carno','$mobileno','$dong','$ho',$maxparkday,$maxparktime,$maxparkcount,'N','$dt') ";
              $result = mysqli_query($conn, $sql);

              $log = '[가입][승인대기]아이디:'.$id.',동:'.$dong.',호:'.$ho.',차량번호:'.$carno;
              $sql = "INSERT INTO tb_log (TICKET_CODE,PROC_CODE,PROC_INFO,ACCOUNT_NAME,ACCOUNT_MONEY,REG_DATE) VALUES ('방문예약','WEB','$log','',0,'$dt') ";
              $result=mysqli_query($conn, $sql);

              echo json_encode(array('result' => '2', 'message'=>'가입신청 완료했습니다. 관리실로 [방문예약] 승인요청 하세요')); //승인대기
            }

            mysqli_close($conn);
      			exit;

        }
        catch(Exception $e) {
            echo json_encode(array('result' => '-99'));
        }
    }
  }

?>
