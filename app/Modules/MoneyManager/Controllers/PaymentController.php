<?php

namespace App\Modules\MoneyManager\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\MoneyManager\Models\Payment;
use App\Modules\MoneyManager\Repositories\CategoryRepository;
use App\Modules\MoneyManager\Requests\StorePayment;
use App\Modules\MoneyManager\Requests\UpdateCategory;
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
        $categories = CategoryRepository::getTreeData();

        return view('MoneyManager::payment.create', [
            'categories' => $categories
        ]);
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
     * Display the specified resource.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $payments = CategoryRepository::getTreeData();

        return view('MoneyManager::payment.edit', [
            'category' => $category,
            'payments' => $payments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Modules\MoneyManager\Requests\UpdateCategory  $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Payment $payment)
    {
        // Save category
        $category->name = $request->name;
        // Check avatar uploaded?
        if ($request->hasFile('avatar')) {
            $storePath = config('money_manager.payment.avatar_storage_path') . '/' . $request->user()->id;
            // Delete old avatar file
            // if ($category->avatar && Storage::disk('public')->exists($category->avatar)) {
            //     Storage::disk('public')->delete($category->avatar);
            // }
            // Store new avatar file
            $avatar = $request->file('avatar')->store($storePath, 'public');
            $category->avatar = $avatar;
        }
        // Check parent selected?
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);

            $category->parent_id = $parent->id;
            $category->level = ++$parent->level;
        }
        $category->save();
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
        if ( count($category->children) == 0 ) {
            // TODO: Delete payments of this category
            $category->delete();

            Session::flash('message', trans('MoneyManager::payment.delete.success'));
        } else {
            Session::flash('message', trans('MoneyManager::payment.delete.children_exists'));
        }

        return redirect()->route('payments.index');
    }
}
