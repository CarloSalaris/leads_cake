<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LeadOffersFixture
 */
class LeadOffersFixture extends TestFixture
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
                'lead_id' => 1,
                'marca' => 'Lorem ipsum dolor sit amet',
                'modello' => 'Lorem ipsum dolor sit amet',
                'km' => 1,
                'created' => '2023-11-14 17:17:56',
                'modified' => '2023-11-14 17:17:56',
            ],
        ];
        parent::init();
    }
}
