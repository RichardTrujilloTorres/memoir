<?php

namespace App\Http\Controllers;

use App\Exceptions\RecordNotFound;
use App\History;
use Illuminate\Http\Request;

/**
 * Class HistoriesController
 * @package App\Http\Controllers
 */
class HistoriesController extends Controller
{
    /**
     * @var History
     */
    protected $history;

    /**
     * HistoriesController constructor.
     * @param History $history
     */
    public function __construct(History $history)
    {
        $this->history = $history;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $records = $this->history->all()->toArray();

        return response()->json([
            'data' => compact('records'),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws RecordNotFound
     */
    public function show($id)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFound($id);
        }

        return response()->json([
            'data' => compact('record'),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $record = $this->history->create($request->all());

        return response()->json([
            'data' => compact('record')
        ], 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws RecordNotFound
     */
    public function update($id, Request $request)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFound($id);
        }

        $record->update($request->all());

        return response()->json([
            'data' => compact('record')
        ], 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws RecordNotFound
     */
    public function delete($id, Request $request)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFound($id);
        }

        $record->delete();

        return response()->json([
            'data' => [],
        ], 201);
    }
}
