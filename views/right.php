<div class="col3">
  <?php if ($total): ?>
  <ul>
    <li>Order Total: <?php echo '$' . htmlspecialchars(number_format(($total / 100), 2)) ?></li>
    <li><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "?page=cart" ?>">View Cart</a></li>
  </ul>
  <?php else: ?>
    Cart is empty.
  <?php endif ?>
</div>