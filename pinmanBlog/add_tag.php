<?php
/*�������*/
include('conn.php');
$db=connect();

$new=$_POST['new_tag'];//�±�ǩ������
if(!$new){
  echo "�������µı�ǩ";
  exit;
  }
//��ֹSQLע��
if(!get_magic_quotes_gpc()){
  $new=addslashes($new);
  }
//�������ӵı�ǩ���Ƿ��Ѿ�����
$query="select * from tag where name='".$new."'";
$result=$db->query($query);
if(!$result){
  return false;
  }
  
if($result->num_rows>0){
  echo "�ñ�ǩ�Ѵ���";
  exit;
  }
//��tag������µı�ǩ��Ϣ
else{
  $query="insert into tag values('','".$new."')";//insert into tag values('','$new');
  $result=$db->query($query); 
  if(!$result){
    return false;
    }
  }
//�������̱�ҳ��
header("location:editor.php");
?>