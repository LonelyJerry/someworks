<?php
include_once('conn.php');//�������ݿ�
include('article_tag.php');//�������±�ǩ��Զ��ϵ��ӳģ��
include('today_date.php');//�����������ģ��

/*�ú����Ĺ���Ϊ��ʾ�����б����ָ���˷��࣬����ݷ��ఴʱ��˳����ʾ���������£�
���ָ���˱�ǩ������ݱ�ǩ��ʱ��˳����ʾ��ǩ������£�
�������ָ������ʱ��˳����ʾ��������*/    
function article_list($db,$cate=null,$tag=null){
  $img_address='img/';//ָ�����·��������ļ���Ϊimg
  //ָ������������  
  if($cate){
    $query="select name from category where value='".$cate."'";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result==1){
	$row=$result->fetch_assoc();
	echo "<h1>����:".$row['name']."</h1>";
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
	    echo "<span>��ǩ:</span>";
	    article_tag($row['postid'],"span");
	    echo "</div>";
	    echo "</div>";
        if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }		
      }
	}
	//���÷���������������"�÷�������������"
	else if($num_result<=0){
	    echo "<h2 style='margin:20px 0px 20px 0px;'>�÷�������������</h2>";
	}
  }
  //ָ����ǩ�������
  else if($tag){
    $query="select name from tag where name='".$tag."'";
    $result=$db->query($query);
    $num_result=$result->num_rows;
	if($num_result==1){
	$row=$result->fetch_assoc();
	echo "<h1>��ǩ:".$row['name']."</h1>";
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
	    echo "<span>��ǩ:</span>";
	    article_tag($db,$row['postid'],"span");
	    echo "</div>";
	    echo "</div>";
        if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }		
      }
	}
	//���ñ�ǩ������������"�ñ�ǩ����������"
	else if($num_result<=0){
	  echo "<h2 style='margin:20px 0px 20px 0px;'>�ñ�ǩ����������</h2>";
	}
  }
  //��ָ����ǩҲ��ָ������������
  else{
    echo "<h1>����:��������</h1>";
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
	  echo "<span>��ǩ:</span>";
      article_tag($db,$row['postid'],"span");
	  echo "</div>";
	  echo "</div>";
      if(($i>0)&&($i%2==0)){
		  echo "<div class='clearfix'></div>";
        }  		
	  }
	}
	//���������£�����"������"
    else if($num_result<=0){
	  echo "<h2 style='margin:20px 0px 20px 0px;'>�ñ�ǩ����������</h2>";
	}	
  }
}

  



?>