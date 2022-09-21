<?php
use src\Model\AccessControlPermission\AccessControlPermission;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Berechtigungs Verwaltung (ACP)</h4>
                <a href="/admin/ac/permission/edit/0" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Neue Berechtigung erstellen</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    <?php foreach ($this->permissions as $permissions): ?>
                        <?php if ($permissions instanceof AccessControlPermission): ?>

                            <tr>
                                <td><?= $permissions->getID() ?></td>
                                <td><?= $permissions->getName() ?></td>
                                <td>
                                    <a href="/admin/ac/permission/edit/<?= $permissions->getID() ?>" class="btn btn-outline-primary">Bearbeiten</a>
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