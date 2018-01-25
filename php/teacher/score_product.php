<?php 
require '../../mysql_connect.php';
require('../../model/functions.php');
if(isset($_GET['product_id']) && isset($_GET['homework_id']) && isset($_GET['student_id']) && isset($_GET['submit_time']) && isset($_GET['desciption'])){
    $product_id = $_GET['product_id'];    //获取地址栏传过来的product_id
    $homework_id = $_GET['homework_id'];
    $student_id = $_GET['student_id'];
    $submit_time = $_GET['submit_time'];
    $desciption = $_GET['desciption'];
}else{
	header("location: homework_admin.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$comments = $_POST['comments'];
	$score = $_POST['score'];
	if(!empty($comments) && !empty($score) && is_numeric($score)){
		if(teacher_score_product($pdo, $product_id, $score, $comments))
			echo "<script>alert('评分成功');window.location.href='homework_admin.php';</script>";
		else
			echo "<script>alert('评分失败');</script>";

	}else
		echo "<script>alert('请正确填写表单');</script>";
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
		 	echo '<a style="color:rgb(195, 255, 205);cursor:hand;" href="../student/download.php?filename='.$file_name.'">'.substr($row_file['attach_file'], 27).'</a>'."&nbsp;&nbsp;";	
		 } ?></span></h1>
		 <?php } ?>
		<div class="htmleaf-links">			
		</div>
	</header>
	<div class="cd-articles">
		<article>
			<header>
				<h1><?php $student_number = get_student_number($pdo, $student_id); $res = sel_student_info_stu_num($pdo, $student_number);
				foreach ($res as $row) {
				 	echo $row['class'].$row['name'];
				 } ?></h1>
			</header>
			
			<p>
				提交时间： <?php echo $submit_time; ?>
			</p>
			<p>
				作品简介： <?php echo $desciption; ?>
			</p>
			<p>
				<ol>
					<li style="float: left;margin-right: 20px;">作品下载：</li>
					<li style="float: left;">
						<ul>
							<?php $files = get_product_attach_file($pdo, $product_id); 
							 foreach ($files as $row_file) {
							 	$file_name = $row_file['attach_file'];
							 	echo '<li><a style="color:#ff6767;font-weight:bold;cursor:hand;" href="../student/download.php?filename='.$file_name.'">'.substr($row_file['attach_file'], 27).'</a></li>';	
							 } ?>
							
							
						</ul>
					</li>
				</ol>
			
				
			</p>
			<p>
			<form action="" method="POST">
			<div>	
				
				<input name="score" type="text" style="width:100px;height: 50px;font-family: sans-serif;font-size: 30px" placeholder="评分">
			</div>
				
			<p>
				<textarea name="comments" style="max-width: 600px;width: 500px;height: 150px;font-family: sans-serif;font-size: 25px;" placeholder="对这个作品的评语....."></textarea>
			</p>
			<input type="submit" class="homework_submit"  name="submit" value="提交">
			</form>
			</p>
		</article>
	</div> <!-- .cd-articles -->
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->
	
</body>
</html>
