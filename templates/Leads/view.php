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
                    <th><?= __('Client') ?></th>
                    <td><?= $lead->has('client') ? $this->Html->link($lead->client->id, ['controller' => 'Clients', 'action' => 'view', $lead->client->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($lead->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($lead->user_id) ?></td>
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
            <div class="related">
                <h4><?= __('Related Lead Offers') ?></h4>
                <?php if (!empty($lead->lead_offers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Lead Id') ?></th>
                            <th><?= __('Marca') ?></th>
                            <th><?= __('Modello') ?></th>
                            <th><?= __('Km') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($lead->lead_offers as $leadOffers) : ?>
                        <tr>
                            <td><?= h($leadOffers->id) ?></td>
                            <td><?= h($leadOffers->lead_id) ?></td>
                            <td><?= h($leadOffers->marca) ?></td>
                            <td><?= h($leadOffers->modello) ?></td>
                            <td><?= h($leadOffers->km) ?></td>
                            <td><?= h($leadOffers->created) ?></td>
                            <td><?= h($leadOffers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'LeadOffers', 'action' => 'view', $leadOffers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'LeadOffers', 'action' => 'edit', $leadOffers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'LeadOffers', 'action' => 'delete', $leadOffers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $leadOffers->id)]) ?>
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
