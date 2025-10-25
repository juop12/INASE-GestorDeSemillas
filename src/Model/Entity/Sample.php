<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sample Entity
 *
 * @property int $id
 * @property string $codigo_muestra
 * @property string $numero_precinto
 * @property string $empresa
 * @property string $especie
 * @property int $cantidad_semillas
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Result[] $results
 */
class Sample extends Entity
{
    protected array $_accessible = [
        'numero_precinto' => true,
        'empresa' => true,
        'especie' => true,
        'cantidad_semillas' => true,
        'results' => true,
    ];
}
