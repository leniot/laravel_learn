<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministratorLoginRequest extends FormRequest
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
            'login_name' => 'required',
            'password' => ['required', 'min:6'] //密码必须，最小长度为6
        ];
    }

    /**
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login_name.required' => '请输入用户名',
            'password.required' => '请输入密码',
            'password.min' => '密码至少6位',
        ];
    }
}
