/**
 * 
 */

var web_lang = $('#lang').val(); // en-us, zh-cn

if(web_lang == undefined) {
	web_lang = 'zh-cn';
}

var display_lang = new Array();
var zh_cn = new Array();
var en_us = new Array();

/***Start***/
zh_cn['login fail'] = '登录失败';
en_us['login fail'] = 'login fail';

zh_cn['network connection fail!'] = '网络连接错误！';
en_us['network connection fail!'] = 'network connection fail!';

zh_cn['register fail'] = '注册失败';
en_us['register fail'] = 'register fail';

zh_cn['please login again'] = '您可能已经在其他地方登录，请重新登录';
en_us['please login again'] = 'please login again';

zh_cn["New Password Needed"] = '需要新密码';
en_us["New Password Needed"] = 'New Password Needed';

zh_cn["Please Confirm New Password"] = "请确认新密码";
en_us["Please Confirm New Password"] = "Please Confirm New Password";

zh_cn['success'] = '成功';
en_us['success'] = 'success';

zh_cn["Incorrect Email Format"] = "邮件格式不正确";
en_us["Incorrect Email Format"] = "Incorrect Email Format";

zh_cn["Incorrect Phone"] = "手机号格式不正确";
en_us["Incorrect Phone"] = "Incorrect Phone";

zh_cn['tag count exceed limit'] = 'tag标签已经超过限制';
en_us['tag count exceed limit'] = 'tag count exceed limit';

zh_cn['no match'] = '无法匹配';
en_us['no match'] = 'no match';

zh_cn['language count exceed limit'] = '可以选择的语言数目达到上限';
en_us['language count exceed limit'] = 'language count exceed limit';

zh_cn['Please fill in valid number'] = '请填写合法的数字';
en_us['Please fill in valid number'] = 'Please fill in valid number';

zh_cn['Redirecting to payment page'] = '正在转入支付页面';
en_us['Redirecting to payment page'] = 'Redirecting to payment page';

zh_cn['Please fill in a number < your money'] = '请填写少于您钱数的金额';
en_us['Please fill in a number < your money'] = 'Please fill in a number < your money';

zh_cn['Please fill in a number >= 20'] = '最低提现金额20元';
en_us['Please fill in a number >= 20'] = 'Withdraw money should >= 20';

zh_cn["Withdraw is comming soon"] = "提现功能正在开发中。。。";
en_us["Withdraw is comming soon"] = "Withdraw is comming soon";

zh_cn["Withdraw success! We will transfer money in 3 days."] = "提现成功！我们将在3个工作日内将提现金额转入您的支付宝账户。";
en_us["Withdraw success! We will transfer money in 3 days."] = "Withdraw success! We will transfer money in 3 days.";

zh_cn["Withdraw fail!"] = "提现失败！";
en_us["Withdraw fail!"] = "Withdraw fail!";

zh_cn["you have already published your task!"] = '您已经发布了任务！';
en_us["you have already published your task!"] = "you have already published your task!";

zh_cn["Please choose one tag at least!"] = '请您至少选择一个标签！';
en_us["Please choose one tag at least!"] = "Please choose one tag at least!";

zh_cn['title, des and tags upload success!'] = '标题、描述和标签上传成功！';
en_us['title, des and tags upload success!'] = 'title, des and tags upload success!';

zh_cn["you need to build your task!"] = "您需要创建任务！";
en_us["you need to build your task!"] = "you need to build your task!";

zh_cn["you need to upload data!"] = "您需要上传数据！";
en_us["you need to upload data!"] = "you need to upload data!";

zh_cn["you need to publish your task!"] = "您需要发布任务！";
en_us["you need to publish your task!"] = "you need to publish your task!";

zh_cn["you have published your task, cannot change your setting!"] = "您已经发布了任务，不能修改设置！";
en_us["you have published your task, cannot change your setting!"] = "you have published your task, cannot change your setting!";

zh_cn["you need to publish your task!"] = "您需要发布任务！";
en_us["you need to publish your task!"] = "you need to publish your task!";

