<?php

function render($template, $data = array()) {
  $path = __DIR__ . '/../views/' . $template . '.php';
  if (file_exists($path)) {
    extract($data);
    require($path);
  }
}

function load($file, $data = array()) {
  $path = __DIR__ . '/../html/' . $file . '.php';
  if (file_exists($path)) {
    extract($data);
    require($path);
  }
}

function get_items($title, $xml) {

  if ($title == 'Project 0') {
    $items = array();
  }
  else {
    $query = "/menu/category[@title='" . $title . "']/item";
    foreach ($xml->xpath($query) as $item) {
      $items[] = $item;
    }
  }
  return $items;
}

function get_item($name, $size, $xml) {

  $items = array();

  $query = '/menu/category/item[name="' . $name . '"]';
  foreach ($xml->xpath($query) as $item) {
    $items['name'] = (string)$item->name;
    $items['description'] = (string)$item->description;
  }

  $query = '/menu/category/item[name="' . $name . '"]/size[@size="' . $size . '"]';
  foreach ($xml->xpath($query) as $item) {
    $key = (string)$item['size'];
    $price = (int)$item['price'];
    $items['size'][$key] = $price;
  }

  $query = '/menu/category/item[name="' . $name . '"]/size[@size="' . $size . '"]/extras';
  foreach ($xml->xpath($query) as $item) {
    $key = (string)$item['name'];
    $price = (int)$item['price'];
    $items['extras'][$key] = $price;
  }

  return $items;
}