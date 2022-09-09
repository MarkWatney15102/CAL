<?= $this->form->open() ?>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Benutzerdaten</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('username')->label() ?>
                        <?= $this->form->getElement('username')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('password')->label() ?>
                        <?= $this->form->getElement('password')->getHtml() ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('sure')->getHtml() ?>
                        <?= $this->form->getElement('sure')->label() ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('save')->getHtml() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        Fileuploader
    </div>
</div>
<?= $this->form->close() ?>