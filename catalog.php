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
	<title>Каталог товаров</title>
</head>
<body>
<h1>Каталог товаров</h1>
<?php
/*
ЗАДАНИЕ 1
- Выведите в этом месте строку "Товаров в корзине: "
	и текущее количество товаров в корзине для
	данного пользователя
- Слово "корзине" оформите в виде гиперссылки на
	документ basket.php
*/
echo "Товаров в <a href='basket.php'>корзине</a>: $count";

?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>Автор</th>
	<th>Название</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>В корзину</th>
</tr>
<?php
	/*
	ЗАДАНИЕ 2
	- С помощью функции selectAll() получите выборку всех товаров
	- В цикле выведите все товары на экран
	- Значение ячейки "В корзину" оформите в виде гиперссылки на
	документ add2basket.php, добавив параметр id с идентификатором(поле id) товара
	*/
	
	$all_product = select_all();
	
	//echo '<pre>';
	//print_r($all_product);
	//echo '</pre>';
	
	foreach ($all_product as $item){
		echo '<tr>';
		echo "<td>{$item['author']}</td>";
		echo "<td>{$item['title']}</td>";
		echo "<td>{$item['pubyear']}</td>";
		echo "<td>{$item['price']}</td>";
		echo "<td><a href='add2basket.php?id={$item['id']}'>В корзину</a></td>";
		echo '</tr>';
	}
	
?>
</table>
</body>
</html>