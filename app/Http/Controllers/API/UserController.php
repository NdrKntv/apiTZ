<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Traits\UrlParamsValidation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    use UrlParamsValidation;

    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->middleware('auth:sanctum', ['only' => 'store']);
    }

    public function index()
    {
        $this->paginationValidation();
        return response()->apiResponse($this->userRepository->index());
    }

    public function store(UserRequest $request)
    {
        return response()->apiResponse($this->userRepository->store($request));
    }

    public function show($id)
    {
        $this->urlPramsValidation(['user_id' => $id], ['user_id' => 'integer']);
        try {
            return response()->apiResponse($this->userRepository->show($id));
        } catch (ModelNotFoundException $e) {
            return response()->apiResponse(['message' => 'The user with the requested identifier does not exist',
                'fails' => ['user_id' => ['User not found']]], 404);
        }
    }
}
