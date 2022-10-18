<?php
use src\Model\StoragePlace\StoragePlace;

/** @var StoragePlace[] $places */
$places = $this->places;
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lagerorte</h4>
                <a href="/storage/place/0" class="btn btn-outline-success">Lagerort erstellen</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Lagerort</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($places as $place) { ?>
                        <tr>
                            <td><?= $place->getID() ?></td>
                            <td><?= $place->getName() ?></td>
                            <td><a href="/storage/place/<?= $place->getID() ?>" class="btn btn-outline-primary">Öffnen</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>