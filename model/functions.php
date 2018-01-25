<?php
header( 'Content-Type:text/html;charset=utf-8');
 function user_student_login($pdo, $role, $student_number, $passwd)
 {
 	//echo $passwd;
 	// $q = "select * from student_info where name = '$username' and password = '$passwd' ";
 	$q = "select * from student_info where student_number = '$student_number' and password = '$passwd' ";
 	$res = $pdo -> query($q);
	if($res -> rowCount() == 1){
		return 1;
	}else{
		return 0;
	}
 }
 function user_teacher_login($pdo, $role, $student_number, $passwd)
 {
 	//echo $passwd;
 	// $q = "select * from student_info where name = '$username' and password = '$passwd' ";
 	$q = "select * from teacher_info where work_number = '$student_number' and password = '$passwd' ";
 	$res = $pdo -> query($q);
	if($res -> rowCount() == 1){
		return 1;
	}else{
		return 0;
	}
 }
  function user_admin_login($pdo, $role, $student_number, $passwd)
 {
 	//echo $passwd;
 	// $q = "select * from student_info where name = '$username' and password = '$passwd' ";
 	$q = "select * from admin_info where name = '$student_number' and password = '$passwd' ";
 	$res = $pdo -> query($q);
	if($res -> rowCount() == 1){
		return 1;
	}else{
		return 0;
	}
 }
 //  function user_register($pdo,$role,$name,$passwd,$email)
 // {
 // 	$c = date("y-m-d H:i:s",time());
	// $q = "insert into user(name,password,email,role,created_at)values('$name','$passwd','$email','$role','$c')";
	// $affect_rows = $pdo->exec($q);

	// if($affect_rows == 1)
	// 	echo "<script>alert('注册成功！');</script>";
	// else{
	// 	echo "<script>alert('注册失败');</script>";
	// 	print_r($pdo->errorInfo());
	// }
 // }
 function email_checked($pdo, $email)
 {
 	$q = "select * from student_info where email = '$email' ";
	$r = $pdo -> query($q);
	
	if($r -> rowCount() == 1){
		$q="select password from student_info where email='$email'";
	  	$r=$pdo->query($q);
	  	$password=$r->fetchColumn(0);  
		return $password;
	}else{
		$q = "select * from teacher_info where email = '$email' ";
		$r = $pdo -> query($q);
		
		if($r -> rowCount() == 1){
			$q="select password from teacher_info where email='$email'";
		  	$r=$pdo->query($q);
		  	$password=$r->fetchColumn(0);  
			return $password;
		}else{
				return 0;
		}
	}
 }

