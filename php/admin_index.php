<?php 
if(isset($_GET['a']) && $_GET['a']==logout){
    setcookie('admin_name','',time()-3600);
    header("location: login.php");
}

if (!isset($_COOKIE['admin_name']) || $_COOKIE['admin_name']=='') {
header("location: login.php");

}

if (isset($_COOKIE['role']) && $_COOKIE['role'] != '') {

    if($_COOKIE['role'] != "adminer")
        header("location: login.php");
    }

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>校园课堂作品提交与互评系统-首页</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/main-min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/images/header.ico" type="image/x-icon" rel="shortcut icon" />
</head>
<body>

<div class="header">
    <div class="dl-title">
        <!-- <img src="../assets/images/logoko.png"> -->
        <h1>校园课堂作品提交与互评系统——系统管理员</h1>
    </div>
    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo "系统管理员: ".$_COOKIE['admin_name']; ?></span><a href="admin_index.php?a=logout" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">系统管理</div></li>		
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script type="text/javascript" src="../assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="../assets/js/bui-min.js"></script>
<script type="text/javascript" src="../assets/js/main-min.js"></script>
<script type="text/javascript" src="../assets/js/config-min.js"></script>
<script>
    BUI.use('main',function(){
        var config = [{id:'1',menu:[{text:'系统管理',items:[{id:'12',text:'教师发布管理',href:'admin/teacher_homework_admin.php'},{id:'3',text:'学生作品管理',href:'admin/homework_admin.php'},{id:'4',text:'学生评论管理',href:'admin/comments_admin.php'}]},{text:'学生管理',items:[{id:'13',text:'学生信息管理',href:'admin/student_info_admin.php'},{id:'14',text:'学生信息上传',href:'admin/student_info_upload.php'}]},{text:'教师管理',items:[{id:'15',text:'教师信息管理',href:'admin/teacher_info_admin.php'},{id:'16',text:'教师信息上传',href:'admin/teacher_info_upload.php'}]}]},{id:'7',homePage : '9'}];
        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</body>
</html>