zh_cn["ajax error. Template load fail!"] = "AJAX错误，模板载入出错！";
en_us["ajax error. Template load fail!"] = "ajax error. Template load fail!";

zh_cn['update success!'] = '更新成功！';
en_us['update success!'] = 'update success!';

zh_cn["task create"] = "任务创建成功";
en_us["task create"] = "task create";

zh_cn["ajax error. Task create failed!"] = "AJAX错误，任务创建失败！";
en_us["ajax error. Task create failed!"] = "ajax error. Task create failed!";

zh_cn["Are you sure to PUBLISH?"] = "您确定要【发布】任务吗？";
en_us["Are you sure to PUBLISH?"] = "Are you sure to PUBLISH?";

zh_cn["publish success!"] = "发布成功！";
en_us["publish success!"] = "publish success!";

zh_cn["golden upload success!"] = "暗测数据上传成功！";
en_us["golden upload success!"] = "golden upload success!";

zh_cn["data upload success!"] = "数据上传成功！";
en_us["data upload success!"] = "data upload success!";

zh_cn["pic upoad success."] = "图片上传成功";
en_us["pic upoad success."] = "pic upoad success.";

zh_cn["No pic uploaded, No url file to download"] = "您没有上传图片，没有可下载的URL文件";
en_us["No pic uploaded, No url file to download"] = "No pic uploaded, No url file to download";

zh_cn["please answer all questions!"] = "请回答所有问题！";
en_us["please answer all questions!"] = "please answer all questions!";

zh_cn["submit success!"] = "提交成功！";
en_us["submit success!"] = "submit success!";

zh_cn["submit fail!"] = "提交失败！";
en_us["submit fail!"] = "submit fail!";

zh_cn["no available units"] = "没有可用单元";
en_us["no available units"] = "no available units";

zh_cn["email format error"] = "邮箱格式错误";
en_us["email format error"] = "Email Format Error!";

zh_cn["need long password"] = "密码长度太短";
en_us["need long password"] = "Need Long Password!";

zh_cn["passwords do not match"] = "密码不一致";
en_us["passwords do not match"] = "Passwords Do Not Match";

zh_cn["reset password request failed"] = "发送重置密码请求失败";
en_us["reset password request failed"] = "reset password request failed";

zh_cn["vtoke error"] = "您的链接错误或者已经过期，请重新发送重置邮件";
en_us["vtoke error"] = "The url you want to accese may have some errors or exceed the time limit,please resend email";

zh_cn["reset success"] = "重置密码成功，跳转到登录页面";
en_us["reset success"] = "Reset pasword successfully, directing to login page...";

zh_cn["email hasn't been registered"] = "该邮箱尚未注册";
en_us["email hasn't been registered"] = "The email hasn't been registered";

zh_cn["email exists"] = "邮箱已经被注册";
en_us["email exists"] = "This email has been registered";

zh_cn["user exists"] = "用户名已经被注册";
en_us["user exists"] = "username has been registered";

zh_cn["verify successfully"] = "激活邮箱成功";
en_us["verify successfully"] = "Verify email successfully";

zh_cn["verify failed"] = "激活邮箱失败";
en_us["verify failed"] = "Verify email failed";

zh_cn["send email successfully"] = "发送验证邮件成功，请及时查收邮件";
en_us["send email successfully"] = "Send verification email successfully, please receive email now!";

zh_cn["send email failed"] = "发送邮件失败";
en_us["send email failed"] = "Send email failed";
/***End***/

if(web_lang == 'zh-cn') {
	display_lang = zh_cn;
}
else if(web_lang == 'en-us') {
	display_lang = en_us;
}
else {
	display_lang = zh_cn;
}

function change_zh_cn() {
	display_lang = zh_cn;
	web_lang = 'zh-cn';
	location.href="?l=zh-cn";
}

function change_en_us() {
	display_lang = en_us;
	web_lang = 'en-us';
	location.href="?l=en-us";
}