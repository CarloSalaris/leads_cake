<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 */
class ClientsFixture extends TestFixture
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
                'leads_id' => 1,
                'ragione_sociale' => 'Lorem ipsum dolor sit amet',
                'p_iva' => '',
                'codice_fiscale' => '',
                'created' => '2023-11-11 09:57:28',
                'modified' => '2023-11-11 09:57:28',
            ],
        ];
        parent::init();
    }
}
