<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeadOffer $leadOffer
 * @var string[]|\Cake\Collection\CollectionInterface $leads
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $leadOffer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $leadOffer->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Lead Offers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leadOffers form content">
            <?= $this->Form->create($leadOffer) ?>
            <fieldset>
                <legend><?= __('Edit Lead Offer') ?></legend>
                <?php
                    echo $this->Form->control('lead_id', ['options' => $leads]);
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
