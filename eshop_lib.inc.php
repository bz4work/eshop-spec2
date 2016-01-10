<?php
//функция фильтрации данных от пользователя
function clearData ($data, $type){
	switch ($type){
		case 's': trim(strip_tags($data));
			return $data;
		case 'i': $data = (int)$data;
			return $data;
		case 'f': $data = (float)$data;
			return $data;
	}
}

//функция добавления товара в БД
function save_cat($author, $title, $pubyear, $price=0){
	$sql_inc = "INSERT INTO catalog (author, title, pubyear, price)
						VALUES ('$author', '$title', $pubyear, $price);";
	$query_result = mysql_query($sql_inc) or die (mysql_error());
	if ($query_result){
		return true;
	}else{
		return $query_result;
	}
}
//функция конвертации source в массив
function convertData($massiv){
	$arr = array();
	while ($row = mysql_fetch_assoc($massiv)){
		$arr[]= $row;
	}
	return $arr;
}
//функция выборки всех товаров из БД
function select_all($param_sort = 'id', $sort = 'ASC'){
	$sql = "SELECT id, author, title, pubyear, price
			FROM catalog ORDER BY $param_sort $sort";
	$result_inc = mysql_query($sql) or die (mysql_error());	
	return convertData($result_inc);
}
//функция добавления товара в корзину
function add2basket($customer, $goodsid, $quantity, $datetime){
	$sql = "INSERT INTO basket (customer, goodsid, quantity, datetime)
			VALUES ('$customer', $goodsid, $quantity, $datetime)";	
	$res = mysql_query($sql) or die (mysql_error());
	return $res;
}
//получаем всю корзину пользователя
function myBasket(){
	$sql = "SELECT 
			author, title, pubyear, price,
			basket.id, goodsid, customer, quantity
			FROM catalog, basket
			WHERE customer = '".session_id()."'
			AND catalog.id = basket.goodsid";
	$result_inc = mysql_query($sql) or die (mysql_error());	
	return convertData($result_inc);
}
//удаление товаров из корзины
function basketDel($id){
	$sql = "DELETE FROM basket
			WHERE id = $id";
	$result_inc = mysql_query($sql) or die (mysql_error());
	return $result_inc;
}
//удаление заказов
function orderDel($cust_id,$dt_order){
	$sql = "DELETE FROM orders
			WHERE customer = '$cust_id'
			AND datetime = '$dt_order'";
	$result_inc = mysql_query($sql) or die (mysql_error());
	return $result_inc;
}
//сохранение данных о заказе в таблицу orders
function resave($tm){
	$korz = myBasket();
	
	foreach ($korz as $item){
		$sql = "INSERT INTO orders (
									author,
									title,
									pubyear,
									price,
									customer,
									quantity,
									datetime)
							VALUES (
									'{$item['author']}',
									'{$item['title']}',
									{$item['pubyear']},
									{$item['price']},
									'{$item['customer']}',
									{$item['quantity']},
									$tm)";
		mysql_query($sql) or die (mysql_error());
	}
	$sql = "DELETE FROM basket WHERE customer = '{$item['customer']}'";
	$res = mysql_query($sql) or die (mysql_error());
	return $res;
}
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
?>