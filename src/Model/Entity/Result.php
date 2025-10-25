<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Result Entity
 *
 * @property int $id
 * @property int $sample_id
 * @property float $poder_germinativo
 * @property float $pureza
 * @property string|null $materiales_inertes
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Sample $sample
 */
class Result extends Entity
{
    protected array $_accessible = [
        'sample_id' => true,
        'poder_germinativo' => true,
        'pureza' => true,
        'materiales_inertes' => true,
        'sample' => true,
    ];
}
