<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    일자: <input type="text" id="start_date">
        <input type="text" id="end_date">

</body>


<script>
            //오늘날짜 초기 출력
    $(document).ready(function() {
        //$('#start_date').datepicker();
        //$('#datepicker').datepicker('setDate', 'today');
        $("#start_date").datepicker("setDate",new Date());
        $("#end_date").datepicker("setDate",new Date());
    });

    $( "#start_date" ).datepicker(
      {
          defaultDate: new Date(),
          //setDate: getDate, // error
          minDate: '0',
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
          yearSuffix: '년'
       }
     );
     $("#end_date").datepicker(
          {
           dateFormat: 'yy-mm-dd',
           beforeShow: function() {
             var myMinDate=jQuery('#start_date').val();
             //시작날짜
             jQuery(this).datepicker('option', 'minDate', myMinDate);

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

             // (minDate-오늘날짜) 차이계산
             var a = getToday;
             var aArr = getToday.split('-');
             var b = myMinDate;
             var bArr = myMinDate.split('-');
             var nToday = new Date(aArr[0],aArr[1],aArr[2]);
             var nStart = new Date(bArr[0],bArr[1],bArr[2]);
             var nCalc = (nStart - nToday)/(24 * 3600 * 1000);

             // 종료일=minDate(시작날짜)+3 으로 정함
              jQuery(this).datepicker('option', 'maxDate', nCalc+3);
           }
         }
     );
</script>
</html>
