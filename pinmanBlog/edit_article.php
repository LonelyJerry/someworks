<?php
/*添加新的文章*/
//引入数据库连接模块
include('conn.php');
//引入文件上传模块
include('fileSystem.php');
$db=connect();
$article_id=$_GET['article_id'];
$title=$_POST['title'];//文章标题
$author=$_POST['author'];//文章作者
$description=$_POST['description'];//摘要
$group=$_POST['group'];//文章分类
$cover=$_FILES['cover'];//文章封面
$cover=$cover['name'];//文章封面图片的文件名（不带地址）
$body=$_POST['body'];//文章正文，文章正文另放于body数据库
//标签是可选的，如果选择了标签，则上传
if(isset($_POST['tags'])){
  $tags=$_POST['tags'];
}
$date=date("Y-m-d");//添加文章日期
$img=upload($_FILES['cover'],"img");//将封面图片文件存放于img文件夹中

if(!$title||!$author||!$description||!$group||!$cover||!$date||!$body){
  echo "请完整填写表单";
  exit;
  }
//防SQL注入
if(!get_magic_quotes_gpc()){
  $title=addslashes($title);
  $author=addslashes($author);
  $description=addslashes($description);
  $group=addslashes($group);
  $cover=addslashes($cover);
  $date=addslashes($date);
  $cover=addslashes($cover);
  $body=addslashes($body);
  if(isset($_POST['tags'])){
    foreach ($tags as $key => $value) { 
      $tags[$key] = addslashes($tags[$key]); 
      } 
    }
  }
/*向header表中添加新的文章介绍信息*/
    
$query="update header set poster='".$author."',title='".$title."',posted='".$date."',cate='".$group."',description='".$description."',cover='".$cover.
       "' where postid=".$article_id."";
//"insert into header values('','$author','$title','$date','','$group','$description','$cover')";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
  }
/*向body表中添加文章正文信息*/
//找到要向body表中添加的文章id 
/*$query="select postid from header ORDER BY postid desc";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
  }
if($result->num_rows>0){
  $this_row=$result->fetch_array();
  $postid=$this_row[0];
  }*/
//向body表中添加正文信息
$query="update body set message='".$body."' where postid=".$article_id."";
//"insert into body values(postid,'$body')"
$result=$db->query($query);
if(!$result){
  return false;
  }
/*如果选择了标签，则将标签和文章的管理信息添加至article_tag文章标签关系表中，文章和标签的关系为多对多，
使用文章表、标签表、文章—标签关系表来表示该多对多关系*/
$query="delete from article_tag where postid=".$article_id."";
$db->query($query);
if(isset($tags)){
  foreach($tags as $arr){
    $query="select tagid from tag Where name='".$arr."'";
    $result=$db->query($query);
    if(!$result){
      return false;
    }
    if($result->num_rows>0){
      $this_row=$result->fetch_array();
      $tagid=$this_row[0];
	  $query="insert into article_tag values('','".$article_id."','".$tagid."')";
	  $result=$db->query($query);
    }
    else{
      return false;
    }	  
    
    }
  if(!$result){
    return false;
  }
  
}
header("location:article_editor.php?article_id=".$article_id);
?>