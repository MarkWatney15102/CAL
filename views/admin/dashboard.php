<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Benutzerliste</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /** @var \src\Model\User\User $user */
                        foreach ($this->userList as $user) { ?>
                            <tr>
                                <td><?= $user->getID() ?></td>
                                <td><?= $user->getFirstname() . " " . $user->getLastname() ?></td>
                                <td><a href="/admin/user/edit/<?= $user->getID() ?>" class="btn btn-outline-primary">Bearbeiten</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= \lib\View\View::load('admin/admin-navbar') ?>
</div>