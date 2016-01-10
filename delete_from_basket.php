<?php
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	
	if (isset($_GET['id'])){
		$id = clearData ($_GET['id'], 'i');
		basketDel ($id);
		header ('Location: basket.php');
	}
	if (isset($_GET['cus']) && isset($_GET['dt'])){
		$customer_id = clearData ($_GET['cus'], 's');
		$datetime_order = clearData ($_GET['dt'], 'i');
		//orderDel($customer_id, $datetime_order) or die ('Ошибка?');
		$fl = file(ORDERS_LOG);
		echo '<pre>';
		echo print_r($fl,1);
		echo '</pre><br><br>';
		echo 'customer id: '.$customer_id.'<br>';
		//считаем количество элементов массива
		$res = array_search('slava@aet.ua',$fl);	
		echo '<pre>$res: '.$res.'</pre>';
		unset ($fl["$res"]);
		echo '<pre>';
		echo print_r($fl,1);
		echo '</pre>';
		//file_put_contents(ORDERS_LOG,  );
		//header ('Location: orders.php');	
	}
	
	$array = array(0 => 'blue', 1 => 'red', 2 => 'green', 3 => 'red');
		echo '<pre>';
		echo print_r($array,1);
		echo '</pre><br>';
	$key = array_search('green', $array); // $key = 2;
	echo $key;
	$key = array_search('red', $array);   // $key = 1;
	echo $key;
	/*
	ЗАДАНИЕ 1
	- Получите идентификатор удаляемого товара
	- Вызовите функцию basketDel() для данного товара
	- Переадресуйте пользователя на корзину заказов
	*/
?>