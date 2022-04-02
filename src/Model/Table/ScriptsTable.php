<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Scripts Model
 *
 * @property \App\Model\Table\InstrumentsTable&\Cake\ORM\Association\HasMany $Instruments
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 *
 * @method \App\Model\Entity\Script newEmptyEntity()
 * @method \App\Model\Entity\Script newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Script[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Script get($primaryKey, $options = [])
 * @method \App\Model\Entity\Script findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Script patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Script[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Script|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Script saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Script[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Script[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Script[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Script[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class ScriptsTable extends Table
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

        $this->setTable('scripts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Instruments', [
            'foreignKey' => 'script_id',
        ]);
        $this->hasMany('Results', [
            'foreignKey' => 'script_id',
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
            ->scalar('location')
            ->maxLength('location', 255)
            ->allowEmptyString('location');

        $validator
            ->scalar('command')
            ->maxLength('command', 255)
            ->allowEmptyString('command');

        return $validator;
    }
}
