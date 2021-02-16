<?php


  session_start();
  if( !isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho']) ) {
      echo json_encode(array('result' => '-5'));
  }


  extract($_POST);

  if (isset($_POST)) {

      $loginID = $_SESSION['ss_loginID'];
      $nowPW = $_POST['nowPassword'];
      $newPW = $_POST['newPassword'];

      try {
          include "dbinfo.inc";
      		if (!$conn)
          {
            mysqli_close($conn);
            echo json_encode(array('result' => '-1'));
      			//exit();
      		}
          $sql = "SELECT * FROM tb_guestReg_admin WHERE ID = '$loginID' ";
      		$result=mysqli_query($conn, $sql);
          $total_rows = mysqli_num_rows($result);
          if($row = mysqli_fetch_array($result))
          {
              $db_password = $row['PASSWORD'];

              if(strcmp($nowPW,$db_password)==0  )
              {
                   $sql = "UPDATE tb_guestReg_admin SET PASSWORD = '$newPW' WHERE ID = '$loginID' ";
                   $result=mysqli_query($conn, $sql);
                   mysqli_close($conn);
                   echo json_encode(array('result' => '1'));
              }
              else
              {
                  mysqli_close($conn);
                  echo json_encode(array('result' => '0'));
              }
          }
          else{
              echo json_encode(array('result' => '-2'));
          }
      }
      catch(Exception $e) {
          echo json_encode(array('result' => '-3'));
      }
  }
  else {
    echo json_encode(array('result' => '-4'));
  }
 ?>
