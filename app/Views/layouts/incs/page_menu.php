<?php /** @var array $pages */ ?>
<ul class="list-unstyled">
    <li><a href="<?= base_url() ?>">Главная</a></li>
    <?php foreach ($pages as $page): ?>
        <li><a href="<?= route_to('page.show', $page['slug']) ?>"><?= $page['title'] ?></a></li>
    <?php endforeach; ?>
</ul>

