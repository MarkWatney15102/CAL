<?= $this->form->open() ?>
<?= $this->form->getElement('projectId')->getHtml() ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Auftrags Informationen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('title')->label() ?>
                        <?= $this->form->getElement('title')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('sollCount')->label() ?>
                        <?= $this->form->getElement('sollCount')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('istCount')->label() ?>
                        <?= $this->form->getElement('istCount')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('currentWorker')->label() ?>
                        <?= $this->form->getElement('currentWorker')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('creatorUser')->label() ?>
                        <?= $this->form->getElement('creatorUser')->getHtml() ?>
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
</div>
<?= $this->form->close() ?>
