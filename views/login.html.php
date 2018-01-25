<?php 
$title = '校园课堂作品提交与互评系统-登录注册';
include_once '../views/layouts/login_header.html';
 ?>
      <!--登录-->
    <div class="web_qr_login" id="web_qr_login" style="<?php if(isset($_POST['get_password'])) echo "display: none;"; else echo "display: block;height: 305px;";  ?> " >    
        <div class="web_login" id="web_login">
            <div class="login-box">
    			<div class="login_form">
    				<form action="" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
                        <input type="hidden" name="did" value="0"/>
                        <input type="hidden" name="to" value="log"/>
                        <div class="uinArea" id="uinArea" style="margin-top: -15px;">
                            <label class="input-tips" for="u">角色：</label>
                            <div class="inputOuter" id="uArea">
                                <div style="line-height: 42px">
                                    <label><input name="role" type="radio" value="student" <?php if(isset($_POST['role']) && $_POST['role'] == 'student') echo "checked"; elseif(!isset($_POST['role'])) echo "checked"; ?> />学生 </label> 
                                    <label><input name="role" type="radio" value="teacher" <?php if(isset($_POST['role']) && $_POST['role'] == 'teacher') echo "checked";  ?> />教师 </label> 
                                    <label><input name="role" type="radio" value="adminer" <?php if(isset($_POST['role']) && $_POST['role'] == 'adminer') echo "checked";  ?> />管理员 </label>  
                                </div>                   
                            </div>
                        </div>
                        <div class="uinArea" id="uinArea">
                            <label class="input-tips" for="u">账号：</label>
                            <div class="inputOuter" id="uArea">
                                
                                <input type="text" id="u" placeholder="输入学号、工号" name="student_number" value="<?php if(isset($_POST['student_number'])) echo $_POST['student_number'];  ?>"  class="inputstyle"/>
                            </div>
                        </div>
                        <div class="pwdArea" id="pwdArea">
                            <label class="input-tips" for="p">密码：</label> 
                            <div class="inputOuter" id="pArea">
                                <input type="password" placeholder="输入密码" id="p" name="p" class="inputstyle"/>
                            </div>
                        </div>
                   
                        <div style="padding-left:50px;margin-top:20px;"><input type="submit" name="login_submit" value="登 录" style="width:150px;" class="button_blue"/></div>
                  </form>
               </div>
            </div>
        </div>
    </div>
    <!--登录end-->
     <!--找回密码-->
    <div class="qlogin" id="qlogin" style="<?php if(isset($_POST['get_password'])) echo "display: block;";else echo "display: none;"; ?>">
   
    <div class="web_login"><form name="form2" id="regUser" accept-charset="utf-8"  action="" method="post">
          <input type="hidden" name="to" value="reg"/>
                           <input type="hidden" name="did" value="0"/>
        <ul style="margin-top: 20px;" class="reg_form" id="reg-ul">
<!--                 <div id="userCue" class="cue">快速找回密码请注意格式</div>
 -->                <li>
                 <label for="qq" class="input-tips2">邮箱账号：</label>
                    <div class="inputOuter2">
                        <input type="text" id="qq" name="email" maxlength="50" class="inputstyle2"/>
                    </div>
                   
                </li>
                
                <li>
                    <div class="inputArea">
                        <input type="submit" id="reg" name="get_password"  style="margin-top:10px;margin-left:85px;width: 150px;" class="button_blue" value="确定"/> 
                    </div>
                    
                </li><div class="cl"></div>
            </ul></form>
           
    
    </div>
   
    
    </div>
    <!--找回密码end-->

<?php 
include_once '../views/layouts/login_footer.html';
 ?>
