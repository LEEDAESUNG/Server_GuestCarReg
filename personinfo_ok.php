<?php

    extract($_POST);

    if (isset($_POST)) {
        $name = $_POST['name'];
        // $dong = $_POST['dong'];
        // $ho = $_POST['ho'];
        $id = $_POST['id'];
        $password = $_POST['password'];
        $carno = $_POST['carno'];
        $mobileno = $_POST['mobileno'];

        include "dbinfo.inc";
    		if (!$conn) {
          echo json_encode(array('result' => '-1'));
    			exit;
    		}
        else
        {
            try
            {
                $sql = "SELECT * FROM tb_guestreg_admin WHERE ID = '$id' ";
            		$result=mysqli_query($conn, $sql);
            		$num_match=mysqli_num_rows($result);
            		if(!$num_match) {
                //     $dt = date("Y-m-d H:i:s");
                //     $sql = "INSERT INTO tb_guestreg_admin (VENDOR, SITE, NAME, ID, PASSWORD, CARNO, TEL, DRIVER_DEPT, DRIVER_CLASS, MAXPARKTIME, MAXPARKCOUNT,NOWPARKCOUNT,USE_YN, REG_DATE) VALUES (0,0,'$name','$id','$password','$carno','$mobileno','$dong','$ho',0,0,0,'N','$dt') ";
                //     $result = mysqli_query($conn, $sql);
                //     mysqli_close($conn);
                //     echo json_encode(array('result' => '1')); //정상
              	// 		exit;
                // }
                    echo json_encode(array('result' => '2'));  // 승인 대기
                    mysqli_close($conn);
                		exit;
                }
                else {
                    // mysqli_close($conn);
                    // echo json_encode(array('result' => '0')); //동일한 ID 있음
                    // exit;


                    $dong = "";
                    $ho = "";
                    if($row = mysqli_fetch_array($result))
                    {
                      $dong = $row['DRIVER_DEPT'];
                      $ho = $row['DRIVER_CLASS'];
                    }

                    $sql = "SELECT * FROM tb_reg WHERE CAR_NO = '$carno' AND DRIVER_DEPT = '$dong' AND DRIVER_CLASS = '$ho' ";
                    $result=mysqli_query($conn, $sql);
                    $total_rows = mysqli_num_rows($result);
                    if($total_rows) {
                        $dt = date("Y-m-d H:i:s");
                        $sql = "UPDATE tb_guestreg_admin SET NAME='$name', PASSWORD='$password', CARNO='$carno', TEL='$mobileno', USE_YN='Y', REG_DATE='$dt' WHERE ID = '$id' "; //사용가능
                        $result = mysqli_query($conn, $sql);

                        echo json_encode(array('result' => '1')); //정상
                    }
                    else {
                      $dt = date("Y-m-d H:i:s");
                      $sql = "UPDATE tb_guestreg_admin SET NAME='$name', PASSWORD='$password', CARNO='$carno', TEL='$mobileno', USE_YN='N', REG_DATE='$dt' WHERE ID = '$id' "; //관리실 승인대기
                      $result = mysqli_query($conn, $sql);

                      echo json_encode(array('result' => '2'));  // 승인 대기
                    }

                    mysqli_close($conn);
                		exit;
                }
            }
            catch(Exception $e) {
                echo json_encode(array('result' => '-2'));
            }
        }
    }

?>
