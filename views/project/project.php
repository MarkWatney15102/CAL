<?php

use src\Model\ProjectProcess\ProjectProcess;

?>
<?= $this->form->open() ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Projekt Informationen</h4>
                <a href="/project/<?= $this->projectId ?>/summary" target="_blank" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Projekt Zusammenfassung erstellen</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?= $this->form->getElement('title')->label() ?>
                        <?= $this->form->getElement('title')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $this->form->getElement('description')->label() ?>
                        <?= $this->form->getElement('description')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('start')->label() ?>
                        <?= $this->form->getElement('start')->getHtml() ?>
                    </div>
                    <div class="col-6">
                        <?= $this->form->getElement('end')->label() ?>
                        <?= $this->form->getElement('end')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('creator_user_id')->label() ?>
                        <?= $this->form->getElement('creator_user_id')->getHtml() ?>
                    </div>
                    <div class="col-6">
                        <?= $this->form->getElement('current_worker_user_id')->label() ?>
                        <?= $this->form->getElement('current_worker_user_id')->getHtml() ?>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('status')->label() ?>
                        <?= $this->form->getElement('status')->getHtml() ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('save')->getHtml() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Projekt Zahlen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('sollCount')->label() ?>
                        <?= $this->form->getElement('sollCount')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('istCount')->label() ?>
                        <?= $this->form->getElement('istCount')->getHtml() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Aufträge</h4>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-pull-right">
                    <a href="/task/<?= $this->projectId ?>/0" class="no-decoration" title="Auftrag erstellen">
                        <img src="/images/icons/plus-square.svg" alt="Add" class="icon-big">
                    </a>
                </div>
                <br>
                <div class="col-lg-12">
                    <table id="jobList" class="display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Aktionen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= (!empty($this->tableFields)) ? $this->tableFields : '' ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Aktive Prozesse</h4>
                <a href="/project/<?= $this->projectId ?>/process/start" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Neuen Process starten</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Aktionen</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var ProjectProcess[] $processes */
                    $processes = $this->projectProcesses;
                    foreach ($processes as $process) { ?>
                        <tr>
                            <td><?= $process->getID() ?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->form->close() ?>