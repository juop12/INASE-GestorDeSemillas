<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use ArrayObject;

/**
 * Samples Model
 *
 * @property \App\Model\Table\ResultsTable&\Cake\ORM\Association\HasMany $Results
 *
 * @method \App\Model\Entity\Sample newEmptyEntity()
 * @method \App\Model\Entity\Sample newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Sample> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sample get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Sample findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Sample patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Sample> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sample|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Sample saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Sample>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Sample>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Sample>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Sample> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Sample>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Sample>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Sample>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Sample> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SamplesTable extends Table
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

        $this->setTable('samples');
        $this->setDisplayField('codigo_muestra');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Results', [
            'foreignKey' => 'sample_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
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
            ->scalar('numero_precinto')
            ->maxLength('numero_precinto', 100)
            ->requirePresence('numero_precinto', 'create')
            ->notEmptyString('numero_precinto');

        $validator
            ->scalar('empresa')
            ->maxLength('empresa', 255)
            ->requirePresence('empresa', 'create')
            ->notEmptyString('empresa');

        $validator
            ->scalar('especie')
            ->maxLength('especie', 255)
            ->requirePresence('especie', 'create')
            ->notEmptyString('especie');

        $validator
            ->integer('cantidad_semillas')
            ->requirePresence('cantidad_semillas', 'create')
            ->notEmptyString('cantidad_semillas')
            ->greaterThan('cantidad_semillas', 0);

        return $validator;
    }

    /**
     * Generate codigo_muestra before saving
     *
     * @param \Cake\Event\EventInterface $event The event object
     * @param \ArrayObject $data The data being saved
     * @param \ArrayObject $options The options for saving
     * @return void
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options): void
    {
        // Auto-generate codigo_muestra if not present
        if (!isset($data['codigo_muestra']) || empty($data['codigo_muestra'])) {
            $year = date('Y');
            
            // Get the last sample for this year
            $lastSample = $this->find()
                ->select(['codigo_muestra'])
                ->where(['codigo_muestra LIKE' => "MUE-{$year}-%"])
                ->orderBy(['id' => 'DESC'])
                ->first();
            
            if ($lastSample) {
                // Extract the number from the last code
                $parts = explode('-', $lastSample->codigo_muestra);
                $lastNumber = isset($parts[2]) ? (int)$parts[2] : 0;
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }
            
            // Generate the new codigo_muestra
            $data['codigo_muestra'] = sprintf('MUE-%s-%04d', $year, $nextNumber);
        }
    }
}
