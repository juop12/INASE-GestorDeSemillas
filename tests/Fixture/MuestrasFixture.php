<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MuestrasFixture
 */
class MuestrasFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'codigo' => 'Lorem ip',
                'numero_precinto' => 'Lorem ipsum dolor sit amet',
                'empresa' => 'Lorem ipsum dolor sit amet',
                'especie' => 'Lorem ipsum dolor sit amet',
                'cantidad_semillas' => 1,
                'created_at' => 1761778254,
                'updated_at' => 1761778254,
            ],
        ];
        parent::init();
    }
}
