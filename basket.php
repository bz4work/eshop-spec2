<?php
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Корзина пользователя</title>
</head>
<body>
<h1>Корзина</h1>
<?php
if ($count){
	echo "<p>Вернуться в <a href='catalog.php'>каталог</a></p>";
}else{
	echo "<p>Корзина пуста. Вернуться в <a href='catalog.php'>каталог</a></p>";
}
	/*
	ЗАДАНИЕ 1
	- Проверьте, есть ли товары в корзине пользователя
	- Если товаров нет, выводите строку "Корзина пуста!"
	- Если товары есть, выводите их в нижеприведенной таблице
	*/
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Автор</th>
	<th>Название</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
	/*
	ЗАДАНИЕ 2
	- Получите все товары из корзины пользователя в виде массива
	- Создайте переменные для подсчета порядковых номеров ($i)
		и общей суммы заказа ($sum)
	- В цикле выводите все позиции из корзины на экран
	- Также, в цикле увеличивайте значение переменной $sum
		на соответствующее значение
		(сумма текущего товара * его количество)
	- Значение ячейки "Удалить" оформите в виде гиперссылки на
	документ delete_from_basket.php, добавив параметр id с id записи	
	*/
	$arr = myBasket(session_id());
	
	//echo '<pre>';
	//print_r($arr);
	//echo '</pre>';
	
	foreach ($arr as $st){
		echo '<tr>';
		echo '<td>'. $i += 1 .'</td>';
		echo '<td>'. $st['author'] .'</td>';
		echo '<td>'. $st['title'] .'</td>';
		echo '<td>'. $st['pubyear'] .'</td>';
		echo '<td>'. $st['price'] * $st['quantity'] .'</td>';
		echo '<td>'. $st['quantity'] .'</td>';
		echo "<td><a href='delete_from_basket.php?id={$st['id']}'>Удалить</a></td>";
		echo '</tr>';
		$sum += ($st['price'] * $st['quantity']);
	}
?>
</table>

<p>Всего товаров в корзине на сумму:<?=$sum?>руб.

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'">
</div>

</body>
</html>







