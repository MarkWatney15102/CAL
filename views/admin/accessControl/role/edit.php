<?php

use src\Model\AccessControlGroup\AccessControlGroup;

?>
<?= $this->form->open() ?>
    <div class="row">
        <div class="col-lg-9">
            <div class="row d-grid gap-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rolle bearbeiten</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <?= $this->form->getElement('roleName')->label() ?>
                                    <?= $this->form->getElement('roleName')->getHtml() ?>
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
                            <h4 class="card-title">Gruppen</h4>
                        </div>
                        <div class="card-body">
                           <div class="d-grid gap-2 col-lg-8 offset-2" id="changeGroup" data-role-id="<?= (int)$this->roleId ?>">
                               <?php
                               foreach ($this->groupList as $group) {
                                   $status = (int)$group['status'];
                                   $groupModel = $group['group'];

                                   $class = "btn-outline-danger";
                                   if ($status === 1) {
                                       $class = "btn-outline-success";
                                   }

                                   if ($groupModel instanceof AccessControlGroup) {
                                       echo <<<HTML
                                            <button type="button" 
                                                    class="btn {$class} changeGroup" 
                                                    data-status="{$status}"
                                                    data-group-id="{$groupModel->getID()}">
                                                {$groupModel->getName()}
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