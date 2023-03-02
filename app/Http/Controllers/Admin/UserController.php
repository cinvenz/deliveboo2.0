<?php

namespace App\Http\Controllers\Admin;
require_once __DIR__ . '/vendor/autoload.php';

// use App\User;
// use App\Order;
use App\Category;
// use Braintree\Gateway;
// use Braintree_Transaction;
// use App\Mail\SendEmailUser;
// use App\Mail\SendEmailGuest;
// use Illuminate\Http\Request;
// use App\Mail\SendEmailRistoratore;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getCategoryList()
    {
        $categories = Category::all();
        return view('restaurants.register', compact('categories'));
    }


    // public function checkout(Request $request)
    // {

    //     $amount = $request->total;
    //     $nonce = $request->nonce;
    //     $userName = $request->userName;

    //     $gateway = new \Braintree\Gateway([
    //         'environment' => env('BRAINTREE_ENV'),
    //         'merchantId' => env('BRAINTREE_MERCHANT_ID'),
    //         'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
    //         'privateKey' => env('BRAINTREE_PRIVATE_KEY')
    //     ]);

    //     $result = $gateway->transaction()->sale([
    //         'amount' => $amount,
    //         'paymentMethodNonce' => $nonce,
    //         'customer' => [
    //             'firstName' => $userName,
    //         ],
    //     ]);

    //     if($result->success) {
    //         $transaction = $result->transaction;

    //         $order = new Order();
    //         $order->user_id = $request->restaurantId;
    //         $order->prezzo = $amount;
    //         $order->indirizzo = $request->userIndirizzo;
    //         $order->data_e_ora = date("Y-m-d H:i:s");
    //         $order->nome = $userName;
    //         $order->cognome = $request->userSurname;
    //         $order->telefono = $request->userTelefono;
    //         $order->email = $request->userEmail;
    //         $order->save();

    //         // Select current order model
    //         $currentOrder = Order::find($order->id);
    //         $currentOrder->dishes()->attach($request->dishIdsArray);

    //         // Send email to restaurant
    //         $restaurant = User::find($request->restaurantId);
    //         Mail::to($restaurant->email)->send(new SendEmailRistoratore($currentOrder));
    //         // Send email to user
    //         Mail::to($request->userEmail)->send(new SendEmailUser($currentOrder, $restaurant));

    //         return response()->json([
    //             'message' => 'Transazione andata a buon fine. Controlla la tua mail per il riepilogo. ID: ' . $transaction->id,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'message' => 'Transazione non andata a buon fine.'
    //         ]);
    //   };

    // }
}
