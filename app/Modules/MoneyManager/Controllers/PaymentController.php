<?php

namespace App\Modules\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Models\Payment;
use App\Modules\MoneyManager\Repositories\CategoryRepository;
use App\Modules\MoneyManager\Requests\StorePayment;
use App\Modules\MoneyManager\Requests\UpdateCategory;
use App\Modules\MoneyManager\Requests\UpdatePayment;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        setlocale(LC_MONETARY, 'vi_VN.UTF-8');
        $payments = Auth::user()->payments;

        return view('MoneyManager::payment.index', [
            'payments' => $payments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('MoneyManager::payment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Modules\MoneyManager\Requests\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayment $request)
    {
        // Save category
        $payment = new Payment;
        $payment->user_id = Auth::user()->id;
        $payment->amount = $request->amount;
        $payment->paid_at = Carbon::createFromFormat(config('datetime.carbon.format'), $request->paid_at);
        $payment->note = $request->note;
        $payment->category_id = $request->category_id;
        $payment->save();

        $request->session()->flash('message', trans('MoneyManager::payment.create.success'));

        return redirect()->route('payments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('MoneyManager::payment.edit', [
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Modules\MoneyManager\Requests\UpdatePayment  $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayment $request, Payment $payment)
    {
        // Save payment
        $payment->amount = $request->amount;
        $payment->paid_at = Carbon::createFromFormat(config('datetime.carbon.format'), $request->paid_at);
        $payment->note = $request->note;
        $payment->category_id = $request->category_id;
        $payment->save();

        $request->session()->flash('message', trans('MoneyManager::payment.edit.success'));

        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        Session::flash('message', trans('MoneyManager::payment.delete.success'));

        return redirect()->route('payments.index');
    }
}
