<?php

use src\Model\AccessControlPermission\AccessControlPermission;

?>
<?= $this->form->open() ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="row d-grid gap-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gruppe bearbeiten</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <?= $this->form->getElement('groupName')->label() ?>
                                    <?= $this->form->getElement('groupName')->getHtml() ?>
                                </div>
                                <div class="col-lg-4">
                                    <div class="d-grid">
                                        <label>&nbsp;</label>
                                        <?= $this->form->getElement('save')->getHtml() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Berechtigungen</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2 col-lg-8 offset-2" id="changePermission" data-group-id="<?= (int)$this->groupId ?>">
                                <?php
                                foreach ($this->permissionList as $permission) {
                                    $status = (int)$permission['status'];
                                    $permissionModel = $permission['permission'];

                                    $class = "btn-outline-danger";
                                    if ($status === 1) {
                                        $class = "btn-outline-success";
                                    }

                                    if ($permissionModel instanceof AccessControlPermission) {
                                        echo <<<HTML
                                            <button type="button" 
                                                    class="btn {$class} changePermission" 
                                                    data-status="{$status}"
                                                    data-permission-id="{$permissionModel->getID()}">
                                                {$permissionModel->getName()}
                                            </button>
                                        HTML;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= \lib\View\View::load('admin/admin-navbar') ?>
    </div>
<?= $this->form->close() ?>