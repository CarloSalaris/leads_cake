<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LeadOffers Model
 *
 * @property \App\Model\Table\LeadsTable&\Cake\ORM\Association\BelongsTo $Leads
 *
 * @method \App\Model\Entity\LeadOffer newEmptyEntity()
 * @method \App\Model\Entity\LeadOffer newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\LeadOffer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LeadOffer get($primaryKey, $options = [])
 * @method \App\Model\Entity\LeadOffer findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\LeadOffer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LeadOffer[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\LeadOffer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeadOffer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\LeadOffer[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeadOffersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('lead_offers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Leads', [
            'foreignKey' => 'leads_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('leads_id')
            ->notEmptyString('leads_id');

        $validator
            ->scalar('marca')
            ->maxLength('marca', 255)
            ->allowEmptyString('marca');

        $validator
            ->scalar('modello')
            ->maxLength('modello', 255)
            ->allowEmptyString('modello');

        $validator
            ->integer('km')
            ->allowEmptyString('km');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('leads_id', 'Leads'), ['errorField' => 'leads_id']);

        return $rules;
    }
}
