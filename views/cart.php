<div class="col1">

  <?php echo $change ?>
  <ul>
  <?php foreach ($cart as $name => $price): ?>
    <li>
      <?php echo htmlspecialchars($name) . " $" . htmlspecialchars(number_format(($price['number'] * $price['price'] / 100), 2)) ?>
      <form action="form.php" method="post" >
        <ul>
          <li><input type="number" min="1" max="99" name="number" value="<?php echo htmlspecialchars($price['number']) ?>">
          <input type="submit" name="update" value="Update Quantity" >
          <input type="submit" name="remove" value="Remove Item" >
          <input type="hidden" name="name" value="<?php echo htmlspecialchars($name) ?>"</li>
        </ul>
      </form>
    </li>
  <?php endforeach ?>
  </ul>
</div>
