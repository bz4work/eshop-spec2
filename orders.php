<?php
error_reporting(-1);
//header ('Content-type: text/html; charset=utf-8');
	// запуск сессии
	session_start();
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Поступившие заказы</title>
</head>
<body>
<h2>Поступившие заказы:</h2>
<?php
$allorders = getOrders();
foreach ($allorders as $item){
?>
<hr>
<p><b>Заказчик</b>: <?=$item['name']?></p>
<p><b>Email</b>: <?=$item['mail']?></p>
<p><b>Телефон</b>: <?=$item['tel']?></p>
<p><b>Адрес доставки</b>: <?=$item['addr']?></p>
<p><b>Дата размещения заказа</b>: <?=date('d.m.Y H:i',$item['datetime']*1)?></p>
<h3>Купленные товары:</h3>
<h3>Удаление заказа:<a href='delete_from_basket.php?cus=<?=$item['cust']?>&dt=<?=$item['datetime']?>'>Удалить</a></h3>

<table border="1" cellpadding="5" cellspacing="0" width="90%">
<tr>
	<th>N п/п</th>
	<th>Автор</th>
	<th>Название</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
</tr>
<?php
	$sum = 0;
	$i = 1;
	foreach ($item['tovari_v_zakaze'] as $book){
		echo "<tr>\n";
		echo "\t<td>".$i."</td>\n";
		echo "\t<td>{$book['author']}</td>\n";
		echo "\t<td>{$book['title']}</td>\n";
		echo "\t<td>{$book['pubyear']}</td>\n";
		echo "\t<td>{$book['price']}</td>\n";
		echo "\t<td>{$book['quantity']}</td>\n";
		
		echo "</tr>\n";
		$i += 1;
		$sum += ($book['price'] * $book['quantity']);
	}
?>
</table>
<p>Всего товаров в заказе на сумму:<?=$sum?> руб.

<?php
}
?>
</body>
</html>