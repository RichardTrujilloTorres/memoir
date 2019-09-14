<?php

/**
 * Class HistoriesControllerTest
 */
class HistoriesControllerTest extends TestCase
{
    /**
     * @var \App\History[] $records
     */
    protected $records;

    protected function setUp(): void
    {
        parent::setUp();

        \Illuminate\Support\Facades\DB::table('histories')->truncate();

        $this->records = factory(\App\History::class, 10)->create();
    }



    /**
     * @test History record listing.
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
     * @test History record detail.
     */
    public function show()
    {
        $response = $this->call('GET', "histories/{$this->records[0]->_id}");

        $this->assertEquals(200, $response->status());

        $this->seeJson([
            'contact' => $this->records[0]->contact,
            '_id' => $this->records[0]->_id,
        ]);
    }

    /**
     * @test History record creation.
     */
    public function store()
    {
        $response = $this->call('POST', "histories", []);

        $this->assertEquals(422, $response->status());

        $response = $this->call('POST', "histories", [
            'contact' => '/api/v1/contacts/11',
            'type' => 'purchase made',
            'followUp' => 'thank you email',
            'links' => [
                '/api/v1/products/1',
            ],
        ]);

        $this->assertEquals(201, $response->status());

        $this->seeJson([
            'contact' => '/api/v1/contacts/11',
            'type' => 'purchase made',
        ]);

        $this->seeInDatabase('histories', [
            'contact' => '/api/v1/contacts/11',
            'type' => 'purchase made',
        ]);
    }

    /**
     * @test History record update.
     */
    public function update()
    {
        $response = $this->call('PUT', "histories/{$this->records[0]->_id}", [
            'type' => 'purchase made (--updated)',
        ]);

        $this->assertEquals(201, $response->status());

        $this->seeJson([
            'type' => 'purchase made (--updated)',
        ]);

        $this->seeInDatabase('histories', [
            'type' => 'purchase made (--updated)',
        ]);
    }


    /**
     * @test History record removal.
     */
    public function deleteAction()
    {
        $response = $this->call('DELETE', "histories/{$this->records[0]->_id}");

        $this->assertEquals(201, $response->status());

        $this->seeJson([
            'data' => [],
        ]);
    }
}
