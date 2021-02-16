<!DOCTYPE html>
<?php
  //페이징 정의
  $page=1;       //현재페이지
  $totalCnt = 0; //전체레코드수
  $dataSize = 10; // 페이지당 보여줄 데이타수(필수 정의)
  $pageSize = 10;// 페이지 그룹 범위 1 2 3 5 6 7 8 9 10(필수 정의)
?>

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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/paging.js"></script>

<script>

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
        //dataSize = $("#dataSize").val();

        if(!totalCnt) totalCnt = 0;
        if(!dataSize) dataSize = 10;
        if(!pageSize) pageSize = 10;

        $.ajax({
            url: "index_dataload.php",
            type: 'GET',
            data: {
              page: page,              // 현재페이지
              dataSize: dataSize,      // 한 페이지에 보여지는 레코드
              carno:$("#carno").val(), // 차량번호
            },
            success: function(results) {
              // $("#listviewtree").ajaxComplete(function(event, request, settings)
              // { 
                  console.log("ajax PagingView success");
                  $("#listdata").html(results);
              //});
            },
            error: function(jqXHR, textStatus, errorThrown) {
                  console.log("ajax error : " + textStatus + "\n" + errorThrown);
									alert('3 정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E999)');
							}
        });

        var page_viewList = Paging(page, totalCnt, dataSize, pageSize, "PagingView");
        //$("#listview").empty().html(page_viewList);

        // paging
        var elem = document.getElementById("listpage");
        elem.innerHTML = page_viewList;
        //console.log(elem);
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
        include "getParkPoint.php";
        ?>







    <!-- <div> -->
        <form action="test.php" method="get">
            <div>
                <input type="text" name="carno" id="carno" placeholder="차량번호 4자리 입력" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='차량번호 4자리 입력';"> <button type="submit">방문예약 차량검색</button>
                <!-- <input type="hidden" id="dataSize" value="10"> -->
            </div>

            <div class="bg-light border-right" id="listpage"> </div>
            <div class="bg-light border-right" id="listdata"> </div>
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

  <script>
      $.urlParam = function(name) {
         var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
         if (results==null){
             return null;
          }
          else{
             return results[1] || 0;
          }
      }
      $(document).ready(function() {
          var page = $.urlParam('page');
          if(!page) {
              page = 1;
          }
          var carno = $.urlParam('carno');
          if( carno ) {
              var carno = decodeURI($.urlParam('carno')) //한글처리
              $('#carno').val(carno);
          }
          var totalCnt=10;
          var dataSize=10;
          var pageSize=10;

          $.ajax({
               type: "GET",
               url: "getJsonGuestRegRecordCount.php",
               data: {
                 totalCnt: totalCnt,              //현재페이지
                 dataSize: dataSize,
                 pageSize: pageSize,
                },
               dataType: "json",
               async: false,
               success: function (response) {
                      if(response[0].result == "1") {
                          totalCnt = response[0].totalCnt;
                          dataSize = response[0].dataSize;
                          pageSize = response[0].pageSize;
                      }
                      else {
                          alert('일시적인 오류발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E998)');
                      }
    							},
    					 error: function(jqXHR, textStatus, errorThrown) {
    									alert("ajax error : " + textStatus + "\n" + errorThrown);
    									alert('1 정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E999)');
    							}
           });

           goPaging_PagingView(page,totalCnt,dataSize,pageSize);
      });
  </script>
</body>

</html>
