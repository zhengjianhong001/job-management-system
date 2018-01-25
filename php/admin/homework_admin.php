<?php 
require_once '../../model/functions.php';
require_once '../../mysql_connect.php';
if(isset($_GET['action']) && $_GET['action']=='del'){
    if(del_product($pdo,$_GET['user_id'])=='y'){
        echo "<script>alert('删除作品成功！');</script>";
    }else{
         echo "<script>alert('删除作品失败！');</script>";
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
    <input type="text" name="username" id="username" class="abc input-default" placeholder="请输入作品简介或部分字符" value="">&nbsp;&nbsp;  
    <button type="submit" class="btn btn-primary">查询</button>
</form>
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>id</th>
        <th>课题名称</th>
        <th>学生姓名</th>
        <th>作品简介</th>
        <th>提交时间</th>
        <th>分数</th>
        <th>教师评语</th>
        <th>操作</th>
    </tr>
    </thead>
    <?php  if ($_SERVER['REQUEST_METHOD'] == 'POST') { // 处理表单
                    $username=$_POST['username'];
                    if(!empty($username)){
                        $user_search_res = product_search($pdo, $username);foreach($user_search_res as $row){?>
       <tr>
            <td style="text-align: center;width: 50px;"><?php echo $row['id']; ?></td>
            <td style="text-align: center;width: 80px;"><?php echo get_homework_title($pdo, $row['homework_id']); ?></td>
            <td style="text-align: center;width: 80px;"><?php echo get_student_name($pdo, $row['student_id']); ?></td>
            <td style="text-align: center;width: 300px"><?php if($row['desciption'] == null) echo "<p style='color:#888'>该学生未提交作品</p>"; else echo $row['desciption']; ?></td>
            <td style="text-align: center;width: 140px;"><?php  echo $row['submit_time']; ?></td>
            <td style="text-align: center;width: 60px;"><?php echo $row['score']; ?></td>
            <td style="text-align: center;"><?php echo $row['comments']; ?></td>
            <td style="text-align: center;width: 50px;">
                <a href="homework_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>	
         <?php } ?>
</table>
                   <?php }

                }else{
     ?>
     <?php  $res=sel_product_info($pdo); foreach($res as $row){ ?>
	     <tr>
            <td style="text-align: center;width: 50px;"><?php echo $row['id']; ?></td>
            <td style="text-align: center;width: 80px;"><?php echo get_homework_title($pdo, $row['homework_id']); ?></td>
            <td style="text-align: center;width: 80px;"><?php echo get_student_name($pdo, $row['student_id']); ?></td>
            <td style="text-align: center;width: 300px"><?php if($row['desciption'] == null) echo "<p style='color:#888'>该学生未提交作品</p>"; else echo $row['desciption']; ?></td>
            <td style="text-align: center;width: 140px;"><?php  echo $row['submit_time']; ?></td>
            <td style="text-align: center;width: 60px;"><?php echo $row['score']; ?></td>
            <td style="text-align: center;"><?php echo $row['comments']; ?></td>
            <td style="text-align: center;width: 50px;">
                <a href="homework_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
           
        </tr>	
         <?php } ?>
</table>
<?php } ?>
</body>
</html>
