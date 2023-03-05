<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:200'],
            'p_iva' => ['required', 'string', 'max:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'p_iva' => $data['p_iva'],
            'slug' => User::getSlug($data['restaurant_name']),
            'restaurant_name' => $data['restaurant_name'],
            'image' => $data['image'],
            'phone' => $data['phone'],
            'delivery_cost' => $data['delivery_cost'],
            'opening_hours' => $data['opening_hours'],
            'closing_hours' => $data['closing_hours'],
        ]);

        $user->categories()->attach($data['category_id']);

        // if(isset($data['category_id'])) {
        //     $user->categories()->sync($data['category_id']);
        // }


        return $user;


    }

    public function showRegistrationForm()
    {
    $categories = Category::all();
    return view('auth.register', compact('categories'));
    }
}
