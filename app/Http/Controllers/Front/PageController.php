<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function __construct()
    {

    }

    public function home()
    {
        $products = Product::paginate(9);
        return view('front.pages.home', get_defined_vars());
    }

    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('front.pages.single_product', get_defined_vars());
    }

    public function checkout()
    {
        $items = \Cart::getContent();
        return view('front.pages.checkout', get_defined_vars());
    }

    public function piniklePaymentsList(Request $request)
    {
        try {
            $total = \Cart::getTotal();
            if ($total < 1) {
                throw new \Exception();
            }
            $url = config('pinikle.pinikle_url').'/api/listOfPayments';
            $response = Http::withToken(config('pinikle.pinikle_token'))
                ->post($url, [
                'amount' => $total,
                'currency' => 'USD',
                'mobileNumber' => '',
                'email' => $request->email,
                'firstName' => $request->first_name,
                'lastName' => $request->last_name,
                'success_url' => route('success_payment'),
                'fail_url' => route('failed_payment'),
                'cancel_url' => route('cancelled_payment'),
            ]);
            $result = json_decode($response, true);

            if (isset($result['success']) && $result['success'] == true) {

                $html = '';
                foreach ($result['data'] as $payment) {
                    $subPaymentId = $payment['subPaymentId'] ?? null;
                    $html .= '<div class="form-check mb-3">';
                    $html .= '<input class="form-check-input pinikle_gateway" data-subPaymentId="'.$subPaymentId.'" type="radio" name="pinikle_gateway" id="'.$payment['gateway'].'" value="'.$payment['gateway'].'">';
                    $html .= '<img class="img-fluid mx-2" src="'.$payment['logoURL'].'" style="max-width: 90px;max-height: 50px;">';
                    $html .= '<label class="form-check-label" for="'.$payment['gateway'].'">'.$payment['name_en'].'</label>';
                    $html .= '</div>';
                }
                session()->put('refid', $result['refid']);
                return [
                    'success' => true,
                    'payments_list'=> $html
                ];
            }

        } catch (\Exception $e) {
            return [
                'success' => false,
                'msg'     => $e->getMessage()
            ];
        }
    }

    public function postCheckout(Request $request)
    {
        try {
            $getway = $request->getway;
            $pinikleGetway = $request->pinikle_gateway;
            $subPaymentId = $request->subPaymentId;

            if (empty($getway)) {
                flash(__('front.please_select_payment_getway'))->error();
                return back();
            }
            if (empty($pinikleGetway)) {
                flash(__('front.you_dont_select_pinikle_getway'))->error();
                return back();
            }

            if ($getway == 'pinikle') {
                if (session()->has('refid') && !empty($subPaymentId)) {
                    $url = config('pinikle.pinikle_url') . '/api/initiatePayment';
                    $response = Http::withToken(config('pinikle.pinikle_token'))
                        ->post($url, [
                            'refid' => session('refid'),
                            'gateway' => $pinikleGetway,
                            'subPaymentId' => $subPaymentId,
                        ]);

                    $result = json_decode($response, true);

                    if (isset($result['data']['redirect_url'])) {
                        return redirect()->to($result['data']['redirect_url']);
                    }

                    flash(__('front.you_dont_select_pinikle_getway'))->error();
                }
            }

        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return back();
        }
    }

    public function successPayment()
    {
        flash(__('front.payment_success'))->success();
        return view('front.pages.payment_status', get_defined_vars());
    }

    public function failedPayment()
    {
        flash(__('front.payment_failed'))->error();
        return view('front.pages.payment_status', get_defined_vars());
    }

    public function cancelledPayment()
    {
        flash(__('front.payment_cancelled'))->error();
        return view('front.pages.payment_status', get_defined_vars());
    }
}
