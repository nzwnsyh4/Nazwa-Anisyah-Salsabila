<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightDateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    return [
        'estimasi_tanggal_terbang' => 'required|date_format:d/m/Y|after:today',
        'estimasi_tanggal_sampai' => 'required|date_format:d/m/Y|after:estimasi_tanggal_terbang',
    ];
}
}
