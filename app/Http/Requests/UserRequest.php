<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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
            'name' => 'between:3,255|unique:users,name,' . Auth::id(),
            'description' => 'between:3,255',
            'avatar' => 'mimes:jpeg,bmp,png,gif|dimensions:min_width=1,min_height=1',
            'password'=>'between:8,25',
            'email'=>'email|unique:users,email,'.Auth::id(),
            'captcha'=>'required|captcha'
        ];

    }
    public function messages()
    {
       return [
           'name.unique'=>'名称已重复注册',
           'email.unique'=>'邮箱已重复注册',
           'avatar.mimes'=>'请上传jpeg,bmp,png,gif格式图片',
           'avatar.dimensions'=>'请上传长宽1以上的图片',
           'password.between'=>'密码长度大于8小于25个字符',
           'captcha.required' => '验证码不能为空',
           'captcha.captcha' => '请输入正确的验证码',
       ];
    }
}
