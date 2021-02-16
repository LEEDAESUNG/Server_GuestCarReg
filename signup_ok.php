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
          $nowparkcount = 0; //1일~현재까지 주차횟수(월)
          $nowparktime = 0; //1일~현재까지 주차시간(월)

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
        		if(!$num_match) {

                $sql2 = "SELECT * FROM tb_reg WHERE CAR_NO = '$carno' AND DRIVER_DEPT = '$dong' AND DRIVER_CLASS = '$ho' ";
                $result2=mysqli_query($conn, $sql2);
                if($row2 = mysqli_fetch_array($result2)) //정기권등록 차량번호 경우 즉시 사용
                {
                    $sql = "INSERT INTO tb_guestreg_admin (VENDOR,SITE,NAME,ID,PASSWORD,CARNO,TEL,DRIVER_DEPT,DRIVER_CLASS,MAXPARKDAY,MAXPARKTIME,MAXPARKCOUNT,NOWPARKTIME,NOWPARKCOUNT,USE_YN,REG_DATE) VALUES (0,0,'$name','$id','$password','$carno','$mobileno','$dong','$ho',$maxparkday,$maxparktime,$maxparkcount,$nowparktime,$nowparkcount,'Y','$dt') ";
                    $result = mysqli_query($conn, $sql);
                    echo json_encode(array('result' => '1')); //정상
                }
                else{
                    $sql = "INSERT INTO tb_guestreg_admin (VENDOR,SITE,NAME,ID,PASSWORD,CARNO,TEL,DRIVER_DEPT,DRIVER_CLASS,MAXPARKDAY,MAXPARKTIME,MAXPARKCOUNT,NOWPARKTIME,NOWPARKCOUNT,USE_YN, REG_DATE) VALUES (0,0,'$name','$id','$password','$carno','$mobileno','$dong','$ho',$maxparkday,$maxparktime,$maxparkcount,$nowparktime,$nowparkcount,'N','$dt') ";
                    $result = mysqli_query($conn, $sql);
                    echo json_encode(array('result' => '2')); //승인대기
                }



                mysqli_close($conn);
          			exit;
            }
            else {
              mysqli_close($conn);
              echo json_encode(array('result' => '0')); //동일한 ID 있음
              exit;
            }
        }
        catch(Exception $e) {
            echo json_encode(array('result' => '-2'));
        }
    }
  }

?>
