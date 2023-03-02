<?php

namespace App\Http\Controllers\Admin;

use App\Dish;



use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    private $validations = [
        'slug'      => [
            'required',
            'string',
            'max:100',
        ],
        'dish_name'     => 'required|string|max:200',
        'image'         => 'url|max:5000',
        'uploaded_img'  => 'nullable|image|max:1024',
        'ingredients'   => 'nullable|string',
        'description'   => 'nullable|string',
        'price'         => 'nullable|string',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $currentuserId = Auth::user('id')->id;
        $dishes = Dish::where('user_id', '=', $currentuserId)->paginate(5);

        return view('admin.dishes.index', [
            'dishes' => $dishes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all('id');

        return view('admin.dishes.create',[
            'users' => $users,
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validations['slug'][] = 'unique:dishes';
        $request->validate($this->validations);

        $data = $request->all();

        $img_path = isset($data['uploaded_img']) ? Storage::put('uploads', $data['uploaded_img']) : null;

        $user_id = Auth::user('id')->id;

        // salvare i dati nel db
        $dish = new Dish;
        $dish->dish_name    = $data['dish_name'];
        $dish->user_id      = $user_id;
        $dish->slug         = $data['slug'];
        $dish->uploaded_img = $img_path;
        $dish->description  = $data['description'];
        $dish->ingredients  = $data['ingredients'];
        $dish->price        = $data['price'];
        $dish->save();

         // associamo il post appena creato ai tag
        // $dish->tags()->attach($data['tags']);

        return redirect() ->route('admin.dishes.show', ['dish' => $dish]);
    }


    public function show(Dish $dish)
    {
        $dishOwner = $dish->user_id;
        $currentUser = Auth::user()->id;

        if ($dishOwner !== $currentUser) {

            abort(404);

        } else {

            return view('admin.dishes.show', compact('dish'));

        }
    }


    public function edit(Dish $dish)
    {

        $dishOwner = $dish->user_id;
        $currentUser = Auth::user()->id;

        if ($dishOwner !== $currentUser) {

            abort(404);

        } else {

            return view('admin.dishes.edit', compact('dish'));
        }
    }


    public function update(Request $request, Dish $dish)
    {
        // validation
        $this->validations['slug'][] = Rule::unique('dishes')->ignore($dish);
        $request->validate($this->validations);

        $data = $request->all();

        $dishOwner = $dish->user_id;
        $currentUser = Auth::user()->id;

        if ($dishOwner !== $currentUser) {

            abort(404);

        } else {

            if (isset($data['uploaded_img'])) {
                $img_path = Storage::put('uploads', $data['uploaded_img']);
                Storage::delete($dish->uploaded_img);
            } else {
                $img_path = $dish->uploaded_img;
            }

            // salvare i dati nel db
            $dish->dish_name   = $data['dish_name'];
            $dish->slug        = $data['slug'];
            // $dish->image       = $data['img'];
            $dish->uploaded_img = $img_path;
            $dish->description = $data['description'];
            $dish->ingredients = $data['ingredients'];
            $dish->price       = $data['price'];
            $dish->update();
         // $dish->tags()->sync($data['tags']);

            return redirect()->route('admin.dishes.show', ['dish' => $dish]);
        }
    }


    public function destroy(Dish $dish)
    {
        $dishOwner = $dish->user_id;
        $currentUser = Auth::user()->id;

        if ($dishOwner !== $currentUser) {

            abort(404);

        } else {

        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('success_delete', $dish);
        }
    }
}
