<?php
date_default_timezone_set('Europe/Kiev');
define ('DB_HOST','localhost');
define ('DB_LOGIN','root');
define ('DB_PASS','root');
define ('DB_NAME','eshop');
define ('ORDERS_LOG','orders.log');
$count = 0;
$link = mysql_connect(DB_HOST, DB_LOGIN, DB_PASS) or die ('Ошибка подключения к базе: '.mysql_error());
$db_select = mysql_select_db(DB_NAME, $link) or die ('Ошибка выбора базы: '.mysql_error());

$sql = "SELECT count(*) FROM basket
		WHERE customer='".session_id()."'";
$res = mysql_query($sql) or die (mysql_error());
$count = mysql_result($res, 0, "count(*)");
	/*
	ЗАДАНИЕ 1
	- Создайте четыре константы:
		DB_HOST - для хранения адреса сервера баз данных mySQL
		DB_LOGIN - для хранения логина для соединения с сервером баз данных mySQL
		DB_PASSWORD - для хранения пароля для соединения с сервером баз данных mySQL
		DB_NAME - для хранения имени базы данных
	- Создайте переменную $count, которая будет хранить количество товаров в корзине пользователя и присвойте ей значение по умолчанию
	- Создайте константу ORDERS_LOG, которая будет хранить имя файла с личными данными пользователей
	- Установите соединение с сервером баз данных mySQL используя вышесозданные константы
	- Выберите на сервере для работы базу данных DB_NAME
	
	ЗАДАНИЕ 2
	- Выполните SQL-оператор на выборку количества товаров в корзине данного пользователя
	- Получите результат и сохраните его в значении переменной $count	
	*/
?>