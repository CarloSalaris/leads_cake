<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lead Entity
 *
 * @property int $id
 * @property int $users_id
 * @property string|null $ragione_sociale
 * @property string|null $email
 * @property string|null $telefono
 * @property string|null $tipo_soggetto
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Lead extends Entity
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
        'users_id' => true,
        'ragione_sociale' => true,
        'email' => true,
        'telefono' => true,
        'tipo_soggetto' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
