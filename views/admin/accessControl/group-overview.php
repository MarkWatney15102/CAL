<?php
use src\Model\AccessControlGroup\AccessControlGroup;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Gruppen Verwaltung (ACG)</h4>
                <a href="/admin/ac/group/edit/0" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Neue Gruppe erstellen</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    <?php foreach ($this->groups as $groups): ?>
                        <?php if ($groups instanceof AccessControlGroup): ?>

                            <tr>
                                <td><?= $groups->getID() ?></td>
                                <td><?= $groups->getName() ?></td>
                                <td>
                                    <a href="/admin/ac/group/edit/<?= $groups->getID() ?>" class="btn btn-outline-primary">Bearbeiten</a>
                                </td>
                            </tr>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <?= \lib\View\View::load('admin/admin-navbar') ?>
</div>