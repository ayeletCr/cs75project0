<div class="col1">
  <form action="form.php" method="get" >
  <ul>
    <?php if ($query['description']): ?>
      <li><?php echo $query['description'] ?></li>
    <?php endif ?>
    <?php foreach ($query['size'] as $size => $price): ?>
      <li><?php echo $size . ": $" . number_format(($price / 100), 2) ?>
      <input type="number" min="0" max="99" name="<?php echo $size ?>" value="">
      <input type="hidden" name="<?php echo $size?>" value="<?php echo $price ?>">
      </li>
    <?php endforeach ?>
    <?php foreach ($query['extras'] as $extra => $price): ?>
      <li><?php echo $extra . ": add $" . number_format(($price / 100), 2) ?>
      <input type="checkbox" name="<?php echo $extra ?>" value="">
      </li>
    <?php endforeach ?>
  </ul>
    <input type="hidden" name="title" value="<?php echo $title?>" >
    <input type="hidden" name="page" value="item" >
    <input type="submit" value="Add to Cart" >
  </form>
</div>