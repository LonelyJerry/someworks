<?php
include_once('conn.php');//连接数据库
include('article_tag.php');//引入文章标签多对多关系反映模块
include('today_date.php');//引入日期输出模块

/*该函数的功能为显示文章列表，如果指定了分类，则根据分类按时间顺序显示分类下文章；
如果指定了标签，则根据标签按时间顺序显示标签相关文章；
如果均无指定，则按时间顺序显示最新文章*/    
function article_list($db,$cate=null,$tag=null){
  $img_address='img/';//指定文章封面所在文件夹为img
  //指定分类的情况下  
  if($cate){
    $query="select name from category where value='".$cate."'";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result==1){
	$row=$result->fetch_assoc();
	echo "<h1>分类:".$row['name']."</h1>";
	}
	today_date();
    $query="select * from header where cate='".$cate."' limit 6";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result>0){
      for($i=0;$i<$num_result;$i++){
        $row=$result->fetch_assoc();
	    echo "<div class='article'>";
	    echo "<img src='".$img_address.stripslashes($row['cover'])."'/>";
	    echo "<h1 class='title'><a target='_blank' href='article.php?postid=".$row['postid']."'>".stripslashes($row['title'])."</a></h1>";
	    echo "<p class='description'>".stripslashes($row['description'])."</p>";
	    echo "<p class='date'>".stripslashes($row['posted'])."</p>";
	    echo "<div class='tag'>";
	    echo "<span>标签:</span>";
	    article_tag($row['postid'],"span");
	    echo "</div>";
	    echo "</div>";
        if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }		
      }
	}
	//若该分类下无文章则反馈"该分类下暂无文章"
	else if($num_result<=0){
	    echo "<h2 style='margin:20px 0px 20px 0px;'>该分类下暂无文章</h2>";
	}
  }
  //指定标签的情况下
  else if($tag){
    $query="select name from tag where name='".$tag."'";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result==1){
	$row=$result->fetch_assoc();
	echo "<h1>标签:".$row['name']."</h1>";
	}
	today_date();
    $query="select header.cover,header.title,header.description,header.posted,header.postid 
	        from header,tag,article_tag where tag.name='".$tag."' and tag.tagid=article_tag.tagid and article_tag.postid=header.postid limit 6";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result>0){
      for($i=0;$i<$num_result;$i++){
        $row=$result->fetch_assoc();
	    echo "<div class='article'>";
	    echo "<img src='".$img_address.stripslashes($row['cover'])."'/>";
	    echo "<h1 class='title'><a target='_blank' href='article.php?postid=".$row['postid']."'>".stripslashes($row['title'])."</a></h1>";
	    echo "<p class='description'>".stripslashes($row['description'])."</p>";
	    echo "<p class='date'>".stripslashes($row['posted'])."</p>";
	    echo "<div class='tag'>";
	    echo "<span>标签:</span>";
	    article_tag($db,$row['postid'],"span");
	    echo "</div>";
	    echo "</div>";
        if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }		
      }
	}
	//若该标签下无文章则反馈"该标签下暂无文章"
	else if($num_result<=0){
	  echo "<h2 style='margin:20px 0px 20px 0px;'>该标签下暂无文章</h2>";
	}
  }
  //不指定标签也不指定分类的情况下
  else{
    echo "<h1>分类:所有漫评</h1>";
	today_date();
    $query="select * from header limit 6 ";
	$result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result>0){
    for($i=0;$i<$num_result;$i++){
      $row=$result->fetch_assoc();
	  echo "<div class='article'>";
	  echo "<img src='".$img_address.stripslashes($row['cover'])."'/>";
	  echo "<h1 class='title'><a target='_blank' href='article.php?postid=".$row['postid']."'>".stripslashes($row['title'])."</a></h1>";
	  echo "<p class='description'>".stripslashes($row['description'])."</p>";
	  echo "<p class='date'>".stripslashes($row['posted'])."</p>";
	  echo "<div class='tag'>";
	  echo "<span>标签:</span>";
      article_tag($db,$row['postid'],"span");
	  echo "</div>";
	  echo "</div>";
      if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }  		
	  }
	}
	//若尚无文章，则反馈"无文章"
    else if($num_result<=0){
	  echo "<h2 style='margin:20px 0px 20px 0px;'>该标签下暂无文章</h2>";
	}	
  }
}

  



?>