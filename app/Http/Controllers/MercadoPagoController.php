<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago\MercadoPagoConfig;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MercadoPagoController extends Controller
{
  protected $user, $payment;

  public function __construct(User $user, Payment $payment)
  {
    $this->user = $user;
    $this->payment = $payment;
  }

  public function index()
  {
    return view('mp.index');
  }

  public function create_preference(Request $request)
  {

    $env = env('VITE_APP_MP_TEST_TOKEN');
    MercadoPagoConfig::setAccessToken($env);
    //
    $response = Http::withBody(
      '{
      "back_urls": {
        "success": "http://atividades.app.proandre.com.br/pedidos",
        "pending": "http://atividades.app.proandre.com.br/pedidos",
        "failure": "http://atividades.app.proandre.com.br/pedidos"
      },
      "external_reference": null,
      "notification_url": "https://atividades.proandre.com.br/api/mp/webhook",
      "auto_return": "approved",
      "items": [
        {
          "title": "' . $request->title . '" ,
          "description": "' . $request->description . '",
          "category_id": "Serviço Web",
          "quantity": ' . $request->quantity . ',
          "currency_id": "BRL",
          "unit_price": ' . $request->price . '
        }
      ]
    }',
      'json'
    )
      ->withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer TEST-7208305253103057-030620-5e45f942382029ddb495ed2ec8f093f1-20538013',
      ])
      ->post('https://api.mercadopago.com/checkout/preferences');



    //   $value = $request->price * $request->quantity;

    // DB::table('payments')
    // ->insert(['payment_id' => $value, 'token' => $token, 'created_at' => now()]);

    return $response->body();
  }

  /*   https://www.youtube.com/watch?v=HCbk9vc4Wt0
  https://www.youtube.com/watch?v=hODD40rx6Q4
  https://www.mercadopago.com.br/developers/pt/docs/your-integrations/notifications/webhooks
  https://medium-com.translate.goog/@prevailexcellent/how-to-handle-webhook-in-laravel-two-ways-and-the-best-way-90abfa7e1a39?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt-BR&_x_tr_pto=sc&_x_tr_hist=true
  */

  public function webhook(Request $request)
  {
    $env = env('VITE_APP_MP_TEST_TOKEN');
    MercadoPagoConfig::setAccessToken($env);

    $data = $request;
    Log::info('Conta editado com sucesso',  $data);

    return response()->json($request, 200);
    //

  }


  public function storePayment(Request $request)
  {

    $date_of_expiration = Carbon::now()->addMonths(10);

    $storePayment = DB::table('payments')
      ->insert(['payment_id' => $request->id,  'value' => $request->value, 'date_created' => now(),  'date_of_expiration' =>  $date_of_expiration, 'created_at' => now()]);

    $data = $request->all();
    $data['date_of_expiration'] = $date_of_expiration;

    $storePayment = $this->payment::create($data);

    return response()->json([
      'status' => true,
      'message' => "Product Created successfully!",
      'product' => $storePayment
    ], 200);





    // return $storePayment;
  }




  //
  //
  //
}
