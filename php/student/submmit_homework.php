<?php 
require '../../mysql_connect.php';
require('../../model/functions.php');
if(isset($_GET['homework_id'])){
    $homework_id = $_GET['homework_id'];    //获取地址栏传过来的homework_id
}else{
	header("location: student_new_homework.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$txtarea = $_POST['txtarea'];
	//$product_attach_files = $_FILES['product_attach_files'];  
	if($_FILES['product_attach_files']['name'][0] != '' && !empty($txtarea)){
		if(uplaod_product($pdo, $txtarea, $_FILES['product_attach_files'], $_GET['homework_id'], $_COOKIE['student_number']))
			echo "<script>alert('作品提交成功');window.location.href='student_product_info.php';</script>";
		else
			echo "<script>alert('作品提交失败，请重新操作!');</script>";
	}else
	  echo "<script>alert('请完整填写表单');</script>";

}
?>
 
<!doctype html>
<html lang="zh" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>	
	<link rel="stylesheet" type="text/css" href="../../assets/css/mc-all.css"/>
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" href="css/style_upload_product.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<style type="text/css">
		.homework_submit{
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
	</style>
</head>
<body>
	<header class="htmleaf-header">
		<?php $res = get_all_homework_info_from_id($pdo, $homework_id); foreach ($res as $row) {?>
		<h1>题目：<?php echo $row['homework_title']; ?> <span><?php echo $row['content']; ?></span><span>截至日上传期：<?php echo $row['complete_time']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;指导老师：".get_homeword_teacher_name($pdo, $row['teacher_number']); ?></span><span>相关资料下载:&nbsp;&nbsp;<?php $files = get_homework_attach_file($pdo, $row['id']); 
 foreach ($files as $row_file) {
 	$file_name = $row_file['attach_file'];
 	echo '<a style="color:rgb(195, 255, 205);cursor:hand;" href="download.php?filename='.$file_name.'">'.substr($row_file['attach_file'], 27).'</a>'."&nbsp;&nbsp;";	
 } ?></span></h1>
		 <?php } ?>
		<div class="htmleaf-links">			
		</div>
	</header>
	<div class="cd-articles">
		<article>
			<header>
				<h1><?php $res = sel_student_info_stu_num($pdo, $_COOKIE['student_number']);
				foreach ($res as $row) {
				 	echo $row['class'].$row['name'];
				 } ?></h1>
			</header>
			<form action="" method="POST" enctype="multipart/form-data">
			<p>
				提交我的作品（不超过5个文件,格式支持.csv,.xlsx,.txt,.ppt,.doc,.docx,.jpg,.png,.psd）
			</p>
			
			<div>	
				<a href="javascript:;" class="file">选择附件
				    <input type="file" id="file" accept=".csv,.xlsx,.txt,.ppt,.doc,.docx,.jpg,.png,.psd" onchange="javascript:setFilePreviews();" name="product_attach_files[]" multiple="multiple">
				</a>
				 <div id="dd" style="width:700px;margin-left: -5px;"></div>
			</div>
				
			<p>
				<textarea name="txtarea" style="max-width: 600px;width: 500px;height: 150px;font-family: sans-serif;font-size: 25px;" placeholder="简单描述你的作品....."></textarea>
			</p>
			<input type="submit" class="homework_submit" id="btn" name="submit" value="发布作品">
			</form>
		</article>
	</div> <!-- .cd-articles -->
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->
	<script>
		//下面用于多文件上传预览功能
		function setFilePreviews(avalue) {
		        var docObj = document.getElementById("file");
		        var dd = document.getElementById("dd");
		        dd.innerHTML = "";
		        var fileList = docObj.files;
		        if (fileList.length>5) {
		           alert("不能超过五个文件");
		           docObj="";
		        }else{
			        for (var i = 0; i < fileList.length; i++) {            
			            dd.innerHTML += fileList[i].name+"<br/>";
			        }  
			        return true;
		    }
		}
	
		// function check_upload_file_empty() {
		// 	var oInput = document.getElementById('file');
		// 	oInput.onchange = function() {
		// 	    if(this.value == '') {
		// 	        alert('empty');
		// 	    }else {
		// 	        alert(this.value);
		// 	    }
		// 	}
		// }
	</script>
</body>
</html>
