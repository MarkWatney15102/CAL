<?php

use src\Model\StorageItem\StorageItem;

/** @var StorageItem $item */
$item = $this->item;
?>
<?= $this->form->open() ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?= (!empty($item->getName())) ? $item->getName() : "Neuer Artikel" ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->form->getElement('name')->label() ?>
                            <?= $this->form->getElement('name')->getHtml() ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->form->getElement('ean')->label() ?>
                            <?= $this->form->getElement('ean')->getHtml() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->form->getElement('description')->label() ?>
                            <?= $this->form->getElement('description')->getHtml() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->form->getElement('save')->getHtml() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->form->open() ?>