
$(function(){

    ////////////////////////////////////////////////////////////////////////
    // 회원가입 버튼
    $('#join-submit').click(function(e){
        e.preventDefault(); // html에서 <a>, <submit 등의 동작중지한다

        if($("#inputName").val() ==''){
            alert('이름을 입력하세요');
            $("#inputName").focus();
            return false;
        }
        if($("#inputDong").val() ==''){
            alert('동을 입력하세요');
            $("#inputDong").focus();
            return false;
        }
        if($("#inputHo").val() ==''){
            alert('호수를 입력하세요');
            $("#inputHo").focus();
            return false;
        }
        if($("#inputID").val() ==''){
            alert('아이디를 입력하세요');
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
        if($("#inputCarno").val() ==''){
            alert('차량번호 전체를 입력하세요');
            $("#inputCarno").focus();
            return false;
        }
        //if($("#inputMobile").val() ==''){
        //    alert('핸드폰번호를 입력하세요');
        //    $("#inputMobile").focus();
        //    return false;
        //}

/*        var email = $('#InputEmail').val();
        if(email == ''){
            alert('이메일을 입력하세요');
            $("#InputEmail").focus();
            return false;
        } else {
            var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!emailRegex.test(email)) {
                alert('이메일 주소가 유효하지 않습니다. ex)abc@gmail.com');
                $("#inputEmail").focus();
                return false;
            }
        }
*/


/*
        if($("#agree").is(":checked") == false){
            alert('약관에 동의하셔야 합니다');
            return false;
        }
*/

        $.ajax({
            url: 'signup_ok.php',
            type: 'POST',
            data: {
                name:$("#inputName").val(),
                dong:$("#inputDong").val(),
                ho:$("#inputHo").val(),
                id:$('#inputID').val(),
                password:$('#inputPassword').val(),
                carno:$("#inputCarno").val(),
                mobileno:$("#inputMobile").val(),
                //userID:$('#InputEmail').val(),
            },
            dataType: "json",
            success: function (response) {
                if(response.result == 1){
                    alert('가입 완료됐습니다. 관리실에서 가입신청 처리완료 이후 이용가능합니다.');
                    location.replace('/login.php'); // 화면 갱신
                } else if(response.result == 0){
                    alert('이미 가입된 아이디입니다');
                    .id.setfocus();
                } else if(response.result == -2){
                    alert('입력된 값이 없습니다');
                } else {
                    alert('등록중에 에러가 발생했습니다');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert("ajax error : " + textStatus + "\n" + errorThrown);
            }
        });
    });

/*
    ////////////////////////////////////////////////////////////////////////
    $('#inputMobile').on('keyup', function(e){
        //방법1

        alert('inputMobile keyup');
        str = $(this).val().replace(/[^0-9]/g, '');

        //alert(str);
        var tmp = '';
        if( str.length < 4){
            //return str;
            tmp = str;
        }else if(str.length < 7){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3);
            //return tmp;
        }else if(str.length < 11){
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 3);
            tmp += '-';
            tmp += str.substr(6);
            //return tmp;
        }else{
            tmp += str.substr(0, 3);
            tmp += '-';
            tmp += str.substr(3, 4);
            tmp += '-';
            tmp += str.substr(7);
            //return tmp;
        }
        //$("#inputMobile").val(tmp);
        $(this).val(tmp);
    });
*/
});
