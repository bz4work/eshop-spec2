<?php
	// ������ ������
	session_start();
	// ����������� ���������
	require "eshop_db.inc.php";
	require "eshop_lib.inc.php";
	
	//�������� ������������� ����������
	$customer_id = session_id();
	//�������� id, ������� ������� GET-�� � ��������� ����� �������
	$goods_id = clearData($_GET['id'], 'i');
	//���������� ���� ��-��������� = 1
	$quant = 1;
	
	//��������� � ������� "�������" ������ �� ������
	$add = add2basket($customer_id, $goods_id, $quant, time());
	
	header ('Location: catalog.php');
?>