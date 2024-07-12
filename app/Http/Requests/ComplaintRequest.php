<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ComplaintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'description_complaint' => 'required',
            'id_user' => 'required',
            'id_category_complaint' => 'required',
            'image_complaint' => 'nullable|mimes:jpg,png,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'description_complaint.required' => 'Deskripsi keluhan wajib diisi!',
            'id_user.required' => 'User wajib diisi!',
            'id_category_complaint.required' => 'Kategori keluhan wajib diisi!',
            'image_complaint.mimes' => 'File harus pdf,png,jpg,jpeg',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => 422,
            'message' => 'Check your validation',
            'errors' => $validator->errors()
        ]));
    }
}
