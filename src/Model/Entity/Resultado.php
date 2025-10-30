<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Resultado Entity
 *
 * @property int $id
 * @property int $muestra_id
 * @property string|null $poder_germinativo
 * @property string|null $pureza
 * @property string|null $materiales_inertes
 * @property \Cake\I18n\DateTime $created_at
 * @property \Cake\I18n\DateTime $updated_at
 *
 * @property \App\Model\Entity\Muestra $muestra
 */
class Resultado extends Entity
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
    protected array $_accessible = [
        'muestra_id' => true,
        'poder_germinativo' => true,
        'pureza' => true,
        'materiales_inertes' => true,
        'created_at' => true,
        'updated_at' => true,
        'muestra' => true,
    ];
}
