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
            <div class="related">
                <h4><?= __('Related Leads') ?></h4>
                <?php if (!empty($client->leads)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Client Id') ?></th>
                            <th><?= __('Ragione Sociale') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Telefono') ?></th>
                            <th><?= __('Tipo Soggetto') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($client->leads as $leads) : ?>
                        <tr>
                            <td><?= h($leads->id) ?></td>
                            <td><?= h($leads->user_id) ?></td>
                            <td><?= h($leads->client_id) ?></td>
                            <td><?= h($leads->ragione_sociale) ?></td>
                            <td><?= h($leads->email) ?></td>
                            <td><?= h($leads->telefono) ?></td>
                            <td><?= h($leads->tipo_soggetto) ?></td>
                            <td><?= h($leads->created) ?></td>
                            <td><?= h($leads->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Leads', 'action' => 'view', $leads->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Leads', 'action' => 'edit', $leads->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Leads', 'action' => 'delete', $leads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leads->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
