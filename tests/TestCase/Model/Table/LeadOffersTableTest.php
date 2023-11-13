<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeadOffersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeadOffersTable Test Case
 */
class LeadOffersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeadOffersTable
     */
    protected $LeadOffers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.LeadOffers',
        'app.Leads',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('LeadOffers') ? [] : ['className' => LeadOffersTable::class];
        $this->LeadOffers = $this->getTableLocator()->get('LeadOffers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->LeadOffers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeadOffersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeadOffersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
