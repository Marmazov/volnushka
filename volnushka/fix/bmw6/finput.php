<?php
	$massive[]=array($a = '"name"',
				$t = '"text"',
				 $r = 'required',
				 $ps= '"[A-z]{3,}"'
				 
	);
	
	$massive[]=array($a = '"email"',
				$t = '"email"',
				 $r = 'required',
				 $ps= '"^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$"'
				
	);
	$massive[]=array($a = '"title"',
				$t = '"title"',
				 $r = '',
				 $ps= '"^[A-Za-zÀ-ßà-ÿ¨¸\s]+$"'				 
	);
	
	
?>
