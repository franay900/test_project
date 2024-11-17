<?php

namespace App\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'text' => 'nullable|string',
            'status' => 'required|string',
            'url' => 'required|string',
            'cpm' => 'required|integer',
            'impressions' => 'required|integer',
            'budget' => 'required|integer',
            'button_text' => 'required|string',
            'campaign_id' => 'required|integer',

        ];
    }
}
