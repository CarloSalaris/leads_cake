<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeadsFixture
 */
class LeadsFixture extends TestFixture
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
                'ragione_sociale' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ips',
                'tipo_soggetto' => '',
                'created' => '2023-11-11 11:01:33',
                'modified' => '2023-11-11 11:01:33',
            ],
        ];
        parent::init();
    }
}
