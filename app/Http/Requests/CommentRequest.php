<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentRequest extends Request
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

    public function rules()
    {
        return [
            'name'=>'required|max:200',
            'email'=>'required|email',
            'comment'=>'required'

        ];
    }
    public function messages()
    {
        return
            [
                'name.required'=>'لطفا نام خود را وارد نمایید',
                'name.max'=>'حداکثر کاراکتر مجاز برای نام 200 کاراکتر می باشد',
                'email.required'=>'لطفا ایمیل خود را وارد نمایید',
                'email.email'=>'ایمیل وارد شده معتبر نیست',
                'comment.required'=>'لطفا متن نظر خود را وارد نمایید'
            ];
    }
}
