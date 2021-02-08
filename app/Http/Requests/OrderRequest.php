<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'fname'=>'required|max:200',
            'lname'=>'required|max:200',
            'email'=>'required|email',
            'mobile'=>'required|numeric'

        ];
    }
    public function messages()
    {
        return
            [
                'fname.required'=>'لطفا نام خود را وارد نمایید',
                'fname.max'=>'حداکثر کاراکتر مجاز برای نام 200 کاراکتر می باشد',
                'lname.required'=>'لطفا نام خانوادگی خود را وارد نمایید',
                'lname.max'=>'حداکثر کاراکتر مجاز برای نام خانوادگی 200 کاراکتر می باشد',
                'email.required'=>'لطفا ایمیل خود را وارد نمایید',
                'email.email'=>'ایمیل وارد شده معتبر نیست',
                'mobile.required'=>'لطفا شماره موبایل خود را وارد نمایید',
                'mobile.numeric'=>'شماره موبایل باید به صورت عددی باشد'
            ];
    }
}