<?php $pager->setSurroundCount(3) ?>

<?php if ($pager->getPageCount() > 1): ?>

    <ul class="pagination pagination-md m-0">
        <?php if ($pager->hasPreviousPage()): ?>
            <li class="page-item"><a class="page-link" href="<?= $pager->getFirst() ?>">&laquo;</a></li>
            <li class="page-item"><a class="page-link" href="<?= $pager->getPrevious() ?>">&lt;</a></li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
        <?php endforeach; ?>

        <?php if ($pager->hasNext()): ?>
            <li class="page-item"><a class="page-link" href="<?= $pager->getNext() ?>">&gt;</a></li>
            <li class="page-item"><a class="page-link" href="<?= $pager->getLast() ?>">&raquo;</a></li>
        <?php endif; ?>
    </ul>

<?php endif; ?>

