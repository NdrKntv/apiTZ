<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Positions;

class PositionsController extends Controller
{
    public function index()
    {
        return response()->apiResponse(['positions' => PositionResource::collection(Positions::all()->sortBy('id'))]);
    }
}
