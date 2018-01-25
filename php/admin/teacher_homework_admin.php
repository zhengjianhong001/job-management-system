<?php 
require_once '../../model/functions.php';
require_once '../../mysql_connect.php';
if(isset($_GET['action']) && $_GET['action']=='del'){
    if(del_teacher_homeowrk($pdo,$_GET['user_id'])=='y'){
        echo "<script>alert('删除成功！');</script>";
    }else{
         echo "<script>alert('删除失败！');</script>";
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
    <input type="text" name="username" id="username" class="abc input-default" placeholder="请输入课题名称或部分字符" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>id</th>
        <th>课题</th>
        <th>内容</th>
        <th>班级</th>
        <th>教师工号</th>
        <th>创建时间</th>
        <th>课题完成时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 处理表单
                    $username=$_POST['username'];
                    if(!empty($username)){
                        $user_search_res=teacher_homework_search($pdo,$username);foreach($user_search_res as $row){?>
        <tr>
            <td style="text-align: center;"><?php echo $row['id']; ?></td>
            <td style="text-align: center;"><?php echo $row['homework_title']; ?></td>
            <td style="width: 400px;text-align: center;"><?php echo $row['content']; ?></td>
            <td style="text-align: center;"><?php echo $row['class']; ?></td>
            <td style="text-align: center;width: 80px;"><?php echo $row['teacher_number']; ?></td>
            <td style="text-align: center;width: 140px;"><?php echo $row['created_at']; ?></td>
            <td style="text-align: center;width: 140px;"><?php echo $row['complete_time']; ?></td>
            <td style="text-align: center;width: 50px;">
                <a href="teacher_homework_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>	
         <?php } ?>
</table>
                   <?php }

                }else{
     ?>
     <?php  $res=sel_teacher_homework_info($pdo); foreach($res as $row){ ?>
	     <tr>
            <td style="text-align: center;"><?php echo $row['id']; ?></td>
            <td style="text-align: center;"><?php echo $row['homework_title']; ?></td>
            <td style="width: 400px;text-align: center;"><?php echo $row['content']; ?></td>
            <td style="text-align: center;"><?php echo $row['class']; ?></td>
            <td style="text-align: center;width: 80px;"><?php echo $row['teacher_number']; ?></td>
            <td style="text-align: center;width: 140px;"><?php echo $row['created_at']; ?></td>
            <td style="text-align: center;width: 140px;"><?php echo $row['complete_time']; ?></td>
            <td style="text-align: center;width: 50px;">
                <a href="teacher_homework_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>	
         <?php } ?>
</table>
<?php } ?>
</body>
</html>
