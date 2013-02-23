<?php session_start() ?>
<!DOCTYPE html >
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width" charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/css.css" media="screen" />
  <title><?php echo htmlspecialchars($title) ?></title>

</head>
<body>
  <div id="header">
    <h1><?php echo htmlspecialchars($title) ?></h1>
  </div>
  <div class="colmask threecol">
    <div class="colmid">
      <div class="colleft">
