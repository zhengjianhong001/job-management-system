<?php 
require_once '../../model/functions.php';
require_once '../../mysql_connect.php';
if(isset($_GET['action']) && $_GET['action']=='del'){
    if(del_comments($pdo,$_GET['user_id'])=='y'){
        echo "<script>alert('删除评论成功！');</script>";
    }else{
         echo "<script>alert('删除评论失败！');</script>";
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
<table class="table table-bordered table-hover definewidth m10">
    <thead>
    <tr>
        <th>id</th>
        <th>作品id</th>
        <th>学生姓名</th>
        <th>评论内容</th>
        <th>评论时间</th>
        <th>操作</th>
    </tr>
    </thead>
     <?php  $res = sel_comments_info($pdo); foreach($res as $row){ ?>
	     <tr class="content">
            <td style="text-align: center;"><?php echo $row['id']; ?></td>
            <td style="text-align: center;"><?php echo $row['product_id']; ?></td>
            <td style="text-align: center;"><?php echo get_student_name($pdo, $row['student_id']); ?></td>
            <td style="text-align: center;"><?php echo $row['comments']; ?></td>
            <td style="text-align: center;"><?php echo $row['created_at']; ?></td>
            <td style="text-align: center;">
                <a href="comments_admin.php?action=del&user_id=<?php echo $row['id'];  ?>" >删除</a>                    
            </td>
        </tr>	
         <?php } ?>
</table>

</body>
</html>
