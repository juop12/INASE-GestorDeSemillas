<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\Validation\Validator;
use Cake\Event\EventInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use ArrayObject;

/**
 * Muestras Model
 *
 * @method \App\Model\Entity\Muestra newEmptyEntity()
 * @method \App\Model\Entity\Muestra newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Muestra> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Muestra get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Muestra findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Muestra patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Muestra> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Muestra|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Muestra saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Muestra>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Muestra>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Muestra>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Muestra> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Muestra>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Muestra>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Muestra>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Muestra> deleteManyOrFail(iterable $entities, array $options = [])
 */
class MuestrasTable extends Table
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

        $this->setTable('muestras');
        $this->setDisplayField('codigo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always'
                ]
            ]
        ]);

        // Asociación: una muestra tiene un resultado
        $this->hasOne('Resultados', [
            'foreignKey' => 'muestra_id',
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
            ->scalar('codigo')
            ->maxLength('codigo', 10)
            ->requirePresence('codigo', 'create')
            ->notEmptyString('codigo')
            ->add('codigo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('numero_precinto')
            ->maxLength('numero_precinto', 100)
            ->requirePresence('numero_precinto', 'create')
            ->notEmptyString('numero_precinto');

        $validator
            ->scalar('empresa')
            ->maxLength('empresa', 100)
            ->requirePresence('empresa', 'create')
            ->notEmptyString('empresa');

        $validator
            ->scalar('especie')
            ->maxLength('especie', 150)
            ->requirePresence('especie', 'create')
            ->notEmptyString('especie');

        $validator
            ->nonNegativeInteger('cantidad_semillas')
            ->notEmptyString('cantidad_semillas');

        return $validator;
    }

    /**
     * beforeMarshal: se ejecuta antes de crear la entidad/validación.
     * Aquí generamos el codigo si no viene en los datos, así pasa la validación.
     */
    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if (empty($data['codigo'])) {
            // calculo simple: siguiente id estimado (no perfecto si hay concurrencia)
            // Crea un código tipo M0001, M0002, etc.
            $ultimo = $this->find()->select(['id'])->order(['id' => 'DESC'])->first();
            $nextId = $ultimo ? ($ultimo->id + 1) : 1;
            $data['codigo'] = sprintf('MUE%04d', $nextId);
        }
    }

    public function beforeSave(EventInterface $event, $entity, ArrayObject $options)
    {
        if ($entity->isNew() && empty($entity->codigo)) {
            // Crea un código tipo M0001, M0002, etc.
            $ultimo = $this->find()->order(['id' => 'DESC'])->first();
            $nextId = $ultimo ? $ultimo->id + 1 : 1;
            $entity->codigo = sprintf('MUE%04d', $nextId);
        }
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
        $rules->add($rules->isUnique(['codigo']), ['errorField' => 'codigo']);

        return $rules;
    }
}
