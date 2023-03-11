<?php
/** @var array $categories */
/** @var int $category_id */
?>
<?php foreach ($categories as $category): ?>
    <option value="<?= $category['id'] ?>" <?php if ($category_id == $category['id'] || old('category_id') == $category['id']) echo 'selected' ?>><?= $category['title'] ?></option>
<?php endforeach; ?>

