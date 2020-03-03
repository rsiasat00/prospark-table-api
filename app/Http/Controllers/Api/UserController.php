<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    public function __invoke(Request $request): ResourceCollection
    {
        try {
            $users = User::skip($request->start)
                ->take($request->length);

            if ($request->has('search') && $request->search['value'] != "") {
                $users->filter($request->search['value']);
            }
            
            $usersCount = (! $request->has('search') && $request->search['value'] == "") ? User::count() : User::filter($request->search['value'])->count();

            return new UserCollection($users->get(), $usersCount, $request->draw);

        } catch (\Throwable $th) {
            abort(500, $th->getMessage());
        }
    }
}
