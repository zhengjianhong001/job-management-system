<?php 
require '../../mysql_connect.php';
require('../../model/functions.php');
if(isset($_GET['homework_id'])){
    $homework_id = $_GET['homework_id'];    //获取地址栏传过来的homework_id
}else{
	header("location: student_new_homework.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$comment = $_POST['comment'];
	if(empty($comment))
		echo "<script>alert('评论不能为空');</script>";
	else{
		$student_id = get_student_id($pdo, $_COOKIE['student_number']);
		$res = get_student_product_hava_score_info($pdo, $_COOKIE['student_number'], $homework_id); 
					foreach ($res as $row) {
						$product_id = $row['id'];
					}
		if(student_comment($pdo, $product_id, $student_id, $comment))
			echo "<script>alert('评论成功')';</script>";
		else
			echo "<script>alert('评论失败');";
	}

}
?>
<!doctype html>
<html lang="zh" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>	
	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" href="css/style_upload_product.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
	<style>
		.student_comments{
			min-height: 500px;
		}
		.student_comments ul li{
			float: left;
			max-width: 500px;
			min-width: 500px;
			width: 500px;
			margin-top: 10px;
			border-bottom: black 1px dotted;
		}
		.catListTitle{
			    background-color: #169fe6;
			    border: 1px solid #169fe6;
			    color: #fff;
			    font-size: 18px;
			    font-weight: normal;
			    padding: 10px 20px;
		}
		.other_student_style ul{
			    border: 1px solid #dedede;
    			border-top: none;
		}
		.other_student_style ul li{
			    display: list-item;
    			text-align: -webkit-match-parent;
    			line-height: 2;
    			font-size: 14px;
    			list-style: none;
			    border-bottom: 1px solid #e9e9e9;
			    padding: 15px 10px 15px 20px;
			    font-size: 14px;
			    color: #777;
		}
		.other_student_a{
			color: black;
		    font-family: Verdana,Arial,Helvetica,sans-serif;
		    font-size: 14px;
		    line-height: 25px;
		    cursor: auto;
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
			
			<p>
				<?php $res = get_student_product_hava_score_info($pdo, $_COOKIE['student_number'], $homework_id); 
					foreach ($res as $row) {
						echo "作品提交时间 ".$row['submit_time'];?>
			</p>
			<p>
				<?php echo "作品简介：".$row['desciption']; ?>
			</p>
			<p>
				<?php if($row['score'] != null){ echo "作品评分：<span style='color:red;font-weight:bold;'>".$row['score']."</span>"; ?>
			</p>
			<p>
				<?php echo "教师评语：<span style='color:red'>".$row['desciption']."</span>";}else echo '未评分'; }?>
			</p>
			<p>
				<ol>
					<li style="float: left;margin-right: 20px;">作品下载：</li>
					<li style="float: left;">
						<ul>
							<?php $files = get_product_attach_file($pdo, $row['id']); 
 foreach ($files as $row_file) {
 	$file_name = $row_file['attach_file'];
 	echo '<li><a style="color:#ff6767;font-weight:bold;cursor:hand;" href="download.php?filename='.$file_name.'">'.substr($row_file['attach_file'], 27).'</a></li>';	
 } ?>
							
							
						</ul>
					</li>
				</ol>
			
				
			</p>
			<p>
				<form action="" method="post">
				<textarea  placeholder="这个作品你怎么看..." name="comment" style="max-width: 600px;width: 500px;height: 150px;"></textarea>
				<div><input type="submit" value="提交"></div>
				</form>
			</p>
		</article>
		<div class="student_comments">
			<ul>
				<?php $res_product = get_student_product_hava_score_info($pdo, $_COOKIE['student_number'], $homework_id); 
					foreach ($res_product as $row) {
						$product_id = $row['id'];
					} $res = get_product_comment($pdo, $product_id);foreach ($res as $row_comments) { ?>
				<li>
					<div><span style="color: blue;margin-right: 20px;"><?php $res_student = sel_student_info_id($pdo, $row_comments['student_id']); foreach ($res_student as $value) {
						echo $value['student_number'].$value['name'];
					} ?></span><span style="color: #888;"><?php echo $row_comments['created_at']; ?></span>
					<div style="margin:20px;"><?php echo $row_comments['comments']; ?></div>
				</li>
				<?php } ?>
			</ul>
		</div>

		
<!--侧边栏-->	
		<div class="other_student_product" style="height:auto;width:auto;background-color: #fff;position: absolute;top: 80px;right: -150px;word-break: break-all;color: white;min-height: 100px;min-width: 300px;max-width: 500px;">
			<h3 class="catListTitle">其他同学作品</h3>
			<div class="other_student_style">
				<ul>
					<?php 
						$student_id = get_student_id($pdo, $_COOKIE['student_number']);
					 	$res = get_other_product_info($pdo, $homework_id, $student_id);
					 	foreach ($res as $row) {
					 	 ?>
					<li>
						<a class="other_student_a" href="other_student_product.php?homework_id=<?php echo $homework_id; ?>&student_id=<?php echo $row['student_id']; ?>"><?php $student_res = sel_student_info_id($pdo, $row['student_id']); foreach ($student_res as $value) {
							echo $value['student_number'].$value['name'];
						} ?><br><?php if(strlen($row['desciption']) > 90) echo mb_substr($row['desciption'],0,60,'utf-8')."..."; else echo $row['desciption'];  ?></a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		
		
	</div> <!-- .cd-articles -->

	
	
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
