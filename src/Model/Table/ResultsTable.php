<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Results Model
 *
 * @property \App\Model\Table\SamplesTable&\Cake\ORM\Association\BelongsTo $Samples
 *
 * @method \App\Model\Entity\Result newEmptyEntity()
 * @method \App\Model\Entity\Result newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Result> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Result get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Result findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Result patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Result> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Result|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Result saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Result>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Result> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResultsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('results');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Samples', [
            'foreignKey' => 'sample_id',
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
            ->integer('sample_id')
            ->requirePresence('sample_id', 'create')
            ->notEmptyString('sample_id');

        $validator
            ->decimal('poder_germinativo')
            ->requirePresence('poder_germinativo', 'create')
            ->notEmptyString('poder_germinativo')
            ->greaterThanOrEqual('poder_germinativo', 0)
            ->lessThanOrEqual('poder_germinativo', 100);

        $validator
            ->decimal('pureza')
            ->requirePresence('pureza', 'create')
            ->notEmptyString('pureza')
            ->greaterThanOrEqual('pureza', 0)
            ->lessThanOrEqual('pureza', 100);

        $validator
            ->scalar('materiales_inertes')
            ->allowEmptyString('materiales_inertes');

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
        $rules->add($rules->existsIn('sample_id', 'Samples'), ['errorField' => 'sample_id']);

        return $rules;
    }
}
