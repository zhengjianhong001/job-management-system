<?php 
require_once '../../model/functions.php';
require_once '../../mysql_connect.php';
if(isset($_GET['action']) && $_GET['action']=='del'){
    if(del_student($pdo,$_GET['user_id'])=='y'){
        echo "<script>alert('删除用户成功！');</script>";
    }else{
         echo "<script>alert('删除用户失败！');</script>";
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
        .table thead tr th{
            text-align: center;
        }
    </style>
</head>
<body>
<form class="form-inline definewidth m20" action="" method="post">    
    学生名称：
    <input type="text" name="username" id="username" class="abc input-default" placeholder="请输入学生名或部分字符" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>学生id</th>
        <th>学生名称</th>
        <th>学号</th>
        <th>密码</th>
        <th>邮箱</th>
        <th>联系电话</th>
        <th>班级</th>
        <th>注册时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 处理表单
                    $username=$_POST['username'];
                    if(!empty($username)){
                        $user_search_res=student_search($pdo,$username);foreach($user_search_res as $row){?>
                        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['student_number']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit_student.php?user_id=<?php echo $row['id']; ?>">编辑</a>
                <a href="student_info_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>   
         <?php } ?>
</table>
                   <?php }

                }else{
     ?>
     <?php  $res=sel_student_info($pdo); foreach($res as $row){ ?>
	     <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['student_number']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
                <a href="edit_student.php?user_id=<?php echo $row['id']; ?>">编辑</a>
                <a href="student_info_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>	
         <?php } ?>
</table>
<?php } ?>
</body>
</html>
