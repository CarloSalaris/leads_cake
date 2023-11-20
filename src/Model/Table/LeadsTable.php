<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Leads Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\LeadOffersTable&\Cake\ORM\Association\HasOne $LeadOffers
 *
 * @method \App\Model\Entity\Lead newEmptyEntity()
 * @method \App\Model\Entity\Lead newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lead[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lead get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lead findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lead patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lead[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lead|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lead saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lead[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lead[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lead[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lead[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LeadsTable extends Table
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

        $this->setTable('leads');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
        ]);
        $this->hasMany('LeadOffers', [
            'foreignKey' => 'lead_id',
            'dependent' => true,
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->integer('client_id')
            ->allowEmptyString('client_id');

        $validator
            ->scalar('ragione_sociale')
            ->maxLength('ragione_sociale', 255)
            ->allowEmptyString('ragione_sociale');

        $validator
            ->email('email')
            ->allowEmptyString('email');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 11)
            ->allowEmptyString('telefono');

        $validator
            ->scalar('tipo_soggetto')
            ->maxLength('tipo_soggetto', 1)
            ->allowEmptyString('tipo_soggetto')
            ->inList('tipo_soggetto', ['P', 'G', 'D'], 'Please enter a valid tipo_soggetto (P, G, or D).');

        return $validator;
    }

   /*  public function findReport(Query $query, array $options): Query
    {
        return $query->contain([
        ]);
    }

    public function findAssociations(Query $query, array $options): Query
    {
        return $query->contain([
        ]);
    }
 */
    public function findIndex(Query $query, array $options): Query
    {
        return $query->contain([
            'Users',
            /* 'LeadOffers',
            'Clients', */
        ]);
    }

    public function findFull(Query $query, array $options): Query
    {
        return $query->contain([
            'Users',
            'LeadOffers',
            'Clients',
        ]);
    }

    public function findFilters(Query $query, array $options): Query
    {
        if ($options['notClient'] ?? null) {
            $query->find('notClient');
        }
        if ($options['giuridico'] ?? null) {
            $query->find('giuridico');
        }
        if ($options['privato'] ?? null) {
            $query->find('privato');
        }
        return $query;
    }
    //FILTRI
    public function findPrivato(Query $query, array $options): Query
    {
        return $query->where(['tipo_soggetto' => 'P']);
    }
    public function findGiuridico(Query $query, array $options): Query
    {
        return $query->where(['tipo_soggetto' => 'G']);
    }
    public function findNotClient(Query $query, array $options): Query
    {
        return $query->where(['Clients.id IS NULL']);
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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);

        return $rules;
    }


}
