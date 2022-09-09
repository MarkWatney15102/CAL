<div class="row">
    <div class="col-md-6 offset-md-3" style="margin-top: 12%;">
        <div class="card">
            <div class="card-body">
                <?= $this->form->open() ?>
                <?= $this->form->getElement('username')->label() ?>
                <?= $this->form->getElement('username')->getHtml() ?>
                <?= $this->form->getElement('password')->label() ?>
                <?= $this->form->getElement('password')->getHtml() ?>
                <br>
                <?= $this->form->getElement('login')->getHtml() ?>
                <?= $this->form->close() ?>
            </div>
        </div>
    </div>
</div>