//学生用户修改密码
function changepsw_student($pdo, $password_now, $password_new, $password_renew){
    if(empty($password_renew) && empty($password_new) && empty($password_now))
	  	echo "<script>alert('请将表单信息填写完整');</script>";
	else{

	    if(user_student_login($pdo,$_COOKIE['role'],$_COOKIE['student_number'],$password_now)){

	        if(strlen($password_new) < 6)
	        	echo "<script>alert('新密码长度不能小于6个字符');</script>";
		    elseif(strlen($password_new) > 14)
		        echo "<script>alert('新密码长度不能超过14个字符');</script>";
		    elseif($password_new != $password_renew)
		      echo "<script>alert('确认密码不一样');</script>";
		    else{
		        $password = $password_new;
		        $student_number = $_COOKIE['student_number'];
		        $q = "update student_info set password = '$password' where student_number = '$student_number'";
		            $affect_rows = $pdo->exec($q);
		        if($affect_rows == 1)
		        	echo "<script>alert('修改成功');</script>";
		        else
		        	echo "<script>alert('修改失败');</script>";
		    }
	    }else
	      echo "<script>alert('您输入的当前密码有误');</script>";
	    
	}
}
//教师修改密码
function changepsw_teacher($pdo, $password_now, $password_new, $password_renew){
    if(empty($password_renew) && empty($password_new) && empty($password_now))
	  	echo "<script>alert('请将表单信息填写完整');</script>";
	else{

	    if(user_teacher_login($pdo,$_COOKIE['role'],$_COOKIE['teacher_number'],$password_now)){

	        if(strlen($password_new) < 6)
	        	echo "<script>alert('新密码长度不能小于6个字符');</script>";
		    elseif(strlen($password_new) > 14)
		        echo "<script>alert('新密码长度不能超过14个字符');</script>";
		    elseif($password_new != $password_renew)
		      echo "<script>alert('确认密码不一样');</script>";
		    else{
		        $password = $password_new;
		        $teacher_number = $_COOKIE['teacher_number'];
		        $q = "update teacher_info set password = '$password' where work_number = '$teacher_number'";
		            $affect_rows = $pdo->exec($q);
		        if($affect_rows == 1)
		        	echo "<script>alert('修改成功');</script>";
		        else
		        	echo "<script>alert('修改失败');</script>";
		    }
	    }else
	      echo "<script>alert('您输入的当前密码有误');</script>";
	    
	}
}
//插入学生信息
function insert_student_info($pdo, $array)
{
	$student_number = $array[0];
	$name = $array[1];
	$phone = $array[2];
	$email = $array[3];
	$class = $array[4];
	$ct = date("y-m-d H:i:s",time());
	//判断学号和邮箱是否存在，如果存在则不允许插入
	$q_student = "select * from student_info where student_number = '$student_number' or email = '$email' ";
	$res_student = $pdo -> query($q_student);
	if($res_student -> rowCount() == 0){
		$q = "insert  into student_info(name,student_number,email,phone,class,created_at) values('$name','$student_number','$email','$phone','$class','$ct')";
		$res = $pdo -> query($q);
		if( $res -> rowCount() == 0)
				echo $name."的信息上传失败，请核对信息后重新上传<br>";
			else
				return 1;
	}else{
		echo $name."的邮箱或学号已经存在！<br>";
	}	
	
}
//插入教师信息
function insert_teacher_info($pdo, $array)
{
	$work_number = $array[0];
	$name = $array[1];
	$phone = $array[2];
	$email = $array[3];
	$professional = $array[4];
	$ct = date("y-m-d H:i:s",time());
	//判断工号和邮箱是否存在，如果存在则不允许插入
	$q_teacher = "select * from teacher_info where work_number = '$work_number' or email = '$email' ";
	$res_teacher = $pdo -> query($q_teacher);
	if($res_teacher -> rowCount() == 0){
		$q = "insert  into teacher_info(name,work_number,email,phone,professional,created_at) values('$name','$work_number','$email','$phone','$professional','$ct')";
		$res = $pdo -> query($q);
		
		if( $res -> rowCount() == 0)
				echo $name."的信息上传失败，请核对信息后重新上传<br>";
			else
				return 1;
	}else{
		echo $name."的邮箱或工号已经存在！<br>";
	}	
	
	
	
}

