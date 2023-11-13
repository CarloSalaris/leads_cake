<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Clients'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Client'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="clients view content">
            <h3><?= h($client->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Lead') ?></th>
                    <td><?= $client->has('lead') ? $this->Html->link($client->lead->id, ['controller' => 'Leads', 'action' => 'view', $client->lead->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Ragione Sociale') ?></th>
                    <td><?= h($client->ragione_sociale) ?></td>
                </tr>
                <tr>
                    <th><?= __('P Iva') ?></th>
                    <td><?= h($client->p_iva) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codice Fiscale') ?></th>
                    <td><?= h($client->codice_fiscale) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($client->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($client->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($client->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
