<div class="col1">
  <ul>
    <?php foreach ($query as $item): ?>
      <li><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "?page=item&title=" . urlencode($item) ?>"><?php echo htmlspecialchars($item) ?></a></li>
    <?php endforeach ?>
  </ul>
</div>