<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2132" />  
  <link href="css/main.css" type="text/css" rel="stylesheet"/>
  <script src="js/jquery.js" ></script>
  <script src="js/function.js" charset="utf-8"></script>
  <head/>
  <body >
    <!--ҳ������-->
    <div id="sidebar">
	  <div id="header">
	  <?php
        include_once('header.php');	  
	    head(); 
	  ?>
	  </div>
	<!--���ർ��-->
      <div id="nav">
	    <ul>
		 <?php
		 include_once('cate_list.php');
		 cate_list();
		 ?>
	    </ul>
      </div>
	<!--��ǩ����-->  
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
	<!--������������-->  
	<div id="content">
	  <div class="article_content">
	    <!--�����б�-->
	    <?php
		include_once('show_article.php');
        $postid=$_GET['postid'];
		show_article($postid);
		?>
        <a href="#" style="background-color:white;border-radius:5px;position:absolute;right:10px;top:5px;color:black;padding:5px;">����</a>		
        <!--���۸�ƪ����-->
		<div id="add_commend_area" style="display:none;" >
		  <form action="add_commend.php?postid=<?php $postid=$_GET['postid'];echo $postid;?>" method="post">
		    <p class="yourname">����ǳ�:</p><input size="60" name="yourname" placeholder="��������30�������ַ���60���������ַ�"/><br/>
			<p class="youremail">�������:</p><input size="60" name="youremail"  placeholder="����д������䣬���ڰ�����ǳ�"/>
			<p class="yourtouxiang" >ѡ��һ��ͷ�񣨿�ѡ����</p>
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
			<textarea rows="8" cols="100" name="commend_body" placeholder="�������������뷢������ۣ��������ۣ��ܾ�á��~" style="display:block;"></textarea>
			<button type="submit">����</button>
			</div>		
		  </form> 
	  </div>
	  <!--��ƪ���µ�����-->
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
