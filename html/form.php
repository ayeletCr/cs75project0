<?php

if (isset($_GET['small'])) {
  $_SESSION['cart'] = 1;
}

require 'index.php';