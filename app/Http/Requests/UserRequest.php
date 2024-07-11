<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'name' => 'required|max:100',
            'nip' => $this->is('v1/user/update/*') ? 'required|max:25' : 'required|max:25|unique:users,nip',
            'position' => 'required',
            'phone' => 'required|numeric',
            'username' => $this->is('v1/user/update/*') ? 'required' : 'required|unique:users,username',
            'email' => $this->is('v1/user/update/*') ? 'required|email' : 'required|email|unique:users,email',
            'agency' => 'required',
            'role' => 'required|in:admin,user',
            'password' => $this->is('v1/user/update/*') ? 'nullable|min:8'  : 'required|min:8',
            'password_confirmation' => $this->is('v1/user/update/*') ? 'nullable|same:password'  : 'required|same:password',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.max' => 'NIP harus terdiri dari 25 digit.',
            'nip.unique' => 'NIP sudah digunakan.',
            'position.required' => 'Posisi wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.numeric' => 'Nomor telepon harus menggunakan angka.',
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username tidak boleh melebihi dari 25 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'agency.required' => 'Instansi wajib diisi.',
            'role.required' => 'Role wajib diisi.',
            'role.in' => 'Role harus dipilih dari opsi yang tersedia.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same' => 'Password tidak sama.',
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
