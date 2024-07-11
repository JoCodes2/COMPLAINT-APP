<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'nama' => 'required|max:100',
            'nip' => $this->is('v1/user/update/*') ? 'required|digits:25' : 'required|digits:25|unique:users,nip',
            'position' => 'required',
            'phone' => 'required|numeric',
            'username' => 'required|max:25|unique:users,username',
            'email' => $this->is('v1/user/update/*') ? 'required|email' : 'required|email|unique:users,email',
            'agency' => 'required',
            'role' => 'required|in:admin, user',
            'password' => $this->is('v1/user/update/*') ? 'nullable|min:8'  : 'required|min:8',
            'password_confirmation' => $this->is('v1/user/update/*') ? 'nullable|same:password'  : 'required|same:password',
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits' => 'NIP harus terdiri dari 25 digit.',
            'nip.unique' => 'NIP sudah digunakan.',
            'position.required' => 'POSITION wajib diisi',
            'phone.required' => 'NOMOR TELEPON wajib diisi',
            'phone.numeric' => 'NOMOR TELEPON harus menggunakan angka',
            'username.required' => 'Username wajib diisi',
            'username.max' => 'Username tidak boleh melebihi dari 25 karakter',
            'username.unique' => 'Username sudah digunakan',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'agency.required' => 'DEVISI wajib diisi',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin harus dipilih dari opsi yang tersedia.',
            'alamat.required' => 'Alamat wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'agama.in' => 'Agama harus dipilih dari opsi yang tersedia.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari 50 karakter.',
            'status_perkawinan.required' => 'Status perkawinan wajib diisi.',
            'status_perkawinan.in' => 'Status perkawinan harus dipilih dari opsi yang tersedia.',
            'warga_negara.required' => 'Warga negara wajib diisi.',
            'warga_negara.max' => 'Warga negara tidak boleh lebih dari 20 karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.in' => 'Role harus dipilih dari opsi yang tersedia.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.',
            'password_confirmation.required' => 'Konfirmasi Password wajib diisi.',
            'password_confirmation.same' => 'Password tidak sama.',
            // Pesan khusus untuk staf
            'jabatan.required' => 'Jabatan wajib diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 100 karakter.',
            'golongan.required' => 'Golongan atau pangkat wajib diisi.',
            'golongan.max' => 'Golongan atau pangkat tidak boleh lebih dari 50 karakter.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nip.digits' => 'NIP harus terdiri dari 30 digit.',
            // Pesan khusus untuk penduduk
            'wilayah_rt_rw.required' => 'Wilayah RT/RW wajib diisi.',
            'wilayah_rt_rw.max' => 'Wilayah RT/RW tidak boleh lebih dari 20 karakter.',
            'file_ktp.required' => 'File KTP wajib diisi.',
            'file_ktp.file' => 'File KTP harus berupa file.',
            'file_ktp.mimes' => 'File KTP harus berupa file dengan format pdf.',
            'file_kk.required' => 'File KK wajib diisi.',
            'file_kk.file' => 'File KK harus berupa file.',
            'file_kk.mimes' => 'File KK harus berupa file dengan format pdf.',
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
