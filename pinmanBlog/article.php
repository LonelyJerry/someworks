<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2132" />  
  <link href="css/main.css" type="text/css" rel="stylesheet"/>
  <script src="js/jquery.js" ></script>
  <script src="js/function.js" charset="utf-8"></script>
  <head/>
  <body >
    <!--页面侧边栏-->
    <div id="sidebar">
	  <div id="header">
	  <?php
        include_once('header.php');	  
	    head(); 
	  ?>
	  </div>
	<!--分类导航-->
      <div id="nav">
	    <ul>
		 <?php
		 include_once('cate_list.php');
		 cate_list();
		 ?>
	    </ul>
      </div>
	<!--标签导航-->  
      <div id="tags">
	    <ul>
	     <?php
		 include_once('tags_list.php');
	     @$db=connect();
		 tags_list($db);
		 ?>
		 <div class="clearfix"></div>
	    </ul>
      </div>	  
	</div>
	<!--文章主体内容-->  
	<div id="content">
	  <div class="article_content">
	    <!--文章列表-->
	    <?php
		include_once('show_article.php');
        $postid=$_GET['postid'];
		show_article($postid);
		?>
        <a href="#" style="background-color:white;border-radius:5px;position:absolute;right:10px;top:5px;color:black;padding:5px;">返回</a>		
        <!--评论该篇文章-->
		<div id="add_commend_area" style="display:none;" >
		  <form action="add_commend.php?postid=<?php $postid=$_GET['postid'];echo $postid;?>" method="post">
		    <p class="yourname">你的昵称:</p><input size="60" name="yourname" placeholder="最多可输入30个中文字符或60个非中文字符"/><br/>
			<p class="youremail">你的邮箱:</p><input size="60" name="youremail"  placeholder="请填写你的邮箱，用于绑定你的昵称"/>
			<p class="yourtouxiang" >选择一个头像（可选）：</p>
			<label for="lufei"><img class="choose_touxiang" src="img/lufei.jpg"  /></label>
			<input type="radio" id="lufei" class="touxiang_radio" name="icon" value="lufei"/>
			<label for="qiya"><img class="choose_touxiang" src="img/qiya.jpg" /></label>
			<input type="radio" id="qiya" class="touxiang_radio" name="icon" value="qiya"/>
			<label for="mingren"><img class="choose_touxiang" src="img/mingren.jpg"  /></label>
			<input type="radio" id="mingren" class="touxiang_radio" name="icon" value="mingren"/>
			<label for="gang"><img class="choose_touxiang" src="img/gang.jpg"  /></label>
			<input type="radio" id="gang" class="touxiang_radio" name="icon" value="gang"/>
			<label for="heizi"><img class="choose_touxiang" src="img/heizi.jpg"  /></label>
			<input type="radio" id="heizi" class="touxiang_radio" name="icon" value="heizi"/>
			<div class="text">
			<textarea rows="8" cols="100" name="commend_body" placeholder="在这里输入你想发表的评论，文明讨论，拒绝谩骂~" style="display:block;"></textarea>
			<button type="submit">发表</button>
			</div>		
		  </form> 
	  </div>
	  <!--该篇文章的评论-->
	  <div id="commend_area" >
		 <?php 
		    include_once('show_commend_for_article.php');
			$postid=$_GET['postid'];
            show_commend_for_article($postid);
		  ?> 
        </div>
	</div>
	
  </body>
</html>
