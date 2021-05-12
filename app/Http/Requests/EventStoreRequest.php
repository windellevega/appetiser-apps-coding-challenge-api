<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'event_name'        => ['required', 'string'],
            'event_date_from'   => ['required', 'date'],
            'event_date_to'     => ['required', 'date'],
            'event_days'        => ['required', 'array', 'min:1', 'max:7']
        ];
    }
}
