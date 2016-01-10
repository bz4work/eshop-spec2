<?php
error_reporting(-1);
header ('Content-type: text/html; charset=utf-8');
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";

function getOrders(){
	//создаем первый/основной пустой массив
		$allorders = array();
	//создаем и заполняем массив данными из файла
		$info_from_file = file(ORDERS_LOG);
	//создаем второй массив 2го уровня вложености в первый
		$orderinfo = array();
	//перебираем массив с данными из файла и этими данными заполняем массив 2го уровня вложености
	foreach ($info_from_file as $item){
		//каждую строку разделяем на переменные
		list ($n, $e, $t, $a, $c, $dt) = explode('|', $item);
		//и каждую переменную вкладываем в отдельную ячейку 2го массива
		$orderinfo['name'] = $n;
		$orderinfo['mail'] = $e;
		$orderinfo['tel'] = $t;
		$orderinfo['addr'] = $a;
		$orderinfo['cust'] = $c;
		$orderinfo['datetime'] = $dt;
		$sql = "SELECT * FROM orders WHERE datetime = '{$orderinfo['datetime']}' AND customer = '{$orderinfo['cust']}'";
		$res = mysql_query($sql) or die (mysql_error());
		$orderinfo['tovari_v_zakaze'] = convertData($res);
		//после заполнения массива orderinfo данными покупателя из файла -
		//вкладываем масиив $orderinfo в ячейку $allorders[] и идем перебирать следующую строку из файла
		$allorders[] = $orderinfo;
	}
	return $allorders;
}

$test = getOrders();

echo '<pre>';
print_r($test);
echo '</pre>';

/*
foreach ($test as $v){
	echo $v.'<br>';
}
*/


?>