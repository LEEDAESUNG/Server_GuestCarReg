<!DOCTYPE html>
<html lang="en">
<head>
	<title>사전방문차량 예약시스템</title>
      	<meta charset="UTF-8">
      	<meta name="viewport" content="width=device-width, initial-scale=1">



        <!--===============================================================================================-->
        	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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



        <!-- Bootstrap -->
        <link href="./bootstrap-4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- font awesome -->
        <!--<link href="./fonts/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet"> -->
        <!-- Custom style -->
        <link rel="stylesheet" href="./css/style.css" media="screen" title="no title" charset="utf-8">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!--<script src="/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!--<script src="../plugin/bootstrap/js/bootstrap.min.js"></script>-->
        <script src="/join.js"></script>
</head>
    <body>
      <div class="limiter">
        <div class="container-login100">
          <div class="wrap-login100 p-t-50 p-b-90">
            <form class="login100-form validate-form flex-sb flex-w" method="post" action="signup_ok.php">
              <span class="login100-form-title p-b-51">
                방문차량 예약시스템<br>(가입신청)
              </span>
<!--              <table>
    			        <tr>
    			            <td style='width:100px'>이름</td>
    			            <td><input type="text" size=37 name="userNM" value=""></td>
    			        </tr>
    			        <tr>
    			            <td>E-Mail</td>
    			            <td>
    			                <input type="text" size=25 name="email" value="">
    			                <input type="button" id="checkid" value="중복체크">
    			            </td>
    			        </tr>
    			        <tr>
    			            <td>휴대폰번호</td>
    			            <td><input type="text" size=37 name="mobileNO" value=""></td>
    			        </tr>
    			        <tr>
    			            <td>비밀번호</td>
    			            <td><input type="password" size=37 name="Password"></td>
    			        </tr>
    			        <tr>
    			            <td>비밀번호(확인)</td>
    			            <td><input type="password" size=37 name="rePassword"></td>
    			        </tr>
    			        <tr>
    			            <td colspan='2' align='center'><input type="submit" value="회원가입"></td>
    			        </tr>
    			    </table>
-->

            <table>
              <tr>
                <td>휴대폰번호</td>
                <td><input type="text" name="mobileNO" value="111" ></td>
              </tr>
<!--
              <tr >
                <th style="font-size:18px;">동</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                    <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="dong" id="inputDong" placeholder="*동" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*동';">
                </th>
			        </tr>
              <tr >
                <th style="font-size:18px; width:80%;">호수</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                  <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="ho" id="inputHo" placeholder="*호수" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*호수';">
                </th>
              </tr>
              <tr >
                <th style="font-size:18px;">아이디</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                  <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="inputCarno" id="inputID" placeholder="*로그인 아이디" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*로그인 아이디';">
                </th>
              </tr>
              <tr >
                <th style="font-size:18px;">비밀번호</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                  <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="inputPassword" id="inputPassword" placeholder="*비밀번호" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*비밀번호';">
                </th>
              </tr>
              <tr >
                <th style="font-size:18px;">비밀번호</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                  <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="inputPasswordCheck" id="inputPasswordCheck" placeholder="*비밀번호 확인" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*비밀번호 확인';">
                </th>
              </tr>
              <tr >
                <th style="font-size:18px;">차량번호</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="inputCarno" id="inputCarno" placeholder="차량번호 전체 입력" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='차량번호 전체 입력';">
                </th>
              </tr>
              <tr >
                <th style="font-size:18px;">휴대폰번호</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>
                  <input style="background-color:#e6e6e6; line-height:2.2; font-size:28px; padding: 0 20px 0 38px; " type="text" name="inputMobile" id="inputMobile" placeholder="*휴대폰번호 입력" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*휴대폰번호 입력';">
                </th>
              </tr>
-->

            </table>
<!--
              <td class="wrap-input100 validate-input m-b-16" data-validate = "동을 입력하세요">
                  <input class="input100" type="text" name="dong" id="inputDong" placeholder="*동" onfocus="this.placeholder = ''" onblur="if(this.placeholder=='')this.placeholder='*동';">
                  <span class="focus-input100"></span>
              </td>
-->

-->
<!--

                    <div class="form-group">
                        <label for="inputName">성명</label>
                        <input type="text" class="form-control" id="inputName" placeholder="이름을 입력해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputMobile">휴대폰 번호</label>
                        <input type="tel" class="form-control" id="inputMobile" placeholder="휴대폰번호를 입력해 주세요">
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">이메일 주소</label>
                        <input type="email" class="form-control" id="InputEmail" placeholder="이메일 주소를 입력해주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">비밀번호</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="비밀번호를 입력해주세요">
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordCheck">비밀번호 확인</label>
                        <input type="password" class="form-control" id="inputPasswordCheck" placeholder="비밀번호 확인을 위해 다시한번 입력 해 주세요">
                    </div>
-->
<!--
                    <div class="form-group text-center">
                      <span>
                        <button type="submit" id="join-submit" class="btn btn-primary">
                            이용신청<i class="fa fa-check spaceLeft"></i>
                        </button>
                      </span>
                      <span>
                        <button type="submit" class="btn btn-warning">
                            취소<i class="fa fa-times spaceLeft"></i>
                        </button>
                      </span>
                    </div>
-->
                  <div class="form-group text-center">
                  <button type="submit" id="join-submit" > . </button>
                  </div>



                </form>
            </div>

        </article>
    </body>
</html>
