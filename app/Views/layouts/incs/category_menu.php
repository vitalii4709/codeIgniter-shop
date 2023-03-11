<?php /** @var array $categories */ ?>
<?php foreach ($categories as $category): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?= route_to('category.show', $category['slug']) ?>"><?= $category['title'] ?></a>
    </li>
<?php endforeach; ?>

