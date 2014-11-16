<!DOCTYPE html>
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=gb2132" />  
  <link href="css/main.css" type="text/css" rel="stylesheet"/>
  <head/>
  <body>
    
    <div id="sidebar">
	  <div id="header">
      <a href="index.php"><h2>品漫</h2></a>
	  <p>一个专注于写漫评的博客</p>
	  </div>
      <div id="nav">
	    <?php
		  include_once('cate_list.php');
		  cate_list(); 
		?>
      </div>
      <div id="tags">
	    <ul>
	     <?php
		 include_once('tags_list.php');
		 tags_list();
		 ?>
		 
		 <div class="clearfix"></div>
	    </ul>
      </div>	  
	</div>
	<div id="content">
	  <div class="juzhong">
	  <?php 
	  include_once('article_list.php');
	  @$db=connect();
      if(isset($_GET['cate'])){
         $cate=$_GET['cate'];
         }
	  if(isset($_GET['tag'])){
	     $tag=$_GET['tag'];
		 }
	  if(isset($cate)){article_list($db,$cate,null);}
	  else if(isset($tag)){article_list($db,null,$tag);}
	  else{article_list($db);}
	  ?>	  
	  <div class="clearfix"></div>
	  
	  </div>
	  <div class="pager">
	    <ul>
		  <li class="prev">上一页</li>
		  <li class="page_num">1</li>
		  <li class="page_num">2</li>
		  <li class="next">下一页</li>		  
		</ul>
	  </div>
	</div>
	
	<div class="clearfix"></div>
  </body>
</html>

