<div class="col-lg-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Bestellinformationen</h4>
        </div>
        <div class="card-body">
            <div class="col-lg-12 text-pull-right">
                <a href="/order/<?= $taskId ?? 0 ?>/0" class="no-decoration" title="Bestellung anlegen">
                    <img src="/images/icons/plus-square.svg" alt="Add" class="icon-big">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->getElement('orderId')->label() ?>
                    <div class="input-group mb-3">
                        <?= $form->getElement('orderId')->getHtml() ?>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="refreshOrderId" data-task-id="<?= $taskId ?>">Aktualisieren</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?= $form->getElement('information')->label() ?>
                    <?= $form->getElement('information')->getHtml() ?>
                </div>
            </div>
        </div>
    </div>
</div>