<?php

require_once '../includes/functions.php';

if (isset($_GET['title'])) {
  $title = $_GET['title'];
}
else {
  $title = 'Project 0';
}

if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
else {
  $page = 'items';
}

if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
}
else {
  $cart = array();
}

render('templates/header', array('title' => $title));

$path = __DIR__ . '/../xml/menu.xml';
if (file_exists($path)) {
  $xml = simplexml_load_file($path);
  $query = get_query($page, $title, $xml);
  render($page, array('xml' => $xml, 'query' => $query, 'title' => $title));
}
else {
  $xml = 'error';
  render('error', array('error' => 'Error loading menu.'));
}

render('menu', array('xml' => $xml, 'title' => $title));
render('cart', array('cart' => $cart));
render('templates/footer');