//查询教师信息
function sel_teacher_info($pdo)
{
	$q = "select * from teacher_info";
	$res = $pdo -> query($q);
	return $res;
}
//查询学生信息
function sel_student_info($pdo)
{
	$q = "select * from student_info";
	$res = $pdo -> query($q);
	return $res;
}
//通过学生姓名查询信息
function student_search($pdo, $username)	
{
	$q = "select * from student_info where name like '%$username%'";
	$res = $pdo -> query($q);
	return $res;

}
//通过教师姓名查询信息
function teacher_search($pdo, $username)	
{
	$q = "select * from teacher_info where name like '%$username%'";
	$res = $pdo -> query($q);
	return $res;

}
//删除教师
function del_teacher($pdo, $teacher_id)
{
	$q="delete from teacher_info where id = $teacher_id";
	$affet_rows=$pdo->exec($q);
	if($affet_rows!=1){
		return "n";
	}else{
		return 'y';
	}
}
//删除学生
function del_student($pdo, $student_id)
{
	$q="delete from student_info where id = $student_id";
	$affet_rows=$pdo->exec($q);
	if($affet_rows!=1){
		return "n";
	}else{
		return 'y';
	}
}
//删除评论
function del_comments($pdo, $comments_id)
{
	$q = "delete from comments where id = $comments_id";
	$affet_rows = $pdo -> exec($q);
	if($affet_rows != 1){
		return "n";
	}else{
		return 'y';
	}
}
//删除homework
function del_teacher_homeowrk($pdo, $homework_id)
{
	$q = "delete from homework where id = $homework_id";
	$affet_rows = $pdo -> exec($q);
	if($affet_rows != 1){
		return "n";
	}else{
		return 'y';
	}
}
//删除product
function del_product($pdo, $product_id)
{
	$q="delete from product where id = $product_id";
	$affet_rows=$pdo->exec($q);
	if($affet_rows!=1){
		return "n";
	}else{
		return 'y';
	}
}
//管理员更新学生信息
function admin_update_student_info($pdo, $name, $student_number, $class, $email, $phone, $password, $student_id)
{
		$c=date("y-m-d H:i:s",time());
	 	$q="update  student_info set name='$name', student_number='$student_number',class='$class',email='$email',phone='$phone',password='$password',created_at='$c' where id='$student_id'";
	 	$affect_rows=$pdo->exec($q);
	    if($affect_rows==1){
	    	echo "<script>alert('修改成功！');</script>";
	    }else{
			echo "<script>alert('修改失败！');</script>";
	    }
	
}
//学生更新自己的信息
function self_update_student_info($pdo, $name, $email, $phone, $student_number)
{
		
	 	$q="update  student_info set name='$name',email='$email',phone='$phone' where student_number='$student_number' ";
	 	$affect_rows=$pdo->exec($q);
	    if($affect_rows==1){
	    	echo "<script>alert('修改成功！');</script>";
	    }else{
			echo "<script>alert('修改失败！');</script>";
	    }
	
}
//教师更新自己的信息
function self_update_teacher_info($pdo, $name, $email, $phone, $teacher_number)
{
		
	 	$q="update  teacher_info set name='$name',email='$email',phone='$phone' where work_number='$teacher_number' ";
	 	$affect_rows=$pdo->exec($q);
	    if($affect_rows==1){
	    	echo "<script>alert('修改成功！');</script>";
	    }else{
			echo "<script>alert('修改失败！');</script>";
	    }
	
}
//通过id查询教师信息
function sel_teacher_info_id($pdo, $user_id)	
{
	$q = "select * from teacher_info where id = $user_id";
	$res = $pdo -> query($q);
	return $res;

}
//更新教师信息
function admin_update_teacher_info($pdo, $name, $work_number, $professional, $email, $phone, $password, $teacher_id)
{
		$c=date("y-m-d H:i:s",time());
	 	$q="update  teacher_info set name='$name', work_number='$work_number',professional='$professional',email='$email',phone='$phone',password='$password',created_at='$c' where id=$teacher_id";
	 	$affect_rows=$pdo->exec($q);
	    if($affect_rows==1){
	    	echo "<script>alert('修改成功！');</script>";
	    }else{
			echo "<script>alert('修改失败！');</script>";
	    }
	
}
//通过学号获取学生信息
function sel_student_info_stu_num($pdo, $student_number)
{
	$q = "select * from student_info where student_number = '$student_number' ";
	$res = $pdo -> query($q);
	return $res;
}
//通过工号获取学生信息
function sel_teacher_info_tea_num($pdo, $teacher_number)
{
	$q = "select * from teacher_info where work_number = '$teacher_number' ";
	$res = $pdo -> query($q);
	return $res;
}
//统计出学生表所有人的班级
function sel_all_class($pdo)
{
	$q = "select class from student_info group by class";
	$res = $pdo -> query($q);
	return $res;
}
//检查教师发布作品表单的完整性
function check_publish_homework($homework_title, $class, $complete_time, $content, $homework_attach_files)
{
	$errors = array(); 
	if (empty($homework_title)) {  // 验证姓名的存在性与长度
      $errors[] = '作品名不能为空！';
    } else if (strlen($homework_title) > 1000) {
      $errors[] = '作品名太长了！';
    } 
    if (empty($content)) {  // 验证姓名的存在性与长度
      $errors[] = '作品内容不能为空！';
    } else if (strlen($content) > 10000) {
      $errors[] = '作品内容太长了！';
    }   
	return $errors;
}
//教师发布作品
function pubish_homework($pdo, $homework_title, $class, $complete_time, $content)
{
	$teacher_number = $_COOKIE['teacher_number'];
	$ct = date("y-m-d H:i:s",time());
	$q="insert into homework(homework_title,class,content,teacher_number,complete_time,created_at) values('$homework_title','$class','$content','$teacher_number','$complete_time','$ct')";
	$affect_rows=$pdo->exec($q);
	if($affect_rows==1){ 
		return $pdo->lastInsertId();
    }else{
        print_r($pdo->errorInfo());
        return false;
    }
}
//附件上传
function homework_attach_files_save($pdo, $last_insert_id, $homework_attach_files)
{
	for ($i = 0; $i < count($homework_attach_files['name']); $i++) {       
    	$time=date('YmdHis',time());  //时间戳 
    	$homework_attach_files_name = iconv("UTF-8","gb2312", $homework_attach_files['name'][$i]);
        if(move_uploaded_file($homework_attach_files['tmp_name'][$i], "../../upload/".$time.$homework_attach_files_name)){
            $sql_name = "../../upload/".$time.$homework_attach_files['name'][$i];
            $q = "insert into homework_attach_file(attach_file,homework_id)values('{$sql_name}','$last_insert_id')";
            $affect_rows = $pdo -> exec($q);

            if ($affect_rows != 1) 
            	return false;

        }else{
        	return false;
      	}   
    }
    return true;
}
//将教师发布的作品同步到学生作品表中
function add_homework_info_product($pdo, $homework_id, $class)
{
	$q = "select id from student_info where class = '$class' ";
	$res = $pdo -> query($q);
	foreach ($res as $row) {
		$student_id = $row['id'];
		$q_product = "insert into product(homework_id, student_id) values($homework_id, $student_id)";
		$affect_rows = $pdo -> exec($q_product);
		if ($affect_rows != 1) 
            	echo "文件插入出现错误！";
	}
}
//作品发布成功后的邮件提醒
// function send_homework_email($pdo, $class, $email_content){
// 	$q = "select email,name from student_info where class = '$class' ";
// 	$res = $pdo -> query($q);
// 	foreach ($res as $row) {
// 		echo $row['email'].$row['name'];
// 		sendmail($row['email'], $row['name'], "新作品提醒", "$email_content");
// 	}
// }
//未提交作品
function get_new_homework_info($pdo, $student_number)
{
	$q = "select id from student_info where student_number='$student_number' ";
	$res = $pdo -> query($q);  //根据学号找到学生的id
	if($res){
		foreach ($res as $row) {
			$student_id = $row['id'];
			$q_homework = "select homework_id from product where student_id = $student_id and submit_time is null  order by id desc ";
			$res_homework = $pdo -> query($q_homework);  
			//根据学生id在product表找到homework的id
			if($res_homework){
				$res_arr = array();
				foreach ($res_homework as $row_homwork) {
					$homework_id_product = $row_homwork['homework_id'];
					$q_homework = "select * from homework where id = $homework_id_product";
					$res = $pdo -> query($q_homework);
					$res_arr[] = $res;
				}
				return $res_arr;
			}
			   //没有homework_id说明没有未完成作业
		}
	}
}
//已经提交的作品
function  get_uploaded_homework_info($pdo, $student_number)
{
	$q = "select id from student_info where student_number='$student_number' ";
	$res = $pdo -> query($q);  //根据学号找到学生的id
	if($res){
		foreach ($res as $row) {
			$student_id = $row['id'];
			$q_homework = "select homework_id from product where student_id = $student_id and score is not null  order by id desc";
			$res_homework = $pdo -> query($q_homework);  
			//根据学生id在product表找到homework的id
			if($res_homework){
				$res_arr = array();
				foreach ($res_homework as $row_homwork) {
					$homework_id_product = $row_homwork['homework_id'];
					$q_homework = "select * from homework where id = $homework_id_product";
					$res = $pdo -> query($q_homework);
					$res_arr[] = $res;
				}
				return $res_arr;
			}
			   
		}
	}
}
//全部的作品
function  get_all_homework_info($pdo, $student_number)
{
	$q = "select id from student_info where student_number='$student_number' ";
	$res = $pdo -> query($q);  //根据学号找到学生的id
	if($res){
		foreach ($res as $row) {
			$student_id = $row['id'];
			$q_homework = "select homework_id from product where student_id = $student_id and submit_time is not null order by id desc";
			$res_homework = $pdo -> query($q_homework);  
			//根据学生id在product表找到homework的id
			if($res_homework){
				$res_arr = array();
				foreach ($res_homework as $row_homwork) {
					$homework_id_product = $row_homwork['homework_id'];
					$q_homework = "select * from homework where id = $homework_id_product";
					$res = $pdo -> query($q_homework);
					$res_arr[] = $res;
				}
				return $res_arr;

			}
			   
		}
	}
}
function get_product_info($pdo, $homework_id, $student_number)
{
	$q = "select id from student_info where student_number='$student_number' ";
	$res = $pdo -> query($q);  //根据学号找到学生的id
	if($res){
		foreach ($res as $row) {
			$student_id = $row['id'];
			$q_homework = "select score from product where student_id = $student_id and homework_id = $homework_id";
			$res_product = $pdo -> query($q_homework);  
			return $res_product;
		}
	}
}
function get_all_homework_info_from_id($pdo, $homework_id)
{
	$q = "select * from homework where id = $homework_id";
	$res = $pdo -> query($q);
	if($res)
		return $res;
}
function get_homeword_teacher_name($pdo, $teacher_number)
{
	  $q = "select name from teacher_info where work_number='$teacher_number'";
	  $r = $pdo -> query($q);
	  $name = $r->fetchColumn(0);
	  return $name;
}
//通过homework_id获取附件
function get_homework_attach_file($pdo, $homework_id)
{
	$q = "select * from homework_attach_file where homework_id = $homework_id ";
	$res = $pdo -> query($q);
	return $res;
}
//通过homework_id获取homework_title
function get_homework_title($pdo, $homework_id)
{
	$q = "select homework_title from homework where id = '$homework_id' ";
	$res = $pdo -> query($q);
	$homework_title = $res->fetchColumn(0);
	return $homework_title;
}
//通过homework_id获取complete_time
function get_homework_complete_time($pdo, $homework_id)
{
	$q = "select complete_time from homework where id = '$homework_id' ";
	$res = $pdo -> query($q);
	$complete_time = $res->fetchColumn(0);
	return $complete_time;
}
//通过product_id获取作品附件
function get_product_attach_file($pdo, $product_id)
{
	$q = "select * from product_attach_file where product_id = $product_id ";
	$res = $pdo -> query($q);
	return $res;
}
//学生提交作品
function uplaod_product($pdo, $txtarea, $product_attach_files, $homework_id, $student_number)
{
	$submit_time = date("Y-m-d H:i:s",time());
	$student_id = get_student_id($pdo, $student_number);
	$q = "update product set submit_time = '$submit_time', desciption = '$txtarea' where homework_id = $homework_id and student_id = $student_id ";
	$affect_rows = $pdo->exec($q);
	if($affect_rows==1){ 
		 $product_id = get_product_id($pdo, $homework_id, $student_id);
		 for ($i = 0; $i < count($product_attach_files['name']); $i++) {         //count($product_attach_files['name'])能够计算出上传文件的个数
    	$time = date('YmdHis',time());  //时间戳 
    	$product_attach_files_name =  $product_attach_files['name'][$i];
        if(move_uploaded_file($product_attach_files['tmp_name'][$i], "../../upload/product/".$time.$product_attach_files_name)){
            $sql_name = "../../upload/product/".$time.$product_attach_files_name;
            $q = "insert into product_attach_file(attach_file,product_id) values('$sql_name',$product_id)";
            //echo $q;
            //echo $q;
            $affect_rows = $pdo -> exec($q);
            if ($affect_rows != 1) 
            	return false;

        }else
        	return false;
      	   
	   }

	   
    }else
        return false;
    
return 1;



	
}
//上传product文件
function uplaod_product_file($pdo, $product_id, $product_attach_files)
{
	for ($i = 0; $i < count($product_attach_files['name']); $i++) {         //count($product_attach_files['name'])能够计算出上传文件的个数
    	$time = date('YmdHis', time());  //时间戳 
    	$product_attach_files_name = iconv("UTF-8","gb2312", $product_attach_files['name'][$i]);
        if(move_uploaded_file($product_attach_files['tmp_name'][$i], "../../upload/product/".$time)){
            $sql_name = "../../upload/product/".$time;
            $q = "insert into product_attach_file(attach_file,product_id) values('$sql_name',$product_id)";
            echo $q;
            $affect_rows = $pdo -> exec($q);
            if ($affect_rows != 1) 
            	return false;
        }else
        	return false;
      	   
    }
    return true;
}
//通过学号获取学生id
function get_student_id($pdo, $student_number)
{
	  $q = "select id from student_info where student_number='$student_number'";
	  $r = $pdo -> query($q);
	  $student_id = $r->fetchColumn(0);
	  return $student_id;
}
//通过学生id获取学生姓名
function get_student_name($pdo, $student_id)
{
	  $q = "select name from student_info where id='$student_id'";
	  $r = $pdo -> query($q);
	  $name = $r->fetchColumn(0);
	  return $name;
}
//通过学生id获取学生学号
function get_student_number($pdo, $student_id)
{
	  $q = "select student_number from student_info where id='$student_id'";
	  $r = $pdo -> query($q);
	  $student_number = $r->fetchColumn(0);
	  return $student_number;
}
//通过学生id获取学生邮箱
function get_student_mail($pdo, $student_id)
{
	  $q = "select email from student_info where id='$student_id'";
	  $r = $pdo -> query($q);
	  $email = $r->fetchColumn(0);
	  return $email;
}
//通过学生id获取学生班级
function get_student_class($pdo, $student_id)
{
	  $q = "select class from student_info where id='$student_id'";
	  $r = $pdo -> query($q);
	  $class = $r->fetchColumn(0);
	  return $class;
}
//通过学生id获取学生信息
function sel_student_info_id($pdo, $user_id)	
{
	$q = "select * from student_info where id = $user_id";
	$res = $pdo -> query($q);
	return $res;

}
function get_product_id($pdo, $homework_id, $student_id)
{
	  $q = "select id from product where homework_id = $homework_id and student_id = $student_id";
	  $r = $pdo -> query($q);
	  $id = $r->fetchColumn(0);
	  return $id;
}
//获取学生作品详细信息
function get_student_product_info($pdo, $student_number, $homework_id)
{
	$student_id = get_student_id($pdo, $student_number);
	$q = "select * from product where student_id = $student_id and homework_id = $homework_id where submit_time != null;";
	$res = $pdo -> prepare($q);
	$res -> execute();
	return $res;
}
//通过学生id获取学生作品详细信息
function get_student_product_info_id($pdo, $student_id, $homework_id)
{
	$q = "select * from product where student_id = $student_id and homework_id = $homework_id";
	$res = $pdo -> prepare($q);
	$res -> execute();
	return $res;
}
//获取学生作品已经评分的详细信息
function get_student_product_hava_score_info($pdo, $student_number, $homework_id)
{
	$student_id = get_student_id($pdo, $student_number);
	$q = "select * from product where student_id = $student_id and homework_id = $homework_id ";
	$res = $pdo -> prepare($q);
	$res -> execute();
	return $res;
}

