<?php

use src\Model\StorageItem\StorageItem;

/** @var StorageItem[] $items */
$items = $this->items;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Artikel Liste</h4>
                <a href="/storage/item/0" class="btn btn-outline-success">Artikel anlegen</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>EAN</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?= $item->getID() ?></td>
                            <td><?= $item->getName() ?></td>
                            <td><a href="/storage/item/<?= $item->getID() ?>" class="btn btn-outline-primary">Öffnen</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>