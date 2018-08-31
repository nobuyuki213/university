<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registeredValiRequest extends FormRequest
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
            'university' => 'required|numeric',
            'name' => 'required|string|max:255|regex:/^[a-zA-Zぁ-んーァ-ヶー一-龠]+[ ][a-zA-Zぁ-んーァ-ヶー一-龠]+$/u',
            'name_phonetic' => 'required|string|regex:/^[ァ-ヶー]+[ ][ァ-ヶー]+$/u',
            'birth_year' => 'required|numeric',
            'birth_month' => 'required|numeric',
            'birth_day' => 'required|numeric',
            'admission_year' => 'required|numeric',
        ];
    }

    /**
     * [messages エラーメッセージのカスタマイズ]
     * @return [array] [description]
     */
    public function messages()
    {
        return [
            'university.required' => '大学を選択してください',
            'name.string' => '氏名は文字列で入力してください',
            'name.max' => '氏名は255文字以内で入力してください',
            'name.regex' => '氏名は、名字(姓)と名前(名)の間に半角スペースを入れて入力してください',
            'name_phonetic.string' => 'フリガナは文字列で入力してください',
            'name_phonetic.regex' => 'フリガナは、全角のカナで入力し、名字(姓)と名前(名)の間に半角スペースを入れて入力してください',
        ];
    }
}
