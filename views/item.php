<div class="col1">
  <h2><?php echo htmlspecialchars($item['name']) ?></h2>
  <form action="form.php" method="post" >
    <?php if ($item['description']): ?>
      <?php echo htmlspecialchars($item['description']) ?>
    <?php endif ?>

    <ul>
      <?php foreach ($item['size'] as $size => $price): ?>
      <li><?php echo htmlspecialchars($size . ": $" . number_format(($price / 100), 2)) ?>
        <input type="number" min="1" max="99" name="number" value="1" required>
        <input type="hidden" name="name" value="<?php echo $name ?>">
        <input type="hidden" name="size" value="<?php echo $size ?>">
        <input type="hidden" name="price" value="<?php echo $price ?>">
      </li>
    <?php endforeach ?>

    <?php foreach ($item['extras'] as $extra => $price): ?>
      <?php if ($price != 0): ?>
        <li><?php echo htmlspecialchars($extra . ": add $" . number_format(($price / 100), 2)) ?>
          <input type="checkbox" name="extra" value="<?php echo $extra ?> ">
          <input type="hidden" name="extraprice" value="<?php echo $price ?>">
        </li>
      <?php endif ?>
    <?php endforeach ?>

  </ul>
    <input type="hidden" name="title" value="<?php echo $title ?>" >
    <?php if ($item['name'] != 'Item not found.'): ?>
      <input type="submit" name="submit" value="Add to Cart" >
    <?php endif ?>
  </form>
  <?php echo $error ?>
</div>