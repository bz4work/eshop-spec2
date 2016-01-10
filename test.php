<?php
error_reporting(-1);
header ('Content-type: text/html; charset=utf-8');
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";

function getOrders(){
if(!file_exists(ORDERS_LOG)){
	return false;
}else{
	$allorders = array();
	$orders = file(ORDERS_LOG);
	foreach ($orders as $order){
		list ($name, $mail, $tel, $address, $customer, $tm) = explode('|', $order);
		
		$orderinfo = array();
		$orderinfo['name'] = $name;
		$orderinfo['tel'] = $tel;
		$orderinfo['addr'] = $address;
		$orderinfo['cust'] = $customer;
		$orderinfo['tm'] = $tm;

		$sql = "SELECT * FROM orders WHERE customer = '$customer'
				AND datetime = '{$orderinfo['tm']}'";
		$res = mysql_query($sql) or die (mysql_error());
		$orderinfo['goods'] = convertData($res);
		
		$allorders[] = $orderinfo;
		
	}
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