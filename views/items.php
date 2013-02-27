<div class="col1">
  <ul>
    <?php foreach ($items as $item): ?>
      <li><?php echo htmlspecialchars($item->name) ?></li>
      <ul>
        <?php foreach ($item->size as $size ): ?>
          <li><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "?page=item&title=" . urlencode($title) . "&name=" . urlencode($item->name) . "&size=" . urlencode($size->attributes()->size) ?>"><?php echo htmlspecialchars($size->attributes()->size) . ": $" . number_format(($size->attributes()->price / 100), 2) ?></a></li>
        <?php endforeach ?>
      </ul>
    <?php endforeach ?>
  </ul>
</div>