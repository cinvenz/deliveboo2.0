<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Dish;
use App\User;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function dishes(User $user)
    {
        $dishes = Dish::where('user_id', $user->id)->get();

        return response()->json([
            'results' => $dishes,
        ]);
    }
}



