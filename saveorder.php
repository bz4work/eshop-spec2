<?php
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	/*
	ЗАДАНИЕ 1
	- получите из формы и обработайте данные заказа
	*/
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['address'])){
			$name = clearData($_POST['name'],'s');
			$email = clearData($_POST['email'],'s');
			$phone = clearData($_POST['phone'],'s');
			$address = clearData($_POST['address'],'s');
			$sess_id = session_id();
			$tm = time();
			$order = "$name|$email|$phone|$address|$sess_id|$tm\n";
			file_put_contents(ORDERS_LOG, $order, FILE_APPEND);
			header('Location: saveorder.php');
		}else{
			echo 'Не все поля заполнены';
		}
	}
	resave($tm);
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Каталог товаров</a></p>
</body>
</html>