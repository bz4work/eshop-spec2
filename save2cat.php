<?php
error_reporting(-1);
header ('Content-type: text/html; charset=utf-8');
	// подключение библиотек
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (!empty($author) && !empty($title) && !empty($pubyear)){
		//фильтрация полученных данных из формы
		$author = clearData($_POST['author'], 's');
		$title = clearData($_POST['title'], 's');
		$pubyear = clearData($_POST['pubyear'], 'i');
		$price = clearData ($_POST['price'], 'f');
		//добавления данных в БД
			if (save_cat ($author, $title, $pubyear, $price)){
				header ('Location: http://localhost/spec2/eshop/save2cat.php');
				//sleep (3);
				//echo "товар добавлен!<br><a href='http://localhost/spec2/eshop/add2cat.php'>Добавить еще</a>";
			}else{
				echo save_cat ($author, $title, $pubyear, $price);
			}
		}else{
			echo "Не все поля заполнены! <a href='http://localhost/spec2/eshop/add2cat.php'>назад</a>";
		}
	}else{
		echo "Добавлено. <a href='http://localhost/spec2/eshop/add2cat.php'>Добавить еще</a>";
	}
	/*
	ЗАДАНИЕ 1
	- Получите и отфильтруйте данные из формы
	
	ЗАДАНИЕ 2
	- Вызовите функцию save() для сохранения нового товара в БД
	
	ЗАДАНИЕ 3
	- Переадресуйте пользователя на страницу добавления нового товара (add2cat.php)
	*/
?>