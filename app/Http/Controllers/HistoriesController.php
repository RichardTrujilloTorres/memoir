<?php

namespace App\Http\Controllers;

use App\Exceptions\CouldNotCreateRecordException;
use App\Exceptions\CouldNotUpdateRecordException;
use App\Exceptions\RecordNotFoundException;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @throws RecordNotFoundException
     */
    public function show($id)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFoundException($id);
        }

        return response()->json([
            'data' => compact('record'),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws CouldNotCreateRecordException
     */
    public function store(Request $request)
    {
        $record = $request->all();
        $status = DB::collection('histories')->insert($record);
        if (! $status) {
            throw new CouldNotCreateRecordException();
        }

        return response()->json([
            'data' => compact('record')
        ], 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws CouldNotUpdateRecordException
     * @throws RecordNotFoundException
     */
    public function update($id, Request $request)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFoundException($id);
        }

        $status = DB::collection('histories')->update($request->all());
        if (! $status) {
            throw new CouldNotUpdateRecordException($id);
        }

        return response()->json([
            'data' => compact('record')
        ], 201);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws RecordNotFoundException
     */
    public function delete($id, Request $request)
    {
        $record = $this->history->where('_id', $id)->first();
        if (! $record) {
            throw new RecordNotFoundException($id);
        }

        $record->delete();

        return response()->json([
            'data' => [],
        ], 201);
    }
}
