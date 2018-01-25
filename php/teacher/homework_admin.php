<?php
require '../../mysql_connect.php';
require('../../model/functions.php');


?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css" />
    <script type="text/javascript" src="../../assets/js/jquery.js"></script>
    <script type="text/javascript" src="../../assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../assets/js/ckform.js"></script>
    <script type="text/javascript" src="../../assets/js/common.js"></script>

	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style type="text/css">
		/* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
		/* =========
		Get Fonts */
		@import url(css/familyQuicksand.css);
		@import url(css/font-awesome.css);
		/* ================
		   Assign Variables */
		/* ===========================
		   Setup Mixins/Helper Classes */
		.clearfix:after, .container:after, .tab-nav:after {
		  content: ".";
		  display: block;
		  height: 0;
		  clear: both;
		  visibility: hidden;
		}

		/* ==========
		   Setup Page */
		*, *:before, *:after {
		  box-sizing: border-box;
		}

		body {
		  font-family: 'Quicksand', sans-serif;
		}

		/* =================
		   Container Styling */
		.container {
		  position: relative;
		  background: white;
		  padding: 3em;
		}

		/* ===========
		   Tab Styling */
		.tab-group {
		  position: relative;
		  border: 1px solid #eee;
		  margin-top: 2.5em;
		  border-radius: 0 0 10px 10px;
		}
		.tab-group section {
		  opacity: 0;
		  height: 0;
		  padding: 0 1em;
		  overflow: hidden;
		  transition: opacity 0.4s ease, height 0.4s ease;
		}
		.tab-group section.active {
		  opacity: 1;
		  height: auto;
		  overflow: visible;
		}

		.tab-nav {
		  list-style: none;
		  margin: -2.5em -1px 0 0;
		  padding: 0;
		  height: 2.5em;
		  overflow: hidden;
		}
		.tab-nav li {
		  display: inline;
		}
		.tab-nav li a {
		  top: 1px;
		  position: relative;
		  display: block;
		  float: left;
		  border-radius: 10px 10px 0 0;
		  background: #eee;
		  line-height: 2em;
		  padding: 0 1em;
		  text-decoration: none;
		  color: grey;
		  margin-top: .5em;
		  margin-right: 1px;
		  transition: background .2s ease, line-height .2s ease, margin .2s ease;
		}
		.tab-nav li.active a {
		  background: #6EB590;
		  color: white;
		  line-height: 2.5em;
		  margin-top: 0;
		}
		.pricingTable{
	    text-align: center;
	}
	.pricingTable .pricingTable-header{
	    padding: 30px 0;
	    background: #4d4d4d;
	    position: relative;
	    transition: all 0.3s ease 0s;
	}
	.pricingTable:hover .pricingTable-header{
	    background: #09b2c6;
	}
	.pricingTable .pricingTable-header:before,
	.pricingTable .pricingTable-header:after{
	    content: "";
	    width: 16px;
	    height: 16px;
	    border-radius: 50%;
	    border: 1px solid #d9d9d8;
	    position: absolute;
	    bottom: 12px;
	}
	.pricingTable .pricingTable-header:before{
	    left: 40px;
	}
	.pricingTable .pricingTable-header:after{
	    right: 40px;
	}
	.pricingTable .heading{
	    font-size: 20px;
	    color: #fff;
	    text-transform: uppercase;
	    letter-spacing: 2px;
	    margin-top: 0;
	}
	.pricingTable .price-value{
	    display: inline-block;
	    position: relative;
	    font-size: 55px;
	    font-weight: bold;
	    color: #09b1c5;
	    transition: all 0.3s ease 0s;
	}
	.pricingTable:hover .price-value{
	    color: #fff;
	}
	.pricingTable .currency{
	    font-size: 30px;
	    font-weight: bold;
	    position: absolute;
	    top: 6px;
	    left: -19px;
	}
	.pricingTable .month{
	    font-size: 16px;
	    color: #fff;
	    position: absolute;
	    bottom: 15px;
	    right: -30px;
	    text-transform: uppercase;
	}
	.pricingTable .pricing-content{
	    padding-top: 50px;
	    background: #fff;
	    position: relative;
	}
	.pricingTable .pricing-content:before,
	.pricingTable .pricing-content:after{
	    content: "";
	    width: 16px;
	    height: 16px;
	    border-radius: 50%;
	    border: 1px solid #7c7c7c;
	    position: absolute;
	    top: 12px;
	}
	.pricingTable .pricing-content:before{
	    left: 40px;
	}
	.pricingTable .pricing-content:after{
	    right: 40px;
	}
	.pricingTable .pricing-content ul{
	    padding: 0 20px;
	    margin: 0;
	    list-style: none;
	}
	.pricingTable .pricing-content ul:before,
	.pricingTable .pricing-content ul:after{
	    content: "";
	    width: 8px;
	    height: 46px;
	    border-radius: 3px;
	    background: linear-gradient(to bottom,#818282 50%,#727373 50%);
	    position: absolute;
	    top: -22px;
	    z-index: 1;
	    box-shadow: 0 0 5px #707070;
	    transition: all 0.3s ease 0s;
	}
	.pricingTable:hover .pricing-content ul:before,
	.pricingTable:hover .pricing-content ul:after{
	    background: linear-gradient(to bottom, #40c4db 50%, #34bacc 50%);
	}
	.pricingTable .pricing-content ul:before{
	    left: 44px;
	}
	.pricingTable .pricing-content ul:after{
	    right: 44px;
	}
	.pricingTable .pricing-content ul li{
	    font-size: 15px;
	    font-weight: bold;
	    color: #777473;
	    padding: 10px 0;
	    border-bottom: 1px solid #d9d9d8;
	}
	.pricingTable .pricing-content ul li:last-child{
	    border-bottom: none;
	}
	.pricingTable .read{
	    display: inline-block;
	    font-size: 16px;
	    color: #fff;
	    text-transform: uppercase;
	    background: #d9d9d8;
	    padding: 8px 25px;
	    margin: 30px 0;
	    transition: all 0.3s ease 0s;
	}
	.pricingTable .read:hover{
	    text-decoration: none;
	}
	.pricingTable:hover .read{
	    background: #09b1c5;
	}
	@media screen and (max-width: 990px){
	    .pricingTable{ margin-bottom: 25px; }
	}

	</style>
	<script src="js/prefixfree.min.js"></script>
	<!--[if IE]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>	
		<div class="container" style="margin: -40px 10px 5px -15px">
		  <div class="tab-group">
		    <section id="tab1" title="待评分作品">
		    	<div class="row" style="margin: 10px 0 10px 0">
		    		<?php $res = get_complete_homeword_info($pdo,$_COOKIE['teacher_number']); if($res){ ?>
					<table class="table table-bordered table-hover definewidth m10">
					    <thead>
						    <tr>
						        <th>课题</th>
						        <th>截至上交日期</th>
						        <th>班级</th>
						        <th>学生</th>
						        <th>上交日期</th>
						        <th>操作</th>
						    </tr>
					    </thead>
					     <?php   foreach($res as $row){ ?>
						     <tr>
					            <td><?php echo $row[3]; ?></td>
					            <td><?php echo $row[4]; ?></td>
					            <td><?php echo $row[5]; ?></td>
					            <td><?php echo $row[6]; ?></td>
					            <td><?php echo $row[7]; ?></td>
					            <td>
					                <a href="score_product.php?product_id=<?php echo $row[0]; ?>&homework_id=<?php echo $row[1]; ?>&student_id=<?php echo $row[2]; ?>&submit_time=<?php echo $row[7]; ?>&desciption=<?php echo $row[8]; ?>">查看作品并评分</a>
					            </td>
					           
					        </tr>	
					         <?php } ?>
					</table>
					<?php }else echo "<p style='color:#888;font-size:25px;margin:10px;'>没有待评分作品</p>"; ?>
		        </div>
		    </section>
		    <section id="tab2" title="作品尚未交学生">
		    	<div class="row" style="margin: 10px 0 0 0">
			    	<table class="table table-bordered table-hover definewidth m10">
						    <thead>
							    <tr>
							        <th>课题</th>
							        <th>截至上交日期</th>
							        <th>班级</th>
							        <th>学号</th>
							        <th>学生</th>
							        <th>说明</th>
							    </tr>
						    </thead>
						     <?php $res = sel_teacher_homework_not_submit($pdo);
						     for($i=0;$i<count($res);$i++){
						     	foreach ($res[$i] as $row) {
						      //$res = sel_teacher_homework_not_submit($pdo);  foreach($res as $row){ ?>
							     <tr>
						            <td><?php echo get_homework_title($pdo, $row['homework_id']); ?></td>
						            <td><?php echo get_homework_complete_time($pdo, $row['homework_id']); ?></td>
						            <td><?php echo get_student_class($pdo, $row['student_id']); ?></td>
						            <td><?php echo get_student_number($pdo, $row['student_id']); ?></td>
						            <td><?php echo get_student_name($pdo, $row['student_id']); ?></td>
						            <td><?php echo "作品未上传"; ?></td>
						            
						        </tr>	
						         <?php }} ?>
						</table>
		        </div>
		    </section>
		    <section id="tab3" title="作品回顾">
		    	<div class="row" style="margin: 10px 0 10px 0">
		    		<?php  $res = get_complete_score_homeword_info($pdo,$_COOKIE['teacher_number']);if($res){ ?>
					<table class="table table-bordered table-hover definewidth m10">
					    <thead>
						    <tr>
						        <th>课题</th>
						        <th>截至上交日期</th>
						        <th>班级</th>
						        <th>学生</th>
						        <th>上交日期</th>
						        <th>操作</th>
						    </tr>
					    </thead>
					      <?php  $res = get_complete_score_homeword_info($pdo,$_COOKIE['teacher_number']); foreach($res as $row){ ?>
						     <tr>
					            <td><?php echo $row[3]; ?></td>
					            <td><?php echo $row[4]; ?></td>
					            <td><?php echo $row[5]; ?></td>
					            <td><?php echo $row[6]; ?></td>
					            <td><?php echo $row[7]; ?></td>
					            <td>
					                <a href="teacher_homework_info.php?product_id=<?php echo $row[0]; ?>&homework_id=<?php echo $row[1]; ?>&student_id=<?php echo $row[2]; ?>&submit_time=<?php echo $row[7]; ?>&desciption=<?php echo $row[8]; ?>&score=<?php echo $row[9]; ?>&comments=<?php echo $row[10]; ?>">查看作品</a>
					            </td>
					           
					        </tr>	
					         <?php } ?>
					</table>
					<?php }else echo "<h1 style='color:#888;'>没有完成的作品。</h1>"; ?>
		        </div>
		    </section>
		    
		  </div>
		</div>
		
	
	
	<script src="js/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
	<script type="text/javascript" src="js/jquery-tab.js"></script>
	<script type="text/javascript">
		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();
		})
	</script>
</body>
</html>