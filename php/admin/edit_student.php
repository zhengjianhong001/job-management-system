<?php 
require_once '../../model/functions.php';
require_once '../../mysql_connect.php';
 if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 处理表单
    $name=$_POST['username'];
    $student_number=$_POST['student_number'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $class=$_POST['class'];
    $password=$_POST['password'];
    if(empty($name) || empty($email)){
        echo "<script>alert('请完善表单');</script>";
    }else{
         admin_update_student_info($pdo,$name,$student_number,$class,$email,$phone,$password,$_GET['user_id']);
    }
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
    <script type="text/javascript" src="../../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../assets/js/ckform.js"></script>
    <script type="text/javascript" src="../../assets/js/common.js"></script>
    <style type="text/css">
        body {
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }

        @media (max-width: 980px) {
            /* Enable use of floated navbar text */
            .navbar-text.pull-right {
                float: none;
                padding-left: 5px;
                padding-right: 5px;
            }
        }


    </style>
</head>
<body>
<form action="edit_student.php?user_id=<?php echo $_GET['user_id']; ?>" method="post" class="definewidth m20">
    <table class="table table-bordered table-hover definewidth m10">
    <?php $res=sel_student_info_id($pdo,$_GET['user_id']); foreach($res as $row){  ?>
        <tr>
            <td width="10%" class="tableleft">姓名</td>
            <td><input type="text" name="username" value="<?php echo $row['name']; ?>"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">学号</td>
            <td><input type="text" name="student_number" value="<?php echo $row['student_number']; ?>"/></td>
        </tr>
        <tr>
            <td width="10%" class="tableleft">密码</td>
            <td><input type="text" name="password" value="<?php echo $row['password']; ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">邮箱</td>
            <td><input type="email" name="email" value="<?php echo $row['email']; ?>"/></td>
        </tr>
        
        <tr>
            <td class="tableleft">联系电话</td>
            <td><input type="text" value="<?php echo $row['phone'];  ?>" name="phone" /></td>
        </tr>
        <tr>
            <td class="tableleft">班级</td>
            <td><input type="text" value="<?php echo $row['class'];  ?>" name="class" /></td>
        </tr>
        <tr>
            <td class="tableleft">注册时间</td>
            <td><?php echo $row['created_at'];  ?></td>
        </tr>
        
        <tr>
            <td class="tableleft"></td>
            <td>
                <button type="submit" class="btn btn-primary" type="button">保存</button>				 &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
            </td>
        </tr>
        <?php } ?>
    </table>
</form>
</body>
</html>
<script>
    $(function () {       
		$('#backid').click(function(){
				window.location.href="student_info_admin.php";
		 });
    });
</script>