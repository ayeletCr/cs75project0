<?php
session_start();

require_once '../includes/functions.php';

$error = '';

if (isset($_POST['submit'])) {

  if (!isset($_POST['number']) ||
          !isset($_POST['price']) ||
          !isset($_POST['title']) ||
          !isset($_POST['name']) ||
          !isset($_POST['page'])) {
    $error = 'Error processing form.';
  }
  else {
    $number = $_POST['number'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $name = $_POST['name'];
    $page = $_POST['page'];
  }

    if (isset($_SESSION['cart'][$name])) {
      $_SESSION['cart'][$name]['number'] += $number;
    }
    else {
      $_SESSION['cart'][$name]['number'] = $number;
      $_SESSION['cart'][$name]['price'] = $price;
    }

    $price *= $number;
    if (!isset($_SESSION['total'])) {
      $_SESSION['total'] = $price;
    }
    else {
      $_SESSION['total'] += $price;
    }

    $_SESSION['change'] = 'You added ' . $number . ' ' . $name . ' to your cart.';


}
elseif (isset($_POST['update'])) {

  if (!isset($_POST['number']) || !isset($_POST['name'])) {
    $error = 'Error processing form.';
  }
  else {
    $number = $_POST['number'];
    $name = $_POST['name'];

    $_SESSION['total'] -= $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];
    $_SESSION['cart'][$name]['number'] = $number;
    $_SESSION['total'] += $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];
  }

  $_SESSION['change'] = 'You updated ' . $name . ' and now you have ' . $number . ' in your cart.';

}
elseif (isset($_POST['remove'])) {
print 1;
  print_r($_POST);
  if (!isset($_POST['name'])) {
    $error = 'Error processing form.';
  }
  else {
    $name = $_POST['name'];

    $_SESSION['total'] -= $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];
    unset($_SESSION['cart'][$name]);
  }

  $number = 1;
  $_SESSION['change'] = 'You removed ' . $name . ' from your cart.';

}

  if ($number == '') {
    $error = 'The quantity field is required.';
  }
  elseif ($number < 1) {
    $error = 'The quantity must not be less then 1.';
  }

  if ($error != '') {
    $_SESSION['error'] = $error;
    $path = "http://" . $_SERVER['HTTP_HOST'] . "?page=error";
    header('Location: ' . $path);
  }
  else {

    $path = "http://" . $_SERVER['HTTP_HOST'] . "?page=cart";
    header('Location: ' . $path);
  }