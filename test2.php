<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>방문차량 예약 시스템</title>
  <link rel="icon" type="image/png" href="images/icons/Parking_Red.ico"/>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="js/paging.js"></script>
<script language  ="javascript">

    $.urlParam = function(name) {
    	 var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
       if (results==null){
           return null;
        }
        else{
           return results[1] || 0;
        }
    }
    function loading_show()
    {
        $('#loading').html("<img src='images/loading.gif' />").fadeIn('fast');
    }
    function loading_hide()
    {
        $('#loading').fadeOut();
    }
    function goPaging_PagingView(page, totalCnt, dataSize, pageSize)
    {
        dataSize = $("#dataSize").val();

        if(!totalCnt) totalCnt = 100;
        if(!dataSize) dataSize = 10;
        if(!pageSize) pageSize = 10;

        var page_viewList = Paging(page, totalCnt, dataSize, pageSize, "PagingView");
        //$("#listview").empty().html(page_viewList);

        // paging
        var elem = document.getElementById("listpage");
        elem.innerHTML = page_viewList;

        // // data
        // // var element = document.getElementById("id_range");
        // // element.innerHTML = "id_range";
        // var page = $.urlParam('page');
        // if(!page) {
        //     page = 1;
        // }
        // var carno = $.urlParam('carno');
        // if( carno ) {
        //     var carno = decodeURI($.urlParam('carno')) //한글처리
        // }
        // var sdate = $.urlParam('sdate');
        // var edate = $.urlParam('edate');

console.log(page);

        $.ajax({
            url: "index_dataload.php",
            type: 'GET',
            data: {
              page: page, //현재페이지
              dataSize:dataSize, //페이지당 레코드 수
              carno:$("#carno").val(),
            },
            // sdate:$("#sdate").val(),
            // edate:$("#edate").val(),
            success: function(results) {
              // $("#listviewtree").ajaxComplete(function(event, request, settings)
              // {
                  console.log("ajaxComplete success");
                  $("#listdata").html(results);
              //});
            },
            error: function(jqXHR, textStatus, errorThrown) {
									//alert("ajax error : " + textStatus + "\n" + errorThrown);
                  console.log("ajax error : " + textStatus + "\n" + errorThrown);
									alert('정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E999)');
							}
        });

        console.log(totalCnt);
        console.log(elem);
     };


</script>


</head>



  <?php
    session_start();
    if( !isset($_SESSION['ss_dong']) || !isset($_SESSION['ss_ho']) ) {
        echo "<p>로그인을 해 주세요. <a href=\"login.php\">[로그인]</a></p>";
        echo("<script>location.href='login.php';</script>");
        exit();
    } else {
        //$username = $_SESSION['username'];
        //$userpass = $_SESSION['userpass'];
        //echo "<p><strong>$_SESSION['username'].</strong>님 환영합니다.";
        //echo "<a href=\"logout.php\">[로그아웃]</a></p>";
    }
  ?>

  <body>
    <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand mb-0 h1" href = "/guestcarreg.php" >
      <img src="/images/icons/Parking_Red.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      사전방문예약
    </a>
    </nav>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <!-- <div class="sidebar-heading">  </div> -->
      <div class="list-group list-group-flush">
        <a href="/guestcarreg.php" class="list-group-item list-group-item-action bg-light"><img src="/images/icons/raewmian.jpg" align = 'center' width = 200></a>
        <a href="/guestcarreg.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-plus"></span>&nbsp;&nbsp;&nbsp;방문예약등록</a>
        <a href="/index.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-note"></span>&nbsp;&nbsp;&nbsp;방문예약내역</a>
        <a href="/changepw.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-locked"></span>&nbsp;&nbsp;&nbsp;비밀번호변경</a>
        <a href="/logout.php" class="list-group-item list-group-item-action bg-light"><span class="ui-icon ui-icon-extlink"></span>&nbsp;&nbsp;&nbsp;로그아웃</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">메뉴</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      </nav>

      <div class="container-fluid">

        <?php
        //include "getParkPoint.php";
        ?>







    <!-- <div> -->
        <form action="index.php" method="get">
            <!-- <div>
                <input type="text" name="carno" placeholder="차량번호 4자리 입력" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='차량번호 4자리 입력';"> <button type="submit">방문예약 차량검색</button>
                <input type="hidden" id="dataSize" value="10">
            </div> -->

            <div>
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

                    <!-- paging 테스트 -->
                    <?php
                      $totalCnt = 0; //전체레코드수
                      $dataSize = 0; // 페이지당 보여줄 데이타수
                      $pageSize = 10;// 페이지 그룹 범위 1 2 3 5 6 7 8 9 10
                      ?>

                    <tbody>
                      <?php
                      // if(isset($_GET['dataSize'])) {
                      //   $dataSize = $_GET['dataSize'];
                      // }
                      // else {
                      //   $dataSize = "10";
                      // }
                      // if(isset($_GET['pageno'])) {
                      //   $page = $_GET['pageno'];
                      // }
                      // else {
                      //   $page = "1";
                      // }

                      if(isset($_GET['carno'])) {
                        //$carno = $_GET['carno'];
                        $carno = preg_replace("/\s+/", "", $_GET['carno']);
                      }
                      else {
                        $carno = "";
                      }

                      if(isset($_GET['sdate'])) {
                        $startDate = $_GET['sdate'];
                        $startDate = $startDate." 00:00:00";
                      }
                      else {
                        $startDate = "";
                      }
                      if(isset($_GET['edate'])) {
                        $endDate = $_GET['edate'];
                        $endDate = $endDate." 23:59:59";
                      }
                      else {
                        $endDate = "";
                      }

                      include "dbinfo.inc";
                      $dong = $_SESSION['ss_dong'];
                      $ho = $_SESSION['ss_ho'];

                      $dt = date("Y-m-d").' 00:00:00'; //오늘날짜

                      if(strlen($carno) == 4 ) {
                        if(strlen($startDate) > 0 && strlen($endDate) > 0) {
                          $sql = "select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate' AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
                        }
                        else {
                          $sql = "select * from tb_guestReg where CAR_NO like '%$carno%' AND DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
                        }
                      }
                      else {
                          if(strlen($startDate) > 0 && strlen($endDate)>0) {
                            $sql = "select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약' AND '$startDate' <= START_DATE AND END_DATE<='$endDate'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
                          }
                          else {
                            $sql = "select * from tb_guestReg where DRIVER_DEPT = '$dong' and DRIVER_CLASS = '$ho' AND CAR_GUBUN = '방문예약'  AND END_DATE>'$dt' ORDER BY REG_DATE DESC ";
                          }
                      }
