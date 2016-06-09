<?php
class otpravDBC{
	//��������
	public $name; //string 
	public $email; //string 
	public $title; //string 
	//�����������
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
	
	//�������
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

	//�������
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

	//��������� 

	public static function Tname($name){//�������� �����
	$options = array("options"=>array('regexp'=>'([a-zA-Z�-��-�])'));
		if(filter_var($name, FILTER_VALIDATE_REGEXP, $options))
			return true;
		else 
			return false;
	}
	

	public static function Temail($email){//�������� email
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			return true;
		else
			return false;
	}

	public static function Ttitle($title){//�������� �����������
	$options = array("options"=>array('regexp'=>'([a-zA-Z�-��-�])'));
		if(filter_var($title, FILTER_VALIDATE_REGEXP, $options))
			return true;
		else 
			return false;
	}
	
	
	//������
	public function conDB($sql){//����������� � �� $sql - ������ �����������
		/*$this->conn = new mysqli("localhost", "root", "");
		if(mysql_connect_errno()){
			$conErr = "������ ���������� � ��".mysqli_connect_error();
		}
			else{
				$conErr = "";
			}
			return $conErr;*/
		$conn = mysql_connect("localhost", "root", "")
			or die ("<br/>�� ���� �������������� � �������");
		mysql_select_db("Name",$conn)
			or die ("<br/>�� ���� ����� ��");
		$result = mysql_query($query)
			or die('<br>� ������ ������ ������ �������� ������������:<br>');
		return $conn;
	}
	public function closeConDB(){//���������� �� ��
		mysql_close($conn);
	}
		
	public function insert($name, $email, $title){
			$this->name=$name;
			$this->email=$email;
			$this->title=$title;
					
		
		$db=mysql_connect("localhost", "root", "")
	or die("<br>������ ����������� � ��! ".mysql_error()."</br>");
mysql_select_db("Name",$db)	
	or die("<br>������ ������ ��!".mysql_error()."</p>");
	$sql="INSERT INTO name(name, email, title)
			VALUES ('%s','%s', '%s')";
	$query = sprintf($sql, 	   mysql_real_escape_string($name), 
						   mysql_real_escape_string($email), 
						   mysql_real_escape_string($title));
						   echo "<br>".$query."<br>";
$result = mysql_query($query)
	or die('<br>� ������ ������ ������ �������� ������������:<br>');
mysql_close($db);
	if($result)
		echo "<br>������ ������������ ���������<br>";
	else
		echo "<br>������ ������������ ���������<br>";
/*$db=mysql_connect("localhost", "root", "")
	or die("<br>������ ����������� � ��! ".mysql_error()."</br>");
mysql_select_db("Name",$db)	
	or die("<br>������ ������ ��!".mysql_error()."</p>");		
			$sql=/*$this->conn->prepare*/("INSERT INTO name (name, email, title)
										  VALUES (?,?,?)");
			//prepare - �������������� ������ � ���������� � ���������� ��������������� � ���� �������� ������
			/*$query->bind_param("sss", $this->name, $this->email, $this->title);
			 //sss  - ���������� ���� ������ ��� ������� ��������� �� �������
			 //bind_param - ��������� ���������� PHP � ���������� ��������� SQL
			$query->execute();//��������� �������������� ������ �� ����������
			$query->close();*/
			
	/*		$query = sprintf($this->sql, mysql_real_escape_string($this->name), 
						   mysql_real_escape_string($this->email), 
						   mysql_real_escape_string($this->title));
						   
	echo "<br>".$query."<br>";
$result = mysql_query($query)
	or die('<br>� ������ ������ ������ �������� ������������:<br>');
mysql_close($db);*/
		}
		
	public function del($email){//�������� �� �����
		$this->email=$email;
		$query = $this->conn->prepeare("DELETE FROM name WHERE email = ?");
		$query->bind_param("s",$this->email);
		$query->execute();
		$query->close();
	}
	public function select($email){//������� �� �����
		$this->email = $email;
		$query = $this->conn->prepeare("SELECT * FROM name WHERE email = ?");
		$query->bind_param("s", $this->email);
		$query->execute();
		$query->close();
		return $query;
	}
	public function Tselect($email){//������� �� ���� �������
		$query = $this->conn->prepeare("SELECT * FROM name");
		return $query;
	}
}
?>