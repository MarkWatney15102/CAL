<?= $this->form->open() ?>
<?= $this->form->getElement('taskId')->getHtml() ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Neue Bestellung anlegen</h4>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->form->getElement('supplier')->label() ?>
                            <?= $this->form->getElement('supplier')->getHtml() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->form->getElement('trackingCode')->label() ?>
                            <?= $this->form->getElement('trackingCode')->getHtml() ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->form->getElement('status')->label() ?>
                            <?= $this->form->getElement('status')->getHtml() ?>
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
</div>
<?= $this->form->close() ?>