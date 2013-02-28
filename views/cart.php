<div class="col1">

  <?php echo $change ?>
  <?php echo $error ?>
  <ul>
  <?php foreach ($cart as $name => $price): ?>
    <li>
      <?php echo htmlspecialchars($name) . " $" . htmlspecialchars(number_format(($price['number'] * $price['price'] / 100), 2)) ?>
        <ul>
          <form action="form.php" method="post" >
            <li><input type="number" min="0" max="99" name="number" value="<?php echo htmlspecialchars($price['number']) ?>" >
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name) ?>">
            <input type="submit" name="update" value="Update Quantity" ></li>
          </form>
          <form action="form.php" method="post" >
            <li><input type="submit" name="remove" value="Remove Item" >
            <input type="hidden" name="number" value="1" >
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($name) ?>"</li>
          </form>
        </ul>
    </li>
  <?php endforeach ?>
  </ul>
  <form action="form.php" method="post" >
    <input type="submit" name="checkout" value="Checkout" >
  </form>
</div>
