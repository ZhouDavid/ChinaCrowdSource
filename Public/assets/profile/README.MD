profile页面采用了ajax提交和获取json的方式与服务器进行交互：

需要修改的四个函数是：
1. init	页面初始化，向服务器发送get请求获取json数据；
2. save_account  保存账户信息，向服务器发送post请求；
3. save_personal_info  保存个人信息，向服务器发送post请求；
4. save_other_info   保存其他信息，向服务器发送post请求；

只需在这四个函数之内，修改ajax的url，在服务器端处理json数据即可。