echo $sql;
exit;

$sql="select * from tb_guestReg";
                      $result=mysqli_query($conn, $sql);
                      $total_rows = mysqli_num_rows($result);
$totalCnt = $total_rows;
?>

<!--
<div class="bg-light border-right" id="listpage">
</div>
<div class="bg-light border-right" id="listdata">
</div> -->
<?php
//echo ("<script language=javascript> goPaging_PagingView($page,$totalCnt,$dataSize,$pageSize)</script>");
?>



<?php
$startIndex = 0 + ($page-1)*$dataSize;
$sql="select * from tb_guestReg order by end_date desc limit $startIndex, $dataSize";

$result=mysqli_query($conn, $sql);
$total_rows = mysqli_num_rows($result);
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
                      ?>

                      <tr>
                          <th>
                              <?php echo $db_seq ?>
                          </th>
                          <th>
                              <?php echo $db_carno ?>
                          </th>
                          <th>
                              <?php echo $db_drivername ?>
                          </th>
                          <th>
                              <?php echo $db_phone ?>
                          </th>
                          <th>
                              <?php echo $db_startdate ?> ~ <?php echo $db_enddate ?>
                          </th>
                          <th>
                              <?php echo $db_regdate ?>
                          </th>
                          <th>
                              <?php
                              if( $db_pass_yn == 'N')
                              {
                                ?>
                              <a href="/delete.php?no=<?php echo $db_seq ?>&guestCarno=<?php echo $db_carno ?>&guestName=<?php echo $db_drivername ?>&sdate=<?php echo $db_startdate ?>" role = "button" OnClick="return confirm('정말 삭제하시겠습니까?')">삭제가능</a>
                              <?php
                              }
                              else
                              {
                                //echo "주차상태";
                                echo "입차완료";
                              }
                              ?>
                          </th>
                      </tr>

                      <?php
                      }
                         mysqli_close($conn);
                      ?>

                    </tbody>
        		</table>
            </div>


<!--
            <div>
              <tr>
                <td>
                  <input type="date" name="sdate" id='currentSDate'>
                  ~ <input type="date" name="edate" id='currentEDate' value="2000-01-01"> <button type="submit">방문예약 조회</button>
                </td>
                <td>
                   [레코드 건수: <?php echo $total_rows; ?> ]
                </td>
              </tr>
            </div>

        <script>
          document.getElementById('currentSDate').valueAsDate = new Date();
          document.getElementById('currentEDate').valueAsDate = new Date();
        </script>
-->
      </form>
	  </div>







  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>


  <!-- <script>
//   $(document).ready(function() {
//     //전체레코드수, 페이지당 보여줄 데이타수,페이지 그룹 범위 1 2 3 5 6 7 8 9 10, 현재페이지,token
//     var pageno = $('#pageno').val();
//     var totalCnt = $('#totalCnt').val();
//     var dataSize = $('#dataSize').val();
//     var pageSize = $('#pageSize').val();
//     var token = "PagingView";
// //alert(totalCnt);
//
//     var page_viewList = Paging(totalCnt, dataSize, pageSize, pageno, token);
//     $("#listview").empty().html(page_viewList);
//   });


//   function goPaging_PagingView(cPage, totalCnt, dataSize, pageSize)
//   {
//   //var goPaging_PagingView = function(totalCnt, dataSize, pageSize , cPage){
//       // 게시물을 가져오는 함수에 cPage값을 보내서 사용하세요.cPage는 현재 사용자가 클릭한 페이지값을 의미합니다.
// console.log(totalCnt);
//       // var totalCnt = $('#totalCnt').val();
//       // var dataSize = $('#dataSize').val();
//       // var pageSize = $('#pageSize').val();
//
//       var page_viewList = Paging(cPage, totalCnt, dataSize, pageSize , "PagingView");
//       $("#listview").empty().html(page_viewList);
//   };

  // goPaging_PagingView(1);

  // $('#save').click(function(e) {
  //       e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다
  //
  //       $.ajax({
  //          type: "GET",
  //          url: "guestcarregListview.php",
  //          data: {
  //             pageno:$("#pageno").val(),
  //           },
  //          dataType: "json",
  //          success: function (response) {
	// 								if(response.result == 1){
	// 										alert('처리완료 했습니다.');
  //                   }
  //                 else {
	// 										alert('저장도중 에러발생했습니다. 잠시후 재시도하세요(SV_E001)');
  //                     alert(response.result);
	// 								}
	// 						},
	// 						error: function(jqXHR, textStatus, errorThrown) {
	// 								//alert("ajax error : " + textStatus + "\n" + errorThrown);
	// 								alert('정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E999)');
	// 						}
  //      });
  //  });
  </script>
-->
</body>

</html>
