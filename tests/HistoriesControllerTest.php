<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HistoriesControlerTest extends TestCase
{
    protected $records;

    protected function setUp(): void
    {
        $this->records = factory(\App\History::class)->make();
    }



    /**
     * @test
     */
    public function index()
    {
        $response = $this->call('GET', '/histories');

        $this->assertEquals(200, $response->status());
        
        $this->seeJson([
            '_id' => $this->records[0]->_id
        ]);
    }

    /**
     * @test
     */
    public function show()
    {
        $record = factory(\App\History::class)->create();

        $response = $this->call('GET', "histories/{$record->_id}");

        $this->assertEquals(200, $response->status());

        $this->seeJson([
            '_id' => $record->_id,
        ]);
    }
}
