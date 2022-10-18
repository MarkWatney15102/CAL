<?= $this->form->open() ?>
<?= $this->form->getElement('projectId')->getHtml() ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Auftrags Informationen zum neuen Auftrag</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('name')->label() ?>
                        <?= $this->form->getElement('name')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('description')->label() ?>
                        <?= $this->form->getElement('description')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('assignedUserId')->label() ?>
                        <?= $this->form->getElement('assignedUserId')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('creator')->label() ?>
                        <?= $this->form->getElement('creator')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('status')->label() ?>
                        <?= $this->form->getElement('status')->getHtml() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $this->form->getElement('childOf')->label() ?>
                        <?= $this->form->getElement('childOf')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $this->form->getElement('order')->label() ?>
                        <?= $this->form->getElement('order')->getHtml() ?>
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
