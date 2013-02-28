<?php
session_start();

require_once '../includes/functions.php';

$title = 'Project 0';
$page = '';
$error = '';
$name = '';
$size = '';
$items = array();
$total = array();
$cart = array();
$change = '';

if (isset($_GET['title'])) {
  $title = $_GET['title'];
}

if (isset($_GET['page'])) {
  $page = $_GET['page'];
}

if (isset($_SESSION['error'])) {
  $error = $_SESSION['error'];
  unset($_SESSION['error']);
}

if (isset($_SESSION['total']) && isset($_SESSION['cart'])) {
  $total = $_SESSION['total'];
  $cart = $_SESSION['cart'];
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

    if (isset($_GET['name'])) {
      $name = $_GET['name'];
    }
    if (isset($_GET['size'])) {
      $size = $_GET['size'];
    }

    $item = get_item($name, $size, $xml);
    render('item', array('item' => $item, 'title' => $title, 'error' => $error));
  }
  else if ($page == 'cart') {

    if (isset($_SESSION['change'])) {
      $change = $_SESSION['change'];
      unset($_SESSION['change']);
    }
    render('cart', array('cart' => $cart, 'change' => $change, 'error' => $error));
  }
  else if ($page == 'checkout') {

    render('checkout', array('cart' => $cart, 'total' => $total));
    unset($_SESSION);
    session_destroy();
    $total = array();
  }
  else {
    render('items', array('items' => $items));
  }
}
else {
  $xml = 'Error loading menu.';
  render('items', array('items' => $items));
}

render('menu', array('xml' => $xml, 'title' => $title));
render('right', array('total' => $total));
render('templates/footer');