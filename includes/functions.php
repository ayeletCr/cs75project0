<?php

function render($template, $data = array()) {
  $path = __DIR__ . '/../views/' . $template . '.php';
  if (file_exists($path)) {
    extract($data);
    require($path);
  }
}

function get_query($page, $title, $xml) {
  if ($page == 'items') {
    if ($title == 'Project 0') {
      $items = array();
      return $items;
    }
    $query = "/menu/category[@title='" . $title . "']/item";
    foreach ($xml->xpath($query) as $item) {
      $items[] = $item->name;
    }
    return $items;
  }
  elseif ($page == 'item') {
    $items = array();
    $items['extras'] = array();
    $query = '/menu/category/item[name="' . $title . '"]';
    foreach ($xml->xpath($query) as $item) {
      $items['name'] = (string)$item->name;
      $items['description'] = (string)$item->description;
    }
    $query = '/menu/category/item[name="' . $title . '"]/information[@size]';
    foreach ($xml->xpath($query) as $item) {
      $key = (string)$item['size'];
      $price = (int)$item['price'];
      $items['size'][$key] = $price;
    }
    $query = '/menu/category/item[name="' . $title . '"]/information[@extras]';
    foreach ($xml->xpath($query) as $item) {
      $key = (string)$item['extras'];
      $price = (int)$item['price'];
      $items['extras'][$key] = $price;
    }
    return $items;
  }
}