<?= $this->form->open() ?>
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rolle erstellen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <?= $this->form->getElement('roleName')->label() ?>
                        <?= $this->form->getElement('roleName')->getHtml() ?>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-grid">
                            <label for="">&nbsp;</label>
                            <?= $this->form->getElement('save')->getHtml() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= \lib\View\View::load('admin/admin-navbar') ?>
</div>
<?= $this->form->close() ?>