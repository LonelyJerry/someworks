<?php
/*�ú���������Ϊ�������ݿ�*/
function connect(){
  $host="localhost";
  $user="root";
  $password="";
  $dbase_name="pinman";
  @ $db=new mysqli($host,$user,$password,$dbase_name);
  if(mysqli_connect_errno()){
    echo '�������ݿ�ʧ��';
	exit;
  }
  else{
  //echo "���ӳɹ�";
  }
//echo @"mysql��������$host�û�����$user<br>";

//echo"���ݿ�:$dbase_name<br>";
//echo"����mysql���ݿ�ɹ�";
  $db->query("set names gbk");
  return $db;
}
?>