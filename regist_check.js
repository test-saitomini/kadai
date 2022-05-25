$(function(){
	$('input:submit[id="btn_confirm"]').click(function(){
		if(!input_check()){
			return false;
		}
	});
});

// 入力内容チェックのための関数
function input_check(){
	var result = true;

	// エラー用装飾のためのクラスリセット
	$('#name').removeClass("inp_error");
	$('#mail').removeClass("inp_error");
	$('#password').removeClass("inp_error");
    $('#password_re').removeClass("inp_error");

	// 入力エラー文をリセット
	$("#name_error").empty();
	$("#mail_error").empty();
	$("#password_error").empty();
    $('#password_re_error').empty();

	// 入力内容セット
	var name   = $("#name").val();
	var mail = $("#mail").val();
	var password  = $("#password").val();
    var password_re = $("#password_re").val();
    var password_check;

	// 入力内容チェック
	// お名前
	if(name == ""){
		$("#name_error").html(" 名前が未入力です。");
		$("#name").addClass("inp_error");
		result = false;
	}else if(name.length >100){
		$("#name_error").html(" 名前は100文字以内で入力してください。");
		$("#name").addClass("inp_error");
		result = false;
	}
	// メールアドレス
	if(mail == ""){
		$("#mail_error").html(" メールアドレスが未入力です。");
		$("#mail").addClass("inp_error");
		result = false;
	}else if(!mail.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)){
		$('#mail_error').html(" 正しいメールアドレスを入力してください。");
		$("#mail").addClass("inp_error");
		result = false;
	}else if(mail.length > 100){
		$('#mail_error').html(" メールアドレスは100字以内で入力してください。");
		$("#mail").addClass("inp_error");
		result = false;
	}
    //パスワード
    //alert(document.getElementById("password_check"));
    //alert(document.getElementById("password_check").checked);
    if(document.getElementById("password_check") === null　|| document.getElementById("password_check").checked){
        if(password == ""){
            $("#password_error").html(" パスワードが未入力です。");
            $("#password").addClass("inp_error");
            result = false;
	   }else if(password.length >10){
           $("#password_error").html(" パスワードは10文字以内で入力してください。");
           $("#password").addClass("inp_error");
           result = false;
	   }else if(!password.match(/^[0-9a-zA-Z]+$/)){
           $("#password_error").html(" パスワードは半角英数字で入力してください。");
           $("#password").addClass("inp_error");
           result = false;
       }else if(password !== password_re){
           $("#password_re_error").html(" パスワードが一致しません。");
           $("#password_re").addClass("inp_error");
           result = false;
       }
    }
    return result;
}