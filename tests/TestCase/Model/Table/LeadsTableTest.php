<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeadsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeadsTable Test Case
 */
class LeadsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LeadsTable
     */
    protected $Leads;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Leads',
        'app.Clients',
        'app.LeadOffers',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Leads') ? [] : ['className' => LeadsTable::class];
        $this->Leads = $this->getTableLocator()->get('Leads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Leads);

        parent::tearDown();
    }

    /**
     * Test findPrivato method
     *
     * @return void
     * @uses \App\Model\Table\LeadsTable::findPrivato()
     */
    public function testFindPrivato(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findGiuridico method
     *
     * @return void
     * @uses \App\Model\Table\LeadsTable::findGiuridico()
     */
    public function testFindGiuridico(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findNotClient method
     *
     * @return void
     * @uses \App\Model\Table\LeadsTable::findNotClient()
     */
    public function testFindNotClient(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LeadsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LeadsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
