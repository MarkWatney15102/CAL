<?php
/** @var \src\Model\User\User $user */
$user = $this->user;
?>
<?= $this->form->open() ?>
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Benutzer "<?= $user->getFirstname() . " " . $user->getLastname() ?>" bearbeiten</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('username')->label() ?>
                        <?= $this->form->getElement('username')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('email')->label() ?>
                        <?= $this->form->getElement('email')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('firstname')->label() ?>
                        <?= $this->form->getElement('firstname')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('lastname')->label() ?>
                        <?= $this->form->getElement('lastname')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('level')->label() ?>
                        <?= $this->form->getElement('level')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('role')->label() ?>
                        <?= $this->form->getElement('role')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('submit')->getHtml() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= \lib\View\View::load('admin/admin-navbar') ?>
</div>
<?= $this->form->close() ?>