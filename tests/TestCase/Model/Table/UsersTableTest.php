<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Users',
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
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findIndex method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findIndex()
     */
    public function testFindIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findFull method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findFull()
     */
    public function testFindFull(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findFilters method
     *
     * @return void
     * @uses \App\Model\Table\UsersTable::findFilters()
     */
    public function testFindFilters(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
