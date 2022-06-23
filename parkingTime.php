<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!--<title> 방문차량 예약 시스템(관리자용) </title>-->
  <title>방문예약시스템(입주민용)</title>
  <link rel="icon" type="image/png" href="images/icons/Parking_Red.ico"/>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">




</head>

<body>
  <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand mb-0 h1" href = "/guestcarreg.php" >
    <div style="color:black; font-weight:bold; font-size:1.0em;">
      <img src="/images/icons/Parking_Red.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      방문예약시스템</div>
  </a>
  </nav>

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

  <div class="d-flex" id="wrapper">

    <?php include "Leftmenu.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">메뉴</button>

&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn btn-info" value="출차차량내역">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      </nav>

      <div class="container-fluid">









    <div>
        <table>

            <div>
              <tr>
                  <th>
                    <input type="text" name="carno" id="carno" placeholder="차량번호 4자리(숫자)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='차량번호 4자리(숫자)';">&nbsp;&nbsp;
                    입차일자:
                    <input type="text" name="sdate" id="GuestInDate" placeholder="입차 시작날자">~
                    <input type="text" name="edate" id="GuestOutDate" placeholder="입차 종료날자"/>
                    <button type="submit" id="search">검색</button>
                  </th>
              </tr>
            </div>

            <div>

              <table class="table table-striped">
                  <div class="bg-light border-right" id="carregListdata"> </div>
              </tabke>
            </div>
      </tavle>
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



  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script charset='euc-kr'>
  function fn_calcDayMonthCount(pStartDate, pEndDate, pType) {
      var strSDT = new Date(pStartDate.substring(0,4),pStartDate.substring(4,6)-1,pStartDate.substring(6,8));
      var strEDT = new Date(pEndDate.substring(0,4),pEndDate.substring(4,6)-1,pEndDate.substring(6,8));
      var strTermCnt = 0;

      if(pType == 'D') {  //일수 차이
          strTermCnt = (strEDT.getTime()-strSDT.getTime())/(1000*60*60*24);
      } else {            //개월수 차이
          //년도가 같으면 단순히 월을 마이너스 한다.
          // => 20200301-20200201 의 경우(윤달이 있는 경우) 아래 else의 로직으로는 정상적인 1이 리턴되지 않는다.
          if(pEndDate.substring(0,4) == pStartDate.substring(0,4)) {
              strTermCnt = pEndDate.substring(4,6) * 1 - pStartDate.substring(4,6) * 1;
          } else {
              //strTermCnt = Math.floor((strEDT.getTime()-strSDT.getTime())/(1000*60*60*24*365.25/12));
              strTermCnt = Math.round((strEDT.getTime()-strSDT.getTime())/(1000*60*60*24*365/12));
          }
      }
      return strTermCnt;
  }

  $(document).ready(function() {

      //url parameter : get method
      var carno = $.urlParam('carno');
      if( carno ) {
          var carno = decodeURI($.urlParam('carno')) //한글처리
      }
      var stemp = $.urlParam('sdate');
      var etemp = $.urlParam('edate');

      //이전 검색어 입력
      if(carno){
        //$('#carno').val(carno);
      }

      // console.log("stemp:");      console.log(stemp);
      // console.log("etemp:");      console.log(etemp);

      if( !stemp) {
        //Initilize : today
        $("#GuestInDate").datepicker("setDate",new Date());
        $("#GuestOutDate").datepicker("setDate",new Date());
      }
      else {
        const tmpSDate = stemp.split("-");
        const tmpEDate = etemp.split("-");
        const newSDate = new Date(tmpSDate[0], tmpSDate[1]-1, tmpSDate[2]);
        const newEDate = new Date(tmpEDate[0], tmpEDate[1]-1, tmpEDate[2]);
        $("#GuestInDate").datepicker("setDate", newSDate);
        $("#GuestOutDate").datepicker("setDate", newEDate);
        console.log(newSDate);
        console.log(newEDate);
    }
    $("#search").trigger("click");
  });

  $( "#GuestInDate" ).datepicker(
    {
        //minDate: '0',
       //altFormat: "yy-mm-dd",
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNames: ['일','월','화','수','목','금','토'],
        dayNamesShort: ['일','월','화','수','목','금','토'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        yearSuffix: '년',
      onSelect: function() {
        var indate = $("#GuestInDate").val();
        $('#GuestOutDate').datepicker("setDate",indate);
      }
     }
   );

   $("#GuestOutDate").datepicker(
        {
          //maxDate: '3',
         //altFormat: "dd/mm/yy",
         dateFormat: 'yy-mm-dd',
         prevText: '이전 달',
         nextText: '다음 달',
         monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
         monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
         dayNames: ['일','월','화','수','목','금','토'],
         dayNamesShort: ['일','월','화','수','목','금','토'],
         dayNamesMin: ['일','월','화','수','목','금','토'],
         showMonthAfterYear: true,
         changeMonth: true,
         changeYear: true,
         yearSuffix: '년',
         beforeShow: function() {
           var myMinDate=jQuery('#GuestInDate').val();

           /////////////////////////////////////////////////////////
           //오늘날짜
           var date = new Date();
           var year = date.getFullYear();
           var month = date.getMonth() +1;
           var day = date.getDate();
           if((month+"").length < 2) {
             month = "0" + month;
           }
           if((day+"").length < 2) {
             day = "0" + day;
           }
           var getToday = year+"-"+month+"-"+day;
           /////////////////////////////////////////////////////////
           var a = getToday;
           var aArr = getToday.split('-');
           var b = myMinDate;
           var bArr = myMinDate.split('-');

           var nCalc = fn_calcDayMonthCount(aArr[0]+aArr[1]+aArr[2], bArr[0]+bArr[1]+bArr[2], 'D')
           var myMaxDate = nCalc + 30;

           // 종료일 최소값, 최대값 지정
           jQuery(this).datepicker('option', 'minDate', myMinDate);
           jQuery(this).datepicker('option', 'maxDate', myMaxDate);
         }
      }
   );

   $.urlParam = function(name){
    	 var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
       if (results==null){
           return null;
        }
        else{
           return results[1] || 0;
        }
   }

    $("#carno").focus(function(){
         $('#carno').val("");
      });
    $("#carno").blur(function(){
      });

     //차량별 중복건수
     $("#search").click(function() {
        //e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다
        procUrl = "parkingTimeList.php";

       $.ajax({
              url: procUrl,
              type: 'GET',
              data: {
                carno:$("#carno").val(),
                sdate:$("#GuestInDate").val(),
                edate:$("#GuestOutDate").val(),
              },
              success: function(results) {
                    console.log("ajax Search success");
                    $("#carregListdata").html(results);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                    console.log("ajax Search error : " + textStatus + "\n" + errorThrown);
  									alert('정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SV_E999)');
  							}
          });
     });

  </script>




</body>

</html>
