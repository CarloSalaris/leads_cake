<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeadOffer $leadOffer
 * @var \Cake\Collection\CollectionInterface|string[] $leads
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Lead Offers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leadOffers form content">
            <?= $this->Form->create($leadOffer) ?>
            <fieldset>
                <legend><?= __('Add Lead Offer') ?></legend>
                <?php
                    echo $this->Form->control('lead_id');
                    echo $this->Form->control('marca');
                    echo $this->Form->control('modello');
                    echo $this->Form->control('km');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
