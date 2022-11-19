<?php

use src\Model\StoragePlace\StoragePlace;

/** @var StoragePlace $place */
$place = $this->place;
?>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= (!empty($place->getName())) ? $place->getName() : "Neuer Lagerort" ?></h4>
            </div>
            <div class="card-body">
                <?= $this->form->open() ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('name')->label() ?>
                        <?= $this->form->getElement('name')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('save')->getHtml() ?>
                    </div>
                </div>
                <?= $this->form->open() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Artikel Einbuchen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="ean">EAN des Artikels</label>
                        <input type="text" name="ean" id="ean" class="form-control" placeholder="EAN">
                    </div>
                    <div class="col-lg-6">
                        <label for="amount">Anzahl</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <label for="row">Reihe</label>
                        <input type="number" name="row" id="row" class="form-control" placeholder="Reihe im Lager">
                    </div>
                    <div class="col-lg-6">
                        <label for="position">Fach</label>
                        <input type="number" name="position" id="position" class="form-control"
                               placeholder="Fach in der Reihe">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-outline-success" id="bookIn"
                                data-place="<?= $place->getID() ?>">Einbuchen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Artikel</h4>
            </div>
            <div class="card-body">
                <table class="table" id="bookout">
                    <thead>
                    <tr>
                        <th>EAN</th>
                        <th>Name</th>
                        <th>Anzahl</th>
                        <th>Reihe</th>
                        <th>Fach</th>
                        <th>Ausbuchen Anzahl</th>
                        <th>Ausbuchen</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($this->items)) {
                        foreach ($this->items as $item) {
                            $id = 'bookoutAmount' . $item['item']->getID() . "_" . $item['mapping']->getRow() . "_" . $item['mapping']->getPosition();
                            ?>
                            <tr>
                                <td><?= $item['item']->getID() ?></td>
                                <td><?= $item['item']->getName() ?></td>
                                <td><?= $item['mapping']->getAmount() ?></td>
                                <td><?= $item['mapping']->getRow() ?></td>
                                <td><?= $item['mapping']->getPosition() ?></td>
                                <td>
                                    <input type="number" class="form-control"
                                           id="<?= $id ?>" min="0"
                                           max="<?= $item['mapping']->getAmount() ?>" value="0">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success bookoutButton"
                                            data-ean="<?= $item['item']->getID() ?>"
                                            data-place="<?= $place->getID() ?>"
                                            data-row="<?= $item['mapping']->getRow() ?>"
                                            data-position="<?= $item['mapping']->getPosition() ?>">
                                        Ausbuchen
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
