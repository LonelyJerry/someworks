<?php
/*����µ�����*/
//�������ݿ�����ģ��
include('conn.php');
//�����ļ��ϴ�ģ��
include('fileSystem.php');
$db=connect();
$article_id=$_GET['article_id'];
$title=$_POST['title'];//���±���
$author=$_POST['author'];//��������
$description=$_POST['description'];//ժҪ
$group=$_POST['group'];//���·���
$cover=$_FILES['cover'];//���·���
$cover=$cover['name'];//���·���ͼƬ���ļ�����������ַ��
$body=$_POST['body'];//�������ģ��������������body���ݿ�
//��ǩ�ǿ�ѡ�ģ����ѡ���˱�ǩ�����ϴ�
if(isset($_POST['tags'])){
  $tags=$_POST['tags'];
}
$date=date("Y-m-d");//�����������
$img=upload($_FILES['cover'],"img");//������ͼƬ�ļ������img�ļ�����

if(!$title||!$author||!$description||!$group||!$cover||!$date||!$body){
  echo "��������д��";
  exit;
  }
//��SQLע��
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
/*��header��������µ����½�����Ϣ*/
    
$query="update header set poster='".$author."',title='".$title."',posted='".$date."',cate='".$group."',description='".$description."',cover='".$cover.
       "' where postid=".$article_id."";
//"insert into header values('','$author','$title','$date','','$group','$description','$cover')";
$result=$db->query($query);
if(!$result){
  return false;
  exit;
  }
/*��body�����������������Ϣ*/
//�ҵ�Ҫ��body������ӵ�����id 
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
//��body�������������Ϣ
$query="update body set message='".$body."' where postid=".$article_id."";
//"insert into body values(postid,'$body')"
$result=$db->query($query);
if(!$result){
  return false;
  }
/*���ѡ���˱�ǩ���򽫱�ǩ�����µĹ�����Ϣ�����article_tag���±�ǩ��ϵ���У����ºͱ�ǩ�Ĺ�ϵΪ��Զ࣬
ʹ�����±���ǩ�����¡���ǩ��ϵ������ʾ�ö�Զ��ϵ*/
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