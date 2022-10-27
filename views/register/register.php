<div class="row">
    <div class="col-md-6 offset-md-3" style="margin-top: 12%;">
        <div class="card">
            <div class="card-body">
                <?= $this->form->open() ?>
                <?= $this->form->getElement('firstname')->label() ?>
                <?= $this->form->getElement('firstname')->getHtml() ?>
                <?= $this->form->getElement('lastname')->label() ?>
                <?= $this->form->getElement('lastname')->getHtml() ?>
                <?= $this->form->getElement('email')->label() ?>
                <?= $this->form->getElement('email')->getHtml() ?>
                <?= $this->form->getElement('password')->label() ?>
                <?= $this->form->getElement('password')->getHtml() ?>
                <br>
                <?= $this->form->getElement('register')->getHtml() ?>
                <?= $this->form->close() ?>
            </div>
        </div>
    </div>
</div>