function get_complete_homeword_info($pdo,$teacher_number)
{
	$arr_product = array();
	$arr = array();
	$q = "select * from homework where teacher_number = '$teacher_number' ";
	$res = $pdo -> prepare($q);
	$res -> execute();
	if($res -> rowCount() > 0){
		foreach ($res as $row) {

			$homework_id = $row['id'];
			$homework_title = $row['homework_title'];
			$class = $row['class'];
			$complete_time = $row['complete_time'];
			$q_product = "select * from product where homework_id = '$homework_id'  ";
			$res_product = $pdo -> prepare($q_product); 
			$res_product -> execute();
			foreach ($res_product as $row_product) {
				if ($row_product['submit_time'] != null && $row_product['score'] == null) {
					$submit_time = $row_product['submit_time'];
					$student_name = get_student_name($pdo, $row_product['student_id']);
					$desciption = $row_product['desciption'];
					$arr_product[] = $row_product['id'];
					$arr_product[] = $homework_id;
					$arr_product[] = $row_product['student_id'];
					$arr_product[] = $homework_title;
					$arr_product[] = $complete_time;
					$arr_product[] = $class;
					$arr_product[] = $student_name;
					$arr_product[] = $submit_time;
					$arr_product[] = $row_product['desciption'];
					$arr_product[] = $row_product['score'];
					$arr_product[] = $row_product['comments'];
					$arr[] = $arr_product;
					$arr_product = array();
				}
				

			}
			
			

		}
		return $arr;
	}
	
}
function get_complete_score_homeword_info($pdo,$teacher_number)
{
	$arr_product = array();
	$arr = array();
	$q = "select * from homework where teacher_number = '$teacher_number' ";
	$res = $pdo -> prepare($q);
	$res -> execute();
	if($res -> rowCount() > 0){
		foreach ($res as $row) {

			$homework_id = $row['id'];
			$homework_title = $row['homework_title'];
			$class = $row['class'];
			$complete_time = $row['complete_time'];
			$q_product = "select * from product where homework_id = '$homework_id' ";
			$res_product = $pdo -> prepare($q_product); 
			$res_product -> execute();
			foreach ($res_product as $row_product) {
				if ($row_product['score'] != null) {
					$submit_time = $row_product['submit_time'];
					$student_name = get_student_name($pdo, $row_product['student_id']);
					$desciption = $row_product['desciption'];
					$arr_product[] = $row_product['id'];
					$arr_product[] = $homework_id;
					$arr_product[] = $row_product['student_id'];
					$arr_product[] = $homework_title;
					$arr_product[] = $complete_time;
					$arr_product[] = $class;
					$arr_product[] = $student_name;
					$arr_product[] = $submit_time;
					$arr_product[] = $row_product['desciption'];
					$arr_product[] = $row_product['score'];
					$arr_product[] = $row_product['comments'];
					$arr[] = $arr_product;
					$arr_product = array();

				}
				

			}
			
			

		}
		return $arr;
	}
	
}
function teacher_score_product($pdo, $product_id, $score, $comments)
{
	$q = "update product set score = '$score', comments = '$comments' where id = '$product_id' ";
	$res = $pdo -> prepare($q);
	$res -> execute();
	if($res -> rowCount() == 1)
		return 1;
	else 
		return 0;

}
// function myGBsubstr($string, $start, $length)
// {
// 	if(strlen($string) > $length)
// 	{
// 		$str = null;
// 		$len = 0;
// 		$i = 
// 	}
// }
//评论
function student_comment($pdo, $product_id, $student_id, $comment)
{
	$ct = date("y-m-d H:i:s",time());
	$q = "insert into comments(product_id, student_id, comments, created_at) values('$product_id', '$student_id', '$comment', '$ct')";
	$affect_rows = $pdo -> exec($q);

	if($affect_rows == 1)
		return 1;
	else 
		return 0;
}
function get_product_comment($pdo, $product_id)
{
	$q = "select * from comments where product_id = '$product_id' order by id desc ";
	$res = $pdo -> query($q);
	return $res;
}
function get_other_product_info($pdo, $homework_id, $student_id)
{
	$q = "select * from product where homework_id = '$homework_id' and student_id != '$student_id' and submit_time is not null ";
	$res = $pdo -> query($q);
	return $res;
}
function sel_comments_info($pdo)
{
	$q = "select * from comments order by id desc";
	$res = $pdo -> query($q);
	return $res;
}
function sel_teacher_homework_info($pdo)
{
	$q = "select * from homework order by id desc";
	$res = $pdo -> query($q);
	return $res;
}
function teacher_homework_search($pdo, $homework_title)	
{
	$q = "select * from homework where homework_title like '%$homework_title%'";
	$res = $pdo -> query($q);
	return $res;
}
function sel_product_info($pdo)
{
	$q = "select * from product order by id desc";
	$res = $pdo -> query($q);
	return $res;
}
function product_search($pdo, $desciption)	
{
	$q = "select * from product where desciption like '%$desciption%'";
	$res = $pdo -> query($q);
	return $res;
}
function sel_teacher_homework_not_submit($pdo)
{
	$res_arr = array();
	$teacher_number = $_COOKIE['teacher_number'];
	$q = "select id from homework where teacher_number = '$teacher_number'";
	$r = $pdo -> query($q);
	foreach ($r as $value) {
		$homework_id = $value['id'];
		$q1 = "select * from product where homework_id = '$homework_id' and submit_time is null";
		$res = $pdo -> query($q1);
		$res_arr[] = $res; 
	}
	
	
	return $res_arr;
}