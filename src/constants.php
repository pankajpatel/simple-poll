<?php 	
	session_start();
	define('HOST', '127.0.0.1');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'poll');

	mysql_connect(HOST, USER, PASS);
	mysql_select_db(DB);
