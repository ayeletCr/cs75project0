<?php
session_start();

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
  $page = '';
}

if (isset($_GET['name'])) {
  $name = $_GET['name'];
}
else {
  $name = '';
}

if (isset($_GET['size'])) {
  $size = $_GET['size'];
}
else {
  $size = '';
}

if (isset($_SESSION['total']) && isset($_SESSION['cart'])) {
  $total = $_SESSION['total'];
  $cart = $_SESSION['cart'];
}
else {
  $total = array();
  $cart = array();
}

if (isset($_SESSION['change'])) {
  $change = $_SESSION['change'];
}
else {
  $change = '';
}

if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
}
else {
  $error = '';
}

render('templates/header', array('title' => $title));

$path = __DIR__ . '/../xml/menu.xml';
if (file_exists($path)) {
  $xml = simplexml_load_file($path);
  if ($page == 'items') {
    $items = get_items($title, $xml);
    render('items', array('items' => $items, 'title' => $title));
  }
  else if ($page == 'item') {
    $item = get_item($name, $size, $xml);
    render('item', array('item' => $item, 'title' => $title, 'name' => $name));
  }
  else if ($page == 'cart') {
    render('cart', array('cart' => $cart, 'change' => $change));
  }
  else {
    $items = array();
    render('items', array('items' => $items));
  }
}
else {
  $xml = 'Error loading menu.';
  $items = array();
  render('items', array('items' => $items));
}

render('menu', array('xml' => $xml, 'title' => $title));
render('right', array('total' => $total));
render('templates/footer');