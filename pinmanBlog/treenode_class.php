<?php
//���ݡ�PHP��MYSQL�������е�586ҳ�Ĵ����д
include_once('conn.php');

class treenode{
  public $m_postid;//���۵�id
  //public $m_title;//���۵ı��⣬������Բ�Ҫ
  public $m_poster;//������
  public $m_posted;//����ʱ��
  public $m_icon;//������ͷ��
  public $m_children;//���۵���������
  public $m_body;//��������
  public $m_childlist;//����������
  public $m_article;//������������
  public $m_father;//���۵ĸ����۵�����������
  
  public function __construct($postid,$poster,$posted,$icon,
       $children,$body,$article,$father){
    $this->m_postid=$postid;
	//$this->m_title=$title;
	$this->m_poster=$poster;
	$this->m_posted=$posted;
	$this->m_icon=$icon;
	$this->m_children=$children;
	$this->m_body=$body;
	$this->m_childlist=array();
	//$this->m_depth=$depth;
	$this->m_article=$article;
	$this->m_father=$father;
	
	
	if($children>0){
	  $db=connect();
	  $query="select * from commend where commend_father =".$postid." order by date ASC";
	  $result=$db->query($query);
	  
	 
	  if(!$result){
       return false;
	   echo "ʧ��";
	   exit;
       }
	  $query2="select name from commend where id=".$postid."";
	  $result2=$db->query($query2);
	  $row=$result2->fetch_assoc();
	  $father=$row['name'];
	  //������۵�������,��������������treenode��
	  for($count=0;$r=$result->fetch_assoc();$count++){
		$this->m_childlist[$count]=new treenode($r['id'],$r['name'],$r['date'],$r['icon'],$r['children'],$r['body'],$article,$father);
	  }
	}
  }
  
  function display(){
    $img_address="img/";
	
	  echo "<div class='commend'>";
	  echo "<img class='touxiang' src='".$img_address.$this->m_icon."'/>";
	  echo "<div class='say'>";
	  echo "<p class='name'>".$this->m_poster;
	  if($this->m_father!=null)
	  {echo "&nbsp��&nbsp".$this->m_father."����";}
	  echo "</p>";
	  echo "<p>".$this->m_body."</p>";
	  echo "<a class='commend_for_commend'>���۸�����</a>";
	  if($this->m_children>0){
        echo "<a class='commends'>�������µ�����(".$this->m_children.")</a>";
		}
	  echo "</div>";
	  echo "<p class='date clearfix' style='margin-left:10px;'>".$this->m_posted."</p>";
	  echo "<div class='commend_for_commend_area'>";
	  echo "<form method='post' action='add_commend_for_commend.php?commend_id=".$this->m_postid."&article_id=".$this->m_article."'></form>";
	  echo "</div>";
	  echo "<div class='commends_for_thiscommend'>";
	  //�����۵������۵ݹ����display()����
      $num_children=$this->m_children;
	  for($i=0;$i<$num_children;$i++){
	    @$this->m_childlist[$i]->display();
	  }
	  echo "</div>";
	  echo "</div>"; 
      
	
	}
   function display_for_commend_edit(){
      echo "<p style='dispaly:inline' class='name'>".$this->m_poster;
	  if($this->m_father!=null)
	  {echo "&nbsp��&nbsp".$this->m_father."����";}
	  echo ":</p>";
	  echo "<p style='dispaly:inline'>".$this->m_body."</p>";
	  echo "<p class='date clearfix' style='margin-left:10px;'>".$this->m_posted."</p>";
	  echo "<form name='delete_commend' action='delete_commend.php?commend_id=".$this->m_postid."&article_id=".$this->m_article.
	     "' method='post'><input type='submit' value='ɾ��'></form>";
	  $num_children=$this->m_children;
	  for($i=0;$i<$num_children;$i++){
	    @$this->m_childlist[$i]->display_for_commend_edit();
	  }
	  
   }
}