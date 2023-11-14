<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LeadOffer Entity
 *
 * @property int $id
 * @property int $lead_id
 * @property string|null $marca
 * @property string|null $modello
 * @property int|null $km
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Lead $lead
 */
class LeadOffer extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'lead_id' => true,
        'marca' => true,
        'modello' => true,
        'km' => true,
        'created' => true,
        'modified' => true,
        'lead' => true,
    ];
}
