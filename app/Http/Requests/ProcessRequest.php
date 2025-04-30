<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'device_meta_id' => 'required|exists:device_metas,id',
            'devices' => 'required',
            'devices.*.id' => 'required|exists:devices,id',
            'customer_id' => 'required|exists:customers,id',
            'stage' => 'required',
            'stage_text' => 'sometimes'
        ];
    }
}
