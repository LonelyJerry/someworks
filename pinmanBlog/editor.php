<!DOCTYPE HTML>
<html>

<head>
<link rel="stylesheet" type="text/css" href="css/editor.css">
<title>仪盘表</title>
</head>
<body>
<div class="center">
    <ul class="tabs">
        <li><input type="radio" name="tabs" id="tab1" checked /><label id="l1"for="tab1">添加文章</label>
         <div id="tab-content1" class="tab-content">
         <form action="add_article.php" method="post" enctype="multipart/form-data">
         <div class="add_title"><span>标题：</span><input type="text" name="title" size="60"/></div>
		 <div class="add_author">
         <span>作者：</span><input type="text" name="author" size="60"/>
		 </div>
         <p>摘要:</p>
         <textarea rows="5" cols="60" name="description"></textarea>
         <br/> 
        分类：
         <select name="group">
         <option value="fight">热血战斗</option>
         <option value="sports">体育竞技</option>
         <option value="detective">推理斗智</option>
         <option value="funny">搞怪爆笑</option>
         <option value="love">青春恋爱</option>
         </select>
         <br/>
         上传封面:<input type="file" name="cover" size="30">
         <br/>
         <p>正文:</p>
         <textarea name="body" rows="10" cols="60"></textarea>
         <br/>
         添加标签(可选):
         <?php
         include_once('conn.php');
         $db=connect();
         $query='select * from tag';
         $result=$db->query($query);
         $num_result=$result->num_rows;
         for($i=0;$i<$num_result;$i++){
           $row=$result->fetch_assoc();
           echo "<input type='checkbox' name='tags[]' value='".$row['name']."'/>".$row['name'];
        }
        ?>
        <br/>
        <input class="article_submit" type="submit" name="article_submit" value="确认添加文章"/>
        </form>
		<div class="new_tag">
        <form action="add_tag.php" method="post">
          <span>新建标签(可选)：</span><input type="text" size="10" name="new_tag"/>
          <input type="submit" value="生成新标签"/>
        </form>
		</div>
		
        </div></li>
        <li><input type="radio" name="tabs" id="tab2" ><label id="l2 "for="tab2">文章管理</label>
         <div id="tab-content2" class="tab-content">
		 <?php
		 include_once('editor_article_list.php');
         editor_article_list();
	     ?>	  
	  <div class="clearfix"></div>
        </div></li>
		
        <li><input type="radio" name="tabs" id="tab3" ><label id="l3" for="tab3">标签管理</label>    
	     <div id="tab-content3" class="tab-content">
		 <div id="tags">
		 <ul>
	     <?php
		 include_once('editor_tags_list.php');
	     @$db=connect();
		 editor_tags_list($db);
		 ?>
		 </ul>
		 </div>
		 <div class="clearfix"></div>
         <form action="add_tag.php" method="post">
          <span>新建标签(可选)：</span><input type="text" size="10" name="new_tag"/>
          <input type="submit" value="生成新标签"/>
         </form>
		
        </div>
        </li>		
	   
    </ul>
</div>
</body>
</html>