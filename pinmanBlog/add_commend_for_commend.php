<?php
/*�����۽��лظ�*/
include_once('conn.php');
//�������ݿ�
$db=connect();
//ͨ��get������ȡ���۵�id��;
$id=$_GET['commend_id'];
$parent_id=$_GET['article_id'];//ͨ��get������������ҳ��
$name=$_POST['yourname'];//�����ߵ�����
$email=$_POST['youremail'];//�����ߵ�����
$date=date("Y-m-d");//��������
$body=$_POST['commend_body'];//��������
//ͷ���ѡ�����ѡ����ͷ����ʹ��ͷ��
if(isset($_POST['icon'])){
  $icon=$_POST['icon'].".jpg";
  }
//���ûѡͷ����ʹ��Ĭ��ͷ��
else{
  $icon="default.jpg";
  }

if(!$name||!$email||!$body){
  echo "����д����������Ϣ";
  exit;
  }
//��ֹSQLע��
if(!get_magic_quotes_gpc()){
  $name=addslashes($name);
  $email=addslashes($email);
  $body=addslashes($body);
  }
/*��commends������Ӷ����۵�����*/
//insert into commend values ('','$name','$email','$icon','$body','$date',$parent_id,$id,0)
$query="insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent_id.",".$id.",0)";
$result=$db->query($query);
if(!$result){
  echo "ʧ��".$db->error;
  return false;
  exit;
  }
//�����۵�������Ҫ�ı��䱻���۴���
$query="select * from commend where commend_father=".$id."";
$result=$db->query($query);
$children_num=$result->num_rows;
echo $children_num;
$query="update commend set children=".$children_num." where id=".$id."";
$result=$db->query($query);
if(!$result){
  echo "ʧ��".$db->error;
  return false;
  exit;
  }
//�����������ڵ�����ҳ��
header("location:article.php?postid=".$parent_id);  
?>
