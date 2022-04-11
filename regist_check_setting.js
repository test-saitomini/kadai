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
	$('#day_kaishi').removeClass("inp_error");
	$('#day_owari').removeClass("inp_error");
	$('#midashi').removeClass("inp_error");

	// 入力エラー文をリセット
	$("#day_kaishi_error").empty();
	$("#day_owari_error").empty();
	$("#midashi_error").empty();

	// 入力内容セット
	var day_kaishi   = $("#day_kaishi").val();
	var day_owari = $("#day_owari").val();
	var midashi  = $("#midashi").val();

	// 入力内容チェック
	// 日付（開始）
	if(day_kaishi == ""){
		$("#day_kaishi_error").html("日付（開始）が未入力です。");
		$("#day_kaishi").addClass("inp_error");
		result = false;
	}
	// 日付（終了）
	if(day_owari == ""){
		$("#day_owari_error").html("日付（終了）が未入力です。");
		$("#day_owari").addClass("inp_error");
		result = false;
	}
    
    if(midashi == ""){
		$("#midashi_error").html("見出しが未入力です。");
		$("#midashi").addClass("inp_error");
		result = false;
	}
    return result;
}