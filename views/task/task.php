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
                <div class="row">
                    <div class="col-lg-12">
                        <?= $this->form->getElement('save')->getHtml() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <a href="/task/<?= $this->taskId ?>/work-card" target="_blank" class="btn btn-outline-info" style="float: right; margin-top: -38px;">Arbeitsauftrag erstellen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= ($this->orderNeeded) ? \lib\View\View::load('task/order', ['form' => $this->form, 'taskId' => $this->taskId]) : "" ?>
</div>
<br>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Unteraufträge</h4>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-pull-right">
                    <a href="/task/<?= $this->projectId ?>/0" class="no-decoration" title="Auftrag erstellen">
                        <img src="/images/icons/plus-square.svg" alt="Add" class="icon-big">
                    </a>
                </div>
                <br>
                <table id="jobList" class="display">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?= (!empty($this->subTasksTable)) ? $this->subTasksTable : '' ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Benötigte Teile/Materialien</h4>
            </div>
            <div class="card-body">
                <button type="button" id="addMaterial" class="btn btn-outline-info" data-task-id="<?= $this->taskId ?>">Material hinzufügen</button>
                <div class='row'>
                    <div class='col-lg-4'><label for="resourceType">Material Name</label></div>
                    <div class='col-lg-4'><label for="resourceAmount">Anzahl</label></div>
                    <div class='col-lg-4'><label for="resourceAmount">Aktionen</label></div>
                </div>
                <?= $this->resourceFields ?>
            </div>
        </div>
    </div>
</div>
<?= $this->form->close() ?>
