<?php
	session_name("Name");
	session_start();
	include "otpravDBC.php";
	
//�������� ����� ������
function len($value,$min,$max){
	$result=(mb_strlen($value)<$min||mb_strlen>$max);
	return !$result;
}

//�������� �����
function email_valid($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}
	
if($_SERVER['REQUEST_METHOD']=='POST'){
	//��������� ������ �� ����� �������//
	
	/*//����� ���������� ������ � �������� �����������//
	echo $_POST['name'].'<br />'.$_POST['email'].'<br />'.$_POST['title'].'<br />';
*/
	$name=check($_POST['name']);
	$email=check($_POST['email']);
	$title=check($_POST['title']);
	
	$name=trim($name);
	$email=trim($email);
	$title=trim($title);

	if(!empty($name)&&!empty($email)&&!empty($title)){
		//�������� ������ �������� ������
		if(len($name,0,100)&&email_valid($email)&&len($title,0,100)){
			echo "<br>������ �������";
		}else {
			echo "<br>������� ������������ ������!";
			}
	}else {
		echo "<br>��������� ������ ����";
		}
}else{header("<br>Location: registration.php");
}
$u = new otpravDBC($_POST['name'].";".$_POST['email'].";".$_POST['title'].";");
					
$u->getString();
$u->insert($_POST['name'],$_POST['email'],$_POST['title'])
?>


