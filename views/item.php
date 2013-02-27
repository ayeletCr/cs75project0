<div class="col1">
  <h2><?php echo $name ?></h2>
  <form action="form.php" method="post" >

    <?php if ($item['description']): ?>
      <?php echo $item['description'] ?>
    <?php endif ?>

    <ul>
      <?php foreach ($item['size'] as $size => $price): ?>
      <li><?php echo $size . ": $" . number_format(($price / 100), 2) ?>
        <input type="number" min="0" max="99" name="number" value="1" required>
        <input type="hidden" name="name" value="<?php echo $size . ' ' . $name ?>">
        <input type="hidden" name="price" value="<?php echo $price ?>">
      </li>
    <?php endforeach ?>

    <?php foreach ($item['extras'] as $extra => $price): ?>
      <?php if ($price != 0): ?>
        <li><?php echo $extra . ": add $" . number_format(($price / 100), 2) ?>
          <input type="checkbox" name="<?php echo $extra ?>" value="<?php echo $price ?> ">
        </li>
      <?php endif ?>
    <?php endforeach ?>

  </ul>
    <input type="hidden" name="title" value="<?php echo $title ?>" >

    <input type="hidden" name="page" value="cart" >
    <input type="submit" name="submit" value="Add to Cart" >
  </form>
</div>