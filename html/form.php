<?php
session_start();

require_once '../includes/functions.php';

$error = '';

if (!isset($_POST['number']) || !isset($_POST['name'])) {
  $error = 'Error processing form.';
}
else if ($_POST['number'] == '') {
  $error = 'The quantity field is required.';
}
else if ($_POST['number'] < 1) {
  if ($_POST['number'] == 0 && isset($_POST['update'])) {
    $_POST['remove'] = 'Remove Item';
    unset($_POST['update']);
  }
  else {
    $error = 'The quantity must not be less then 1.';
  }
}

if (isset($_POST['checkout'])) {
  $path = "http://" . $_SERVER['HTTP_HOST'] . '?page=checkout&title=Checkout';
  header('Location: ' . $path);
  exit();
}

if ($error != '' && !isset($_POST['submit'])) {
  $_SESSION['error'] = $error;

  $path = "http://" . $_SERVER['HTTP_HOST'] . '?page=cart&title=Cart';
  header('Location: ' . $path);
  exit();
}

if (isset($_POST['submit'])) {

  $number = $_POST['number'];
  $price = $_POST['price'];
  $title = $_POST['title'];
  $name = $_POST['name'];
  $size = $_POST['size'];

  if ($number == 1) {
    $title = substr($title, 0, -1);
  }
  $item = $size . ' ' . $name . ' ' . $title;

  if (isset($_POST['extra'])) {
    $item = $item . ' with ' . $_POST['extra'];
    $price += $_POST['extraprice'];
  }

  if ($error != '') {
    $_SESSION['error'] = $error;
    $path = 'http://' . $_SERVER['HTTP_HOST'] . '?page=item&title=' . $title . '&name=' . $name . '&size=' . $size;
    header('Location: ' . $path);
    exit();
  }

  if (isset($_SESSION['cart'][$item])) {
    $_SESSION['cart'][$item]['number'] += $number;
  }
  else {
    $_SESSION['cart'][$item]['number'] = $number;
    $_SESSION['cart'][$item]['price'] = $price;
  }

  $price *= $number;
  if (!isset($_SESSION['total'])) {
    $_SESSION['total'] = $price;
  }
  else {
    $_SESSION['total'] += $price;
  }

    $_SESSION['change'] = 'You added ' . $number . ' ' . $item . ' to your cart.';
  }

else if (isset($_POST['update']) && $error == '') {

  $number = $_POST['number'];
  $name = $_POST['name'];

  $_SESSION['total'] -= $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];
  $_SESSION['cart'][$name]['number'] = $number;
  $_SESSION['total'] += $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];

  $_SESSION['change'] = 'You updated ' . $name . ' and now you have ' . $number . ' in your cart.';
}
else if (isset($_POST['remove']) && $error == '') {

  $name = $_POST['name'];

  $_SESSION['total'] -= $_SESSION['cart'][$name]['price'] * $_SESSION['cart'][$name]['number'];
  unset($_SESSION['cart'][$name]);

  $_SESSION['change'] = 'You removed ' . $name . ' from your cart.';
}

$path = "http://" . $_SERVER['HTTP_HOST'] . '?page=cart&title=Cart';
header('Location: ' . $path);