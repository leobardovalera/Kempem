<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScriptsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScriptsTable Test Case
 */
class ScriptsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScriptsTable
     */
    protected $Scripts;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Scripts',
        'app.Instruments',
        'app.Results',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Scripts') ? [] : ['className' => ScriptsTable::class];
        $this->Scripts = $this->getTableLocator()->get('Scripts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Scripts);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
