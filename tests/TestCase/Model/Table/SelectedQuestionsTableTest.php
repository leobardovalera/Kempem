<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SelectedQuestionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SelectedQuestionsTable Test Case
 */
class SelectedQuestionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SelectedQuestionsTable
     */
    protected $SelectedQuestions;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SelectedQuestions',
        'app.Sections',
        'app.Questions',
        'app.Answers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SelectedQuestions') ? [] : ['className' => SelectedQuestionsTable::class];
        $this->SelectedQuestions = $this->getTableLocator()->get('SelectedQuestions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SelectedQuestions);

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
