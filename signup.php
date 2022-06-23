<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="form.css"  />

<!--===============================================================================================-->
	<!--<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>-->
	<link rel="icon" type="image/png" href="images/icons/Parking_Red.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<link href="./bootstrap-4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="./css/style.css" media="screen" title="no title" charset="utf-8"> -->


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="vendor/jquery/jquery.min.js"></script>
<!--<script>

$(document).ready(function(){
    // 회원가입처리
    $("form").submit(function(){
        var userNM = $("input[name='userNM']");
        if( userNM.val() =='') {
            alert("성명을 입력하세요");
            userNM.focus();
            return false;
        }

        var email = $("input[name='email']");
        if(email.val() == ''){
            alert('이메일을 입력하세요');
            email.focus();
            return false;
        } else {
            var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!emailRegex.test(email.val())) {
                alert('이메일 주소가 유효하지 않습니다. ex)abc@gmail.com');
                email.focus();
                return false;
            }
        }

        var mobileNO = $("input[name='mobileNO']");
        if(mobileNO.val() ==''){
            alert('휴대폰 번호를 입력하세요');
            mobileNO.focus();
            return false;
        } else if(!/^[0-9]{10,11}$/.test(mobileNO.val())){
            alert("휴대폰 번호는 숫자만 10~11자리 입력하세요.");
            return false;
        } else if(!/^(01[016789]{1}|02|0[3-9]{1}[0-9]{1})([0-9]{3,4})([0-9]{4})$/.test(mobileNO.val())){
            alert("유효하지 않은 전화번호 입니다.");
            return false;
        }

        var password = $("input[name='Password']");
        var repassword = $("input[name='rePassword']");
        if(password.val() =='') {
            alert("비밀번호를 입력하세요!");
            password.focus();
            return false;
        }
        if(password.val().search(/\s/) != -1){
            alert("비밀번호는 공백없이 입력해주세요.");
            return false;
        }
        if(!/^[a-zA-Z0-9!@#$%^&*()?_~]{8,20}$/.test(password.val())){
            alert("비밀번호는 숫자, 영문, 특수문자(!@$%^&*?_~ 만 허용) 조합으로 8~20자리를 사용해야 합니다.");
            return false;
        }
        // 영문, 숫자, 특수문자 2종 이상 혼용
        var chk=0;
        if(password.val().search(/[0-9]/g) != -1 ) chk ++;
        if(password.val().search(/[a-z]/ig)  != -1 ) chk ++;
        if(password.val().search(/[!@#$%^&*()?_~]/g) != -1) chk ++;
        if(chk < 2){
            alert("비밀번호는 숫자, 영문, 특수문자를 두가지이상 혼용하여야 합니다.");
            return false;
        }
        // email이 아닌 userID 인 경우에는 체크하면 유용. email은 특수 허용문자에서 걸러진다.
        //if(password.val().search(userID.val())>-1){
        //    alert("userID가 포함된 비밀번호는 사용할 수 없습니다.");
        //    return false;
        //}
        if(repassword.val() =='') {
            alert("비밀번호를 다시 한번 더 입력하세요!");
            repassword.focus();
            return false;
        }
        if(password.val()!== repassword.val()){
            alert('입력한 두 개의 비밀번호가 일치하지 않습니다');
            return false;
        }

    });

    // userID(e-mail) 가입여부 검사
    $("#checkid").click(function(e){
        e.preventDefault();
        var email = $("input[name='email']");
        if(email.val() == ''){
            alert('이메일을 입력하세요');
            email.focus();
            return false;
        } else {
            var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!emailRegex.test(email.val())) {
                alert('이메일 주소가 유효하지 않습니다. ex)abc@gmail.com');
                email.focus();
                return false;
            }
        }

        $.ajax({
            url: 'a.joinChk.php',
            type: 'POST',
            data: {userID:email.val()},
            dataType: "json",
            success: function (msg) {
                //alert(msg); // 확인하고 싶으면 dataType: "text" 로 변경한 후 확인 가능
                if(msg.result == 1){
                    alert('사용 가능합니다');
                } else if(msg.result == 0){
                     alert('이미 가입된 아이디입니다');
                    email.val('');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("arjax error : " + textStatus + "\n" + errorThrown);
            }
        });
    });
});
</script>
-->

<!--<script src="/join.js"></script>-->

<script>

function CarnoCheckFunc(obj){
		var str = obj.value;
		var len = 0;
		for (var i = 0; i < str.length; i++) {
				if (escape(str.charAt(i)).length == 6) {
						len++;
				}
				len++;
		}

		if( len>0) {
				if(len==8 || len==9 || len==11 || len==12){
					//차량번호 입력 정상
				}
				else {
					//차량번호 입력 오류
					alert("차량번호를 올바로 입력해주세요");
					//document.getElementById("InputCarno").value = "";
					obj.value="";
					obj.focus();
				}
		}
}

function NumeircCheckFunc(obj){
		var str = obj.value;
		num = str.replace(/[^0-9]/g, '');
		obj.value = num;
}

function zeroFillDong(target, width) {
  // var n = target.value;
  //var id = target.id;
	var n = document.getElementById('inputDong').value;
  var id = 'inputDong';

  n = n + "";
  if(n.length >= width){
   document.getElementById(id).value = n;
 }else if(n.length>0){
   document.getElementById(id).value = new Array(width - n.length + 1).join('0') + n;
 }else if(n.length==0){
	 //document.getElementById(id).value = '*동(숫자)';
 }


	document.getElementById('inputID').value = document.getElementById('inputDong').value + document.getElementById('inputHo').value;
}
function zeroFillHo(target, width) {
	var n = document.getElementById('inputHo').value;
  var id = 'inputHo';
  n = n + "";
  if(n.length >= width){
   document.getElementById(id).value = n;
  }else if(n.length>0){
   document.getElementById(id).value = new Array(width - n.length + 1).join('0') + n;
  }else if(n.length==0){
 	 //document.getElementById(id).value = '*호(숫자)';
  }

	document.getElementById('inputID').value = document.getElementById('inputDong').value + document.getElementById('inputHo').value;
}
</script>

<script type="text/javascript">

	$(document).ready(function(){

			$('.inputPW1 i').on('click',function(){
	        $('input').toggleClass('active');
	        if($('input').hasClass('active')){
	            $(this).attr('class',"fa fa-eye-slash fa-lg")
	            .prev('input').attr('type',"text");
	        }else{
	            $(this).attr('class',"fa fa-eye fa-lg")
	            .prev('input').attr('type','password');
	        }
	    });
			$('.inputPW2 i').on('click',function(){
	        $('input').toggleClass('active');
	        if($('input').hasClass('active')){
	            $(this).attr('class',"fa fa-eye-slash fa-lg")
	            .prev('input').attr('type',"text");
	        }else{
	            $(this).attr('class',"fa fa-eye fa-lg")
	            .prev('input').attr('type','password');
	        }
	    });


			$("input:text[numberOnly]").on("keyup", function() {//한글입력 후 tab키 처리
					num = $(this).val().replace(/[^0-9]/g, '');
					$(this).val(num);
			});

			// $("#inputDong").on('keyup', function(e){
			// 		str = $(this).val().replace(/[^0-9]/g, '');
			// 		nStr = parseInt(str); //정수
			// 		var tmp = '';
			// 		if( nStr.length > 4){
			// 				tmp = nStr.substr(0, 4);
			// 		}
			// 		else {
			// 				tmp = nStr;
			// 				//tmp = new Array(4 - str.length + 1).join('0') + str;
			// 		}
			// 		$(this).val(tmp);
			// 		$("#inputID").val( $("#inputDong").val() + $("#inputHo").val() );
			// });

			// $("#inputDong").blur(function(){
			// 	//$("#inputID").val( $(this).val());
      // });
			// $("#inputHo").on('keyup', function(e){
			// 		str = $(this).val().replace(/[^0-9]/g, '');
			// 		var tmp = '';
			// 		if( str.length > 4){
			// 				tmp = str.substr(0, 4);
			// 		}
			// 		else {
			// 				tmp = str;
			// 		}
			// 		$(this).val(tmp);
			// 		$("#inputID").val($("#inputDong").val() + $("#inputHo").val());
			// });


			$("#inputID").on('keyup', function(e){
					str = $(this).val().replace(/[^0-9]/g, '');
					var tmp = '';
					if( str.length > 8){
							tmp = str.substr(0, 8);
					}
					else {
							tmp = str;
					}
					$(this).val(tmp);
			});

			$("#inputMobile").on('keyup', function(e){
					str = $(this).val().replace(/[^0-9]/g, '');
					var tmp = '';
					if( str.length < 4){
							tmp = str;
					}else if(str.length < 7){
							tmp += str.substr(0, 3);
							tmp += '-';
							tmp += str.substr(3);
					}else if(str.length < 11){
							tmp += str.substr(0, 3);
							tmp += '-';
							tmp += str.substr(3, 3);
							tmp += '-';
							tmp += str.substr(6);
					}else{
							tmp += str.substr(0, 3);
							tmp += '-';
							tmp += str.substr(3, 4);
							tmp += '-';
							tmp += str.substr(7);
					}
					//$("#inputMobile").val(tmp);
					$(this).val(tmp);
			});

			$('#cancel_submit').click(function(e) {
					e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다
					location.replace('/login.php');
			});
			$('#join-submit').click(function(e){
					e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다

					if($("#inputName").val() ==''){
							alert('이름을 입력하세요');
							$("#inputName").focus();
							return false;
					}
					if($("#inputDong").val() ==''){
							alert('동을 입력하세요(숫자4자리)');
							$("#inputDong").focus();
							return false;
					}else if(($("#inputDong").val()).length <4){
						alert('동을 입력하세요(숫자4자리)');
						$("#inputDong").val("");
						$("#inputDong").focus();
						return false;
					}

					if($("#inputHo").val() ==''){
							alert('호수를 입력하세요(숫자4자리)');
							$("#inputHo").focus();
							return false;
					}else if(($("#inputHo").val()).length <4){
						alert('호수를 입력하세요(숫자4자리)');
						$("#inputHo").val("");
						$("#inputHo").focus();
						return false;
					}

					if($("#inputID").val() ==''){
							alert('아이디를 입력하세요');
							$("#inputID").focus();
							return false;
					}else if(($("#inputID").val()).length != 8){
						alert('아이디를 입력하세요(동+호수)');
						$("#inputID").val("");
						$("#inputID").focus();
						return false;
					}

					if($("#inputPassword").val() ==''){
							alert('비밀번호를 입력하세요');
							$("#inputPassword").focus();
							return false;
					}
					if($("#inputPasswordCheck").val() ==''){
							alert('비밀번호를 다시 한번 더 입력하세요');
							$("#inputPasswordCheck").focus();
							return false;
					}
					if($("#inputPassword").val()!== $("#inputPasswordCheck").val()){
							alert('비밀번호를 둘다 동일하게 입력하세요');
							return false;
					}
					// if($("#inputCarno").val() ==''){
					// 		alert('차량번호 전체를 입력하세요');
					// 		$("#inputCarno").focus();
					// 		return false;
					// }
					if($("#inputMobile").val() ==''){
							alert('휴대폰번호를 입력하세요');
							$("#inputMobile").focus();
							return false;
					}
					$.ajax({
							url: 'signup_ok.php',
							type: 'POST',
							data: {
									name:$("#inputName").val(),
									dong:$("#inputDong").val(),
									ho:$("#inputHo").val(),
									id:$("#inputID").val(),
									password:$("#inputPassword").val(),
									carno:$("#inputCarno").val(),
									mobileno:$("#inputMobile").val()
							},
							dataType: "json",
							success: function (response) {
									if(response.result == 1){
											alert('가입 완료했습니다. 로그인 후 즉시 이용할 수 있습니다');
											location.replace('/login.php');
									} else if(response.result == 2){
											//alert('가입신청 완료했습니다. 관리실로 [방문예약] 승인요청 하세요');
											alert(response.message);
											location.replace('/login.php');
									} else if(response.result == 0){
											alert('사용할 수 없는 아이디 입니다. 관리실로 문의바랍니다(에러코드:SU_E001)');
									} else if(response.result == -1){
											alert('가입신청 처리중 에러가 발생했습니다. 잠시후 재시도하세요(SU_E002)');
									} else if(response.result == -2){
											//alert('해당 아이디는 [승인대기]상태입니다. 승인요청은 관리실로 문의바랍니다');
											alert(response.message);
											location.replace('/login.php');
									} else if(response.result == -3){
											alert(response.message);
											location.replace('/login.php');
									} else {
											alert('가입신청 처리중 에러가 발생했습니다. 잠시후 재시도하세요(SU_E003)');
									}
							},
							error: function(jqXHR, textStatus, errorThrown) {
									//alert("ajax error : " + textStatus + "\n" + errorThrown);
									alert('정의되지 않은 에러 발생. 동일현상 반복적으로 발생시 관리실 문의바랍니다(SU_E999)');
							}
					});
			});


	});
</script>

</head>
<body>
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand mb-0 h1" href = "/guestcarreg.php" >
			<div style="color:black; font-weight:bold; font-size:1.0em;">
      <img src="/images/icons/Parking_Red.ico" width="30" height="30" class="d-inline-block align-top" alt="">
      방문예약 시스템</div>
	  </a>
	</nav>
					<form role="form">
			    <table style="font-size:18px; width:100%;" >

							<tr style="width:100%;"></tr>
							<tr style="width:100%;">
								<!-- <td colspan='2' align='center' style="font-size:30px" >방문 예약시스템<br>(가입신청)</td> -->
								<td></td>
								<td align='left' style="font-size:30px" ><가입신청></td>
							</tr>

							<tr></tr>

			        <tr style="width:100%;">
			            <th style="width:50%; text-align:right; " >이름&nbsp;</th>
									<th><input style="background-color:#e6e6e6; line-height:1.8; " type="text" name="name" id="inputName" placeholder="*이름" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*이름';"></th>
			        </tr>
							<tr>
									<th style="width:50%; text-align:right;">동&nbsp;</th>
	                <th>
										<!-- <input style="background-color:#e6e6e6; line-height:1.8; " type="text" numberOnly name="dong" id="inputDong" placeholder="*동(숫자)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*동(숫자)'; NumeircCheckFunc(this);"> -->
										<input style="background-color:#e6e6e6; line-height:1.8;" type="text" numberOnly id="inputDong" maxlength="4" placeholder="*동(숫자)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*동(숫자)'; zeroFillDong(this, 4);" />
									</th>
			        </tr>
							<div>
									<th style="width:50%; text-align:right;">호수&nbsp;</th>
	                <th>
										<!-- <input style="background-color:#e6e6e6; line-height:1.8; " type="text" numberOnly name="ho" id="inputHo" placeholder="*호(숫자)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*호(숫자)'; NumeircCheckFunc(this);"> -->
										<input style="background-color:#e6e6e6; line-height:1.8;" type="text" numberOnly id="inputHo" maxlength="4" placeholder="*호(숫자)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*호(숫자)'; zeroFillHo(this, 4);" />
									</th>
			        </tr>
							<tr>
									<th style="width:50%; text-align:right;">아이디&nbsp;</th>
									<!-- <th><input style="background-color:#e6e6e6; line-height:1.8; " type="text" name="id" id="inputID" placeholder="*아이디(동+호수 8자리)" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*아이디(동+호수 8자리)';" readonly></th> -->
									<th><input style="background-color:grey; line-height:1.8; " type="text" name="id" id="inputID" readonly></th>
			        </tr>

							<tr class=inputPW1>
			            <th style="width:50%; text-align:right;">비밀번호&nbsp;</th>
			            <th><input style="background-color:#e6e6e6; line-height:1.8; " type="password" name="inputPassword" id="inputPassword" placeholder="*비밀번호" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*비밀번호';">
											<!--<i class="fa fa-eye fa-lg"></i>-->
									</th>
			        </tr>
			        <tr class=inputPW2>
			            <th style="width:50%; text-align:right;">비밀번호(확인)&nbsp;</th>
			            <th><input style="background-color:#e6e6e6; line-height:1.8; " type="password" name="inputPasswordCheck" id="inputPasswordCheck" placeholder="*비밀번호 확인" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*비밀번호 확인';">
											<!--<i class="fa fa-eye fa-lg"></i>-->
									</th>
			        </tr>

              <tr >
                <th style="width:50%; text-align:right;">차량번호&nbsp;</th>
                <th><input style="background-color:#e6e6e6; line-height:1.8; " type="text" name="inputCarno" id="inputCarno" placeholder="123가1234" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='123가1234'; CarnoCheckFunc(this);"></th>
              </tr>
              <tr >
                <th style="width:50%; text-align:right;">휴대폰번호&nbsp;</th>
                <th><input style="background-color:#e6e6e6; line-height:1.8; " type="text" name="inputMobile" id="inputMobile" maxlength="13" placeholder="*010-0000-0000" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*010-0000-0000';"></th>
              </tr>
<!--
			        <tr>
			            <td>E-Mail</td>
			            <td>
			                <input type="text" size=25 name="email" value="">
			                <input type="button" id="checkid" value="중복체크">
			            </td>
			        </tr>
-->

			        <tr>
									<th></th>
			            <!--<td colspan='2' align='center'><input type="submit" value="가입신청"></td>-->
									<!--<th align='left'><input type="submit" value="가입신청"></th>-->
									<th align='left'>
									<button type="submit" id="join-submit" class="btn btn-primary" ><!--btn-primary:bootstrap -->
                            가 입 신 청<i class="fa fa-check spaceLeft"></i></button> <!--fa-check:awesome font -->
									<button type="submit" id="cancel_submit" class="btn btn-warning" >
														취&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소<i class="fa fa-times spaceLeft"></i></button>
									</th>
			        </tr>
							<tr>
								<th></th>
								<th align='left'>
									<span style='color:orange; font-weight:bold; font-size:0.8em; '>가입신청 후 관리실에서 사용승인</span><br>
									<span style='color:orange; font-weight:bold; font-size:0.8em; '>해야만 이용가능합니다 </span>
								</th>
							</tr>
			    </table>

</fom>
</div>
</div>
</div>
</body>
</html>
