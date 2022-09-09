<?= $this->form->open() ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Projekt Informationen</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <?= $this->form->getElement('title')->label() ?>
                        <?= $this->form->getElement('title')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $this->form->getElement('description')->label() ?>
                        <?= $this->form->getElement('description')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('start')->label() ?>
                        <?= $this->form->getElement('start')->getHtml() ?>
                    </div>
                    <div class="col-6">
                        <?= $this->form->getElement('end')->label() ?>
                        <?= $this->form->getElement('end')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('creator_user_id')->label() ?>
                        <?= $this->form->getElement('creator_user_id')->getHtml() ?>
                    </div>
                    <div class="col-6">
                        <?= $this->form->getElement('current_worker_user_id')->label() ?>
                        <?= $this->form->getElement('current_worker_user_id')->getHtml() ?>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $this->form->getElement('status')->label() ?>
                        <?= $this->form->getElement('status')->getHtml() ?>
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