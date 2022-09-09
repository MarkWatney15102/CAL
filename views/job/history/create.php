<?= $this->form->open() ?>
<?= $this->form->getElement('jobId')->getHtml() ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Historie erstellen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('type')->label() ?>
                        <?= $this->form->getElement('type')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('message')->label() ?>
                        <?= $this->form->getElement('message')->getHtml() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->form->close() ?>