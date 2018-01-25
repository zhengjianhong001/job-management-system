<?php
require '../../mysql_connect.php';
require('../../model/functions.php');
header( 'Content-Type:text/html;charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {       // 处理表单
	$homework_title=$_POST['homework_title'];
	$class = $_POST['class'];
	$complete_time = str_replace("T"," ",$_POST['complete_time']);
	$content = $_POST['content'];
	$homework_attach_files = $_FILES['homework_attach_files'];  
	$email_content = "<h2>{$homework_title}</h2><p>{$content}</p><p>作品截至上传日期为：{$complete_time},请在规定时间上传作品</p>".'<a href="http://112.74.57.28/student_homework_system/php/login.php">上传作品请点击此链接</a>';
	// 验证数据返回错误消息
	$errors = check_publish_homework($homework_title, $class, $complete_time, $content, $homework_attach_files); 

	if (!empty($errors)) {  
		echo "<script>alert('请完善表单——".$errors[0]."')</script>";
	}else{         //表单输入正常
		$last_insert_id = pubish_homework($pdo, $homework_title, $class, $complete_time, $content);
		if($last_insert_id > 0 && homework_attach_files_save($pdo, $last_insert_id, $homework_attach_files) )
		{ 
			add_homework_info_product($pdo, $last_insert_id, $class);
		    //发送电子邮件
			$q = "select email,name from student_info where class = '$class' ";
			$res = $pdo -> query($q);
			foreach ($res as $row) {
				sendmail($row['email'], 'user', "新作品提醒", $email_content);
			}
			echo "<script>alert('作品发布成功，并已通过邮件方式提醒同学完成！');</script>";
		}
		else
			echo "<script>alert('作品发布失败，请重新操作!');</script>";
							
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-responsive.css"/>
	<link rel="stylesheet" href="../../assets/css/indexTop.css" />
	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../../assets/css/mc-all.css"/>
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="../../assets/css/index_Beauty.css"/>
	<style type="text/css">
		.homework_submit{
			margin-top: 175px;
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
	</script>
</head>


<body>
<div class="mod_right" style="position: relative;top: 10px;left: 20px;width: 87%;">
 	<div class="updit" style="margin-top: -10px;margin-left: 10px;">
	 	<h3>发布新作品</h3>
		<span class="h2_text">实践是检验真理的唯一标准。</span>
	</div> 
	<form action="" method="POST" enctype="multipart/form-data">

		<div class="upfood_form" name="submit_form" style="margin-left: 10px;">

		<p style="cursor: default;" class="must" >作品名称</p>
		<input type="text" id="foodName"  name="homework_title" class="form-control" style="width: 750px;height: 30px;" placeholder="作品名称" value="<?php if(isset($_POST['homework_title']))echo $_POST['homework_title']; ?>" />
		<div style="clear: both;padding-top: 15px"> 
			<ul style="list-style:none;margin:0;">
				<li style="display:inline;float: left;margin-right: 150px">
					<p style="cursor: default;" class="must2">选择班级</p>
					<select id="pref_noopt" style="width: 200px" name="class" class="selectable">
						<?php $res = sel_all_class($pdo); foreach($res as $row){ ?>
		                <option value="<?php echo $row['class']; ?>" <?php if($row['class'] == "14信息管理") echo "select"; ?>><?php echo $row['class']; ?> </option>
		                <?php } ?>
		                
					</select>
				</li>
				<li style="display:inline;float: left;">
					<p style="cursor: default;" class="must2">作品截至上交日期</p>
					<input type="datetime-local" name="complete_time" value="2018-01-14T12:00:00"/>
				</li>
			</ul>
		</div>
		<div style="clear: both;">
			<p style="cursor: default;color: #888;" class="must3">上传附件（不超过5个文件,格式支持.csv,.xlsx,.txt,.ppt,.doc,.jpg,.png,.psd）</p>
			<a href="javascript:;" class="file">选择附件
			    <input type="file" id="file" accept=".csv,.xlsx,.txt,.ppt,.doc,.docx,.jpg,.png,.psd" onchange="javascript:setFilePreviews();" name="homework_attach_files[]" multiple="multiple">
			</a>
			 <div id="dd" style="width:700px;margin-left: -5px;"></div>
		 </div>
		 <div style="clear: both;height: auto;">
		<textarea  name="content" class="J_input"  style="width: 740px;height:200px;resize: none;" placeholder="请输入作品内容"><?php if(isset($_POST['content']))echo $_POST['content']; ?></textarea>
		</div>
		<input type="submit" class="homework_submit"  name="submit" value="发布作品">
	</form>
</div> 
</body>
</html>