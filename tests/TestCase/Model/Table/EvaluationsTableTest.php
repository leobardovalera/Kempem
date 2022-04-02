<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EvaluationsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EvaluationsTable Test Case
 */
class EvaluationsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EvaluationsTable
     */
    protected $Evaluations;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Evaluations',
        'app.Users',
        'app.Instruments',
        'app.Answers',
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
        $config = $this->getTableLocator()->exists('Evaluations') ? [] : ['className' => EvaluationsTable::class];
        $this->Evaluations = $this->getTableLocator()->get('Evaluations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Evaluations);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
