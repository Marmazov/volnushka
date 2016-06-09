<?php
class otpravDBC{
	//Атрибуты
	public $name; //string 
	public $email; //string 
	public $title; //string 
	//Конструктор
	public function __construct($args){
		$mass = explode(";", $args);
		$n = $mass[0];
		$e = $mass[1];
		$t = $mass[2];
				
		if(otpravDBC::Tname($n)) $this->name = $n;
		else $this->name = "NULL";
		
		if(otpravDBC::Temail($e)) $this->email = $e;
		else $this->email = "NULL";
		
		if(otpravDBC::Ttitle($t)) $this->title = $t;
		else $this->title = "NULL";			
	}
	
	//Геттеры
	public function getString(){
		echo "<br>".$this->name."; ".$this->email."; ".$this->title.";";
	}
	
	
	public function getName(){
		if(isset($this->name)) 
		{
			return $this->name;
		}
		else return "NULL";	
}

	public function getEmail(){
		if(isset($this->email)) 
		{
			return $this->email;
		}
		else return "NULL";
	}
	
	public function getTitle(){
		if(isset($this->title)) 
		{
			return $this->title;
		}
		else return "NULL";
	}

	//Сеттеры
		public function setName(){
		if(otpravDBC::Tname($name)) 
			$this->name=$name;
	}

	public function setEmail(){
		if(otpravDBC::Temail($email)) 
			$this->email=$email;
	}
	
	public function setTitle(){
		if(otpravDBC::Ttitle($title)) 
			$this->title=$title;
	}

	//Валидация 

	public static function Tname($name){//Проверка имени
	$options = array("options"=>array('regexp'=>'([a-zA-Zа-яА-Я])'));
		if(filter_var($name, FILTER_VALIDATE_REGEXP, $options))
			return true;
		else 
			return false;
	}
	

	public static function Temail($email){//Проверка email
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}

	public static function Ttitle($title){//Проверка комментария
	$options = array("options"=>array('regexp'=>'([a-zA-Zа-яА-Я])'));
		if(filter_var($title, FILTER_VALIDATE_REGEXP, $options))
			return true;
		else 
			return false;
	}
	
	
	//Методы
	public function conDB($sql){//Подключение к БД $sql - запрос передаваемы
		/*$this->conn = new mysqli("localhost", "root", "");
		if(mysql_connect_errno()){
			$conErr = "Ошибка соединения к БД".mysqli_connect_error();
		}
			else{
				$conErr = "";
			}
			return $conErr;*/
		$conn = mysql_connect("localhost", "root", "")
			or die ("<br/>Не могу подсоедениться к серверу");
		mysql_select_db("Name",$conn)
			or die ("<br/>Не могу найти БД");
		$result = mysql_query($query)
			or die('<br>В данный момент нельзя добавить пользователя:<br>');
		return $conn;
	}
	public function closeConDB(){//Отключение от БД
		mysql_close($conn);
	}
		
	public function insert($name, $email, $title){
			$this->name=$name;
			$this->email=$email;
			$this->title=$title;
					
		
		$db=mysql_connect("localhost", "root", "")
	or die("<br>Ошибка подключения к БД! ".mysql_error()."</br>");
mysql_select_db("Name",$db)	
	or die("<br>Ошибка выбора БД!".mysql_error()."</p>");
	$sql="INSERT INTO name(name, email, title)
			VALUES ('%s','%s', '%s')";
	$query = sprintf($sql, 	   mysql_real_escape_string($name), 
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
/*$db=mysql_connect("localhost", "root", "")
	or die("<br>Ошибка подключения к БД! ".mysql_error()."</br>");
mysql_select_db("Name",$db)	
	or die("<br>Ошибка выбора БД!".mysql_error()."</p>");		
			$sql=/*$this->conn->prepare*/("INSERT INTO name (name, email, title)
										  VALUES (?,?,?)");
			//prepare - Подготавливает запрос к выполнению и возвращает ассоциированный с этим запросом объект
			/*$query->bind_param("sss", $this->name, $this->email, $this->title);
			 //sss  - определяет типы данных для каждого параметра по порядку
			 //bind_param - Связывает переменную PHP с параметром оператора SQL
			$query->execute();//Запускает подготовленный запрос на выполнение
			$query->close();*/
			
	/*		$query = sprintf($this->sql, mysql_real_escape_string($this->name), 
						   mysql_real_escape_string($this->email), 
						   mysql_real_escape_string($this->title));
						   
	echo "<br>".$query."<br>";
$result = mysql_query($query)
	or die('<br>В данный момент нельзя добавить пользователя:<br>');
mysql_close($db);*/
		}
		
	public function del($email){//Удаление по почте
		$this->email=$email;
		$query = $this->conn->prepeare("DELETE FROM name WHERE email = ?");
		$query->bind_param("s",$this->email);
		$query->execute();
		$query->close();
	}
	public function select($email){//Выборка по почте
		$this->email = $email;
		$query = $this->conn->prepeare("SELECT * FROM name WHERE email = ?");
		$query->bind_param("s", $this->email);
		$query->execute();
		$query->close();
		return $query;
	}
	public function Tselect($email){//Выборка по всей таблице
		$query = $this->conn->prepeare("SELECT * FROM name");
		return $query;
	}
}
?>