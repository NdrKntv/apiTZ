<?php

namespace App\Http\Repositories;

use App\Http\Resources\UserResource;
use App\Http\Services\ImageServices\Compression\ImageCompressionInterface;
use App\Http\Services\ImageServices\CropAndStore;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;

class UserRepository
{
    private $imageStore;

    public function __construct()
    {
        $this->imageStore = new CropAndStore(App::make(ImageCompressionInterface::class));
    }

    private function withPaginationData($list)
    {
        if (request('page') > $list->lastPage()) {
            throw new ModelNotFoundException('Page not found');
        }
        return array('page' => $list->currentPage(),
                'total_pages' => $list->lastPage(),
                'total_users' => $list->total(),
                'count' => $list->count(),
                'links' => ['next_url' => $list->nextPageUrl()]) + ['users' => $list];
    }

    public function index()
    {
        $users = UserResource::collection(User::orderBy('id')->paginate(6));

        return request()->wantsJson() ? $this->withPaginationData($users) : ['users' => $users];
    }

    public function store($request)
    {
        $attributes = $request->safe()->except('photo');

        $imagePath = 'users/' . str_replace('+380', '', $attributes['phone']);
        $attributes['photo'] = $this->imageStore->cropAndStore($request->file('photo'), $imagePath, 70)[0];

        $user = User::create($attributes);

        request()->user()->currentAccessToken()->delete();
        return ['user_id' => $user->id, 'message' => 'New user successfully registered'];
    }

    public function show($id)
    {
        return ['user' => new UserResource(User::where('id', $id)->firstOrFail())];
    }
}
