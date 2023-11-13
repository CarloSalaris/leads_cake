<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LeadOffer $leadOffer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Lead Offer'), ['action' => 'edit', $leadOffer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lead Offer'), ['action' => 'delete', $leadOffer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leadOffer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Lead Offers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lead Offer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leadOffers view content">
            <h3><?= h($leadOffer->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Lead') ?></th>
                    <td><?= $leadOffer->has('lead') ? $this->Html->link($leadOffer->lead->id, ['controller' => 'Leads', 'action' => 'view', $leadOffer->lead->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Marca') ?></th>
                    <td><?= h($leadOffer->marca) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modello') ?></th>
                    <td><?= h($leadOffer->modello) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($leadOffer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Km') ?></th>
                    <td><?= $leadOffer->km === null ? '' : $this->Number->format($leadOffer->km) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($leadOffer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($leadOffer->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
