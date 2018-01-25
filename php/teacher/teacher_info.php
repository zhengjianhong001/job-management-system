<?php 
require '../../mysql_connect.php';
require('../../model/functions.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	self_update_teacher_info($pdo,$name,$email,$phone,$_COOKIE['teacher_number']);
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
  		<?php $res=sel_teacher_info_tea_num($pdo,$_COOKIE["teacher_number"]); foreach($res as $row){  ?>
  		<li><label>工号</label><br><input class="inputS" disabled="true"  name="teacher_number" type="input" autocomplete="off" value="<?php echo $row['work_number']; ?>">*</li>
  		<li><label>姓名</label><br><input class="inputS"  name="name" type="input" autocomplete="off"  value="<?php echo $row['name']; ?>">&nbsp;&nbsp;</li>
  		<li><label>邮箱</label><br><input class="inputS"  name="email" type="input" autocomplete="off"  value="<?php echo $row['email']; ?>"></li>
  		<li><label>联系电话</label><br><input class="inputS"  name="phone" type="input" autocomplete="off"  value="<?php echo $row['phone']; ?>"></li>
  		<li><label>职称</label><br><input disabled="true" class="inputS"  name="professional" type="input" autocomplete="off"  value="<?php echo $row['professional']; ?>">*</li>
  		<?php } ?>
  	</ul>
  	<input name="save_submit" style="width: 140px;height: 38px;margin-bottom: 50px;" value="保存修改" class="btn1" type="submit">
</form>
</body>
</html>