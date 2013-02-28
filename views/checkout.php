<div class="col1">
  Your order total was <?php echo '$' . htmlspecialchars(number_format(($total / 100), 2)) ?>
  <ul>
  <?php foreach ($cart as $name => $price): ?>
    <li>
      <?php echo htmlspecialchars($price['number']) . ' ' .htmlspecialchars($name) . ' $' . htmlspecialchars(number_format(($price['number'] * $price['price'] / 100), 2)) ?>
    </li>
  <?php endforeach ?>
  </ul>
</div>
