<?php
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	
	//получаем идентификатор покупателя
	$customer_id = session_id();
	//получаем id, который передан GET-ом и фильтруем через функцию
	$goods_id = clearData($_GET['id'], 'i');
	//количество пока по-умолчанию = 1
	$quant = 1;
	
	//добавляем в таблицу "корзина" данные по заказу
	$add = add2basket($customer_id, $goods_id, $quant, time());
	
	header ('Location: catalog.php');
?>