<?php
/*session_start();
$_SESSION['name']="Marmaz";*/
	session_name("Name");
	session_start();

//Функция очистки данных от HTML и PHP тегов
function check($value){
	//$value=trim($value);//Удаление символов пробела из начала и конца строки
	$value=stripslashes($value);//Удаление экранированных символов, таких как "\"	
	$value=strip_tags($value);//Удаление HTML и PHP тегов
	$value=htmlspecialchars($value);//Преобразование спец символов в HTML-сущности
	return $value;
}

//Проверка длины строки
function len($value,$min,$max){
	$result=(mb_strlen($value)<$min||mb_strlen>$max);
	return !$result;
}

//Проверка почты
function email_valid($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}
	
if($_SERVER['REQUEST_METHOD']=='POST'){
	//Получение данных из формы клиента//
	
	/*//Вывод полученных данных в страницу обработчика//
	echo $_POST['name'].'<br />'.$_POST['email'].'<br />'.$_POST['title'].'<br />';
*/
	$name=check($_POST['name']);
	$email=check($_POST['email']);
	$title=check($_POST['title']);
	
	$name=trim($name);
	$email=trim($email);
	$title=trim($title);

	if(!empty($name)&&!empty($email)&&!empty($title)){
		//Проверка длинны вводимых данных
		if(len($name,0,100)&&email_valid($email)&&len($title,0,100)){
			echo "<br>Заявка принята";
		}else {
			echo "<br>Введены некорректные данные!";
			}
	}else {
		echo "<br>Заполните пустые поля";
		}
}else{header("<br>Location: registration.php");
}

/*function sql ($query){
	$db=mysql_connect("localhost", "root", "")
		or die("<br>Ошибка подключения к БД! ".mysql_error()."</br>");
	mysql_select_db("Name",$db)	
		or die("<br>Ошибка выбора БД!".mysql_error()."</p>");
	$result = mysql_query($query)
		or die('<br>В данный момент нельзя добавить пользователя:<br>');
	mysql_close($db);

	if($result)
		return 1;
	else
		return 0;
}

$sql="INSERT INTO name(name, email, title)
			VALUES ('%s','%s', '%s')";
	//%d %s
	$query = sprintf($sql,  mysql_real_escape_string($name),  
						   mysql_real_escape_string($email), 
						   mysql_real_escape_string($title));
	echo "<br>".$query."<br>";*/

$db=mysql_connect("localhost", "root", "")
	or die("<br>Ошибка подключения к БД! ".mysql_error()."</br>");
mysql_select_db("Name",$db)	
	or die("<br>Ошибка выбора БД!".mysql_error()."</p>");
	$sql="INSERT INTO name(name, email, title)
			VALUES ('%s','%s', '%s')";
	//%d %s
	$query = sprintf($sql,  mysql_real_escape_string($name),  
						   mysql_real_escape_string($email), 
						   mysql_real_escape_string($title));
	echo "<br>".$query."<br>";
$result = mysql_query($query)
	or die('<br>В данный момент нельзя добавить пользователя:<br>');
mysql_close($db);

	if($result)
		echo "<br>Данные пользователя добавлены<br>";
	else
		echo "<br>Данные пользователя отклонены<br>";
?>