<div class="row">
    <div class="col-lg-12 text-pull-right">
        <a href="/project/new" class="no-decoration" title="Projekt erstellen">
            <img src="/images/icons/plus-square.svg" alt="Add" class="icon-big">
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <table id="projectList" class="display">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?= (!empty($this->tableFields)) ? $this->tableFields : '' ?>
            </tbody>
        </table>
    </div>
</div>