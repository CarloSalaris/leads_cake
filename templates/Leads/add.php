<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lead $lead
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Leads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leads form content">
            <?= $this->Form->create($lead) ?>
            <fieldset>
                <legend><?= __('Add Lead') ?></legend>
                <?php
                    echo $this->Form->control('ragione_sociale');
                    echo $this->Form->control('email');
                    echo $this->Form->control('telefono');
                    echo $this->Form->control('tipo_soggetto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
