<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function __invoke()
    {
        $visitor=Visitor::create();
        return response()->apiResponse(['token' => $visitor->createToken($visitor->id)->plainTextToken]);
    }
}
