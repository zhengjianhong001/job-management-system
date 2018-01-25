<?php 
require '../mysql_connect.php';
require '../model/functions.php';

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {   // 处理表单
 	if (isset($_POST['login_submit'])) {

        $role = $_POST['role'];
 		$student_number = $_POST['student_number'];
        $passwd = $_POST['p'];

        if($role == "student")
        {
            if( user_student_login($pdo,"student_info",$student_number,$passwd) ){
                setcookie('student_number',$_POST['student_number']);    
                setcookie('role',$_POST['role']);    
                //echo "<script>alert('登录成功');window.location.href='student_index.php';</script>";
                echo "<script>window.location.href='student_index.php';</script>";
            } else
                echo "<script>alert('输入信息错误，登录失败');</script>";

        } elseif ($role == "teacher") {
            if( user_teacher_login($pdo,"teacher_info",$student_number,$passwd) ){
                setcookie('teacher_number',$_POST['student_number']);    
                setcookie('role',$_POST['role']);    
                echo "<script>window.location.href='teacher_index.php';</script>";
            }else 
                echo "<script>alert('输入信息错误，登录失败');</script>";
        }elseif ($role == "adminer") {
            if( user_admin_login($pdo,"admin_info",$student_number,$passwd) ){
                setcookie('admin_name',$_POST['student_number']);    
                setcookie('role',$_POST['role']);    
                echo "<script>window.location.href='admin_index.php';</script>";
            }else
                echo "<script>alert('输入信息错误，登录失败');</script>";
        }
            
    }elseif (isset($_POST['get_password'])) {

        $email = $_POST['email'];
        $password = email_checked($pdo,$email);
        if( $password != 0 )
        {
            sendmail($email,'user','密码找回','您的密码为'.$password."，请妥善保管！");
            echo "<script>alert('密码已经发送到你的邮箱，请到邮箱查看！');</script>";
        }
        else
            echo "<script>alert('邮箱不存在');</script>";
    }
        
}

include_once '../views/login.html.php';
