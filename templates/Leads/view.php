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
            <?= $this->Html->link(__('Edit Lead'), ['action' => 'edit', $lead->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Lead'), ['action' => 'delete', $lead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lead->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Leads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Lead'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="leads view content">
            <h3><?= h($lead->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $lead->has('user') ? $this->Html->link($lead->user->username, ['controller' => 'Users', 'action' => 'view', $lead->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Client') ?></th>
                    <td><?= $lead->has('client') ? $this->Html->link($lead->client->id, ['controller' => 'Clients', 'action' => 'view', $lead->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ragione Sociale') ?></th>
                    <td><?= h($lead->ragione_sociale) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($lead->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefono') ?></th>
                    <td><?= h($lead->telefono) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tipo Soggetto') ?></th>
                    <td><?= h($lead->tipo_soggetto) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lead Offer') ?></th>
                    <td><?= $lead->has('lead_offer') ? $this->Html->link($lead->lead_offer->id, ['controller' => 'LeadOffers', 'action' => 'view', $lead->lead_offer->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lead->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($lead->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($lead->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
