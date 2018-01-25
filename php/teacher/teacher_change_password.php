<?php 
require '../../mysql_connect.php';
require '../../model/functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$password_now=$_POST['password_now'];
	$password_new=$_POST['password_new'];
	$password_renew=$_POST['password_renew'];
	changepsw_teacher($pdo,$password_now,$password_new,$password_renew);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <style type="text/css">
    	ul{
			list-style-type: none;
		}
		.inputS{
		     width: 25%;
		    font-size: 14px;
		    margin: 5px 0;
		    border: 1px solid #ccc;
		    height: 24px;
		    line-height: 24px;
		    text-indent: 1%;
		    padding: 3px 0;
		}
		.btn1{
		    background: #ff6767;
		    border: 1px solid #ff6767;
		    color: #fff;
		    border-radius: 3px;
		    cursor: pointer;
		    font-size: 16px;
		    height: 38px;
		    margin-right: 16px;
		    width: 140px;
		}
		 ul, li {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		ul li{
		    padding-bottom: 20px;
		}
		 ul li label{
		    cursor: default;
		}
    </style>
</head>
<body>
<form action="" method="POST"  enctype="multipart/form-data" style="margin: 20px;">
  	<ul>
  		<li><label>当前密码</label><br><input class="inputS"  name="password_now" type="password" autocomplete="off"></li>
  		<li><label>新密码</label><br><input class="inputS"  name="password_new" type="password" autocomplete="off">&nbsp;&nbsp;<span class="tip">密码为6-14个字符</span></li>
  		<li><label>确认密码</label><br><input class="inputS"  name="password_renew" type="password" autocomplete="off"></li>
  	</ul>
  	<input name="save_submit" style="width: 140px;height: 38px;margin-bottom: 50px;" value="保存修改" class="btn1" type="submit">
</form>
</body>
</html>