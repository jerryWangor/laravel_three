// var code ; //在全局定义验证码 
// window.onload = createCode; //页面加载的时候显示验证码
//产生验证码
function createCode(){
	code = ""; 
	var codeLength = 4;//验证码的长度
	var checkCode = document.getElementById("code"); 
	var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');//随机数
	for(var i=0;i<codeLength;i++) {
		var index = Math.floor(Math.random()*36); //取得随机数的索引（0~35）
		code += random[index]; //根据索引取得随机数加到code上
	}
	checkCode.value = code; //把code值赋给验证码
}
//校验验证码
function check_verify() {
	var inputCode = document.getElementById("verify").value.toUpperCase(); //取得输入的验证码并转化为大写      
	if(inputCode.length <= 0) { //若输入的验证码长度为0
		$("#errmsg").html("请输入验证码！");
		post_error();
		return false; 
	} else if(inputCode != code ) { //若输入的验证码与产生的验证码不一致时
		$("#errmsg").html("验证码输入错误！");
		post_error();
		createCode();//刷新验证码
		document.getElementById("verify").value = "";//清空文本框
		return false;
	}
	return true;
}
function check_space() {
	if(event.keyCode == 32) event.returnValue = false;
}
function check_enter() {
	if(event.keyCode==13) { $('.add_qq').trigger('click'); return false;}
}
function trim(str){ //去掉头尾空格
	return str.replace(/(^\s*)|(\s*$)/g, "");
}
function check_user(user) { //检查用户名，只能是字母或数字和下划线
	return(new RegExp(/^[a-zA-Z][a-zA-Z0-9_]{4,17}$/).test(user));
}
function check_pwd(pwd) {
    return(new RegExp(/^[\\~!@#$%^&*()-=+|{}\[\],.?\/:;\'\"\w]{6,16}$/).test(pwd));
}
function check_nickname(nickname) { //检查名字，4-18个字母数字下划线或者2-8个汉字
    return(new RegExp(/^(([a-zA-Z][a-zA-Z0-9_]{4,18})|([\u4e00-\u9fa5]{2,6}))$/).test(nickname));
}
function check_qqcard(qqcard) { //检查QQ号，2-12个数字
    return(new RegExp(/^[1-9][0-9]{1,11}$/).test(qqcard));
}
function check_weixincard(weixincard) { //检查微信号，6~20个字母、数字、下划线和减号，必须以字母开头!
    return(new RegExp(/^[a-zA-Z][a-zA-Z0-9_-]{5,19}$/).test(weixincard));
}
function check_birthday(birthday) { //检查生日日期
    return(new RegExp(/^[12][0-9]{3}-(([0][0-9])|([1][12]))-(([012][0-9])|([3][01]))$/).test(birthday));
}
function check_telephone(telephone) { //检查生日日期
    return(new RegExp(/^1[34578]{1}\d{9}$/).test(telephone));
}
function check_dxverify(dxverify) { //检查生日日期
    return(new RegExp(/^\d{6}$/).test(dxverify));
}
function check_email(email){ //检查邮箱
	return(new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(email));
}
function check_newstitle(title) { //检查文章标题，1-30个汉字
    return(new RegExp(/^([\u4e00-\u9fa5]{1,30})$/).test(title));
}
function check_text(title) { //检查文本，2-50个汉字
    return(new RegExp(/^([\u4e00-\u9fa5]{2,50})$/).test(title));
}
