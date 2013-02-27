<div class="col2">
  <ul>
    <li><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>">Home</a></li>
    <?php if ($xml != 'Error loading menu.'): ?>
      <?php foreach ($xml->xpath('/menu/category/@title') as $category): ?>
        <?php if ($title != $category): ?>
    <li><a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "?page=items&title=" . urlencode($category) ?>"><?php echo htmlspecialchars($category) ?></a></li>
        <?php else: ?>
          <li><?php echo htmlspecialchars($category) ?></li>
        <?php endif ?>
      <?php endforeach ?>
    <?php else: ?>
      <?php echo $xml ?>
    <?php endif ?>
  </ul>
</div>
