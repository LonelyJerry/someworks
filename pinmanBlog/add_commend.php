<?php
/*�������������*/
//�������ݿ�����ģ��
include('conn.php');
$db=connect();

$name=$_POST['yourname'];//�������ǳ�
$email=$_POST['youremail'];//����������
//ͨ��get������ȡ���µ�id��;
$parent=$_GET['postid'];
$date=date("Y-m-d");//��������
$body=$_POST['commend_body'];//��������
//�����ߵ�ͷ���ǿ�ѡ�ģ����ѡ����ͷ�����ȡ��ѡͷ��
if(isset($_POST['icon'])){
  $icon=$_POST['icon'].".jpg";
  }
//������ûѡ��ͷ��ʱʹ��Ĭ��ͷ��
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
/*��commend�������������Ϣ*/
//"insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent.",'',0)"
$query="insert into commend values ('','".$name."','".$email."','".$icon."','".$body."','".$date."',".$parent.",NULL,0)";
$result=$db->query($query);
if(!$result){
  echo "ʧ��".$db->error;
  return false;
  exit;
  }
//���������۵����µ�ҳ��  
header("location:article.php?postid=".$parent);  
?>
