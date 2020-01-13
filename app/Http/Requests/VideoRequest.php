<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'title'=>'required|between:1,30',
            'description'=>'required|between:1,255',
            'video_path'=>'max:1048576',
            'video_type'=>'file|required',
            'captcha' => 'required|captcha',
            'video_type'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'video_type.required'=>'请选择一个分区',
            'video_path.max'=>'最大视频文件不得超过1024MB',
            'title.between'=>'标题在1到30字之间',
            'description.between'=>'简介在1到255字之间',
            'captcha.captcha'=>'验证码错误',
            'captcha.required'=>'请输入验证码',
        ];
    }
}
