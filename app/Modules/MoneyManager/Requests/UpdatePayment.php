<?php

namespace App\Modules\MoneyManager\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'paid_at' => 'required|date_format:' . config('datetime.carbon.format'),
            'note' => 'string',
            'category_id' => 'required|integer|exists:mm_categories,id'
        ];
    }
}
