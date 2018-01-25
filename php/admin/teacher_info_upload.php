<?php
  header( 'Content-Type:text/html;charset=utf-8 ');
  require_once '../../simplexlsx/simplexlsx.class.php';
  require_once '../../model/functions.php';
  require_once '../../mysql_connect.php';
  ?>
<div style="margin:20px;">
  <form action="" method="post" enctype="multipart/form-data">
        <h1>教师信息上传：</h1>
        <input type="file" accept=".csv,.xlsx"   id="file" name="upload_file">
        <input type="submit" name="submit" id="submitButton">
    </form>
</div>
  <?php
  if ($_SERVER['REQUEST_METHOD']=='POST') {
    if ($_FILES['upload_file']['name'] != "") {
        $num = 0;
        $file_path = $_FILES['upload_file']['tmp_name'];
        //echo $file_path;
        //$content = file_get_contents($file_path);
        $file_info = pathinfo($_FILES['upload_file']['name']);

        if($file_info['extension'] != 'xlsx' && $file_info['extension'] != 'csv'){
            echo 'It is not a vaild file.';
            return;
        }
        //读取xlsx文件
        if ( $xlsx = SimpleXLSX::parse($file_path) ) {
          // echo "<pre>";
          // print_r( $xlsx->rows() );
          // echo "</pre>";
            $teacher_arr = $xlsx->rows();
            if($teacher_arr[0][0] == "工号"){
                for($i = 1;$i<count($teacher_arr);$i++){                 
                    $res = insert_teacher_info($pdo,$teacher_arr[$i]);
                    if($res == 1)
                        $num++;
                }
                if($num>0)
                    echo "<h2 style='color:red;'>上传成功！</p>";
                echo "<p style='color:red'>上传成功人数（".$num."）</p>";
            }else
            echo "<h3 style='color:red;'>请上传正确的教师信息！</h3>";
            
        } else {
          echo SimpleXLSX::parse_error();
        }   





	}
}

?>

	
   

