<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Instruments Model
 *
 * @property \App\Model\Table\ScriptsTable&\Cake\ORM\Association\BelongsTo $Scripts
 * @property \App\Model\Table\AnswersTable&\Cake\ORM\Association\HasMany $Answers
 * @property \App\Model\Table\EvaluationsTable&\Cake\ORM\Association\HasMany $Evaluations
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 * @property \App\Model\Table\SectionsTable&\Cake\ORM\Association\HasMany $Sections
 *
 * @method \App\Model\Entity\Instrument newEmptyEntity()
 * @method \App\Model\Entity\Instrument newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Instrument[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Instrument get($primaryKey, $options = [])
 * @method \App\Model\Entity\Instrument findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Instrument patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Instrument[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Instrument|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instrument saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Instrument[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class InstrumentsTable extends Table
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

        $this->setTable('instruments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Scripts', [
            'foreignKey' => 'script_id',
        ]);
        $this->hasMany('Answers', [
            'foreignKey' => 'instrument_id',
        ]);
        $this->hasMany('Evaluations', [
            'foreignKey' => 'instrument_id',
        ]);
        $this->hasMany('Sales', [
            'foreignKey' => 'instrument_id',
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'instrument_id',
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('language')
            ->maxLength('language', 2)
            ->allowEmptyString('language');

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
        $rules->add($rules->existsIn(['script_id'], 'Scripts'), ['errorField' => 'script_id']);

        return $rules;
    }
}
