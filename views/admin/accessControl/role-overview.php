<?php
use src\Model\AccessControlRole\AccessControlRole;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rollen Verwaltung (ACR)</h4>
                <a href="/admin/ac/role/edit/0" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Neue Rolle erstellen</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    <?php foreach ($this->roles as $role): ?>
                        <?php if ($role instanceof AccessControlRole): ?>

                        <tr>
                            <td><?= $role->getID() ?></td>
                            <td><?= $role->getName() ?></td>
                            <td>
                                <a href="/admin/ac/role/edit/<?= $role->getID() ?>" class="btn btn-outline-primary">Bearbeiten</a>
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