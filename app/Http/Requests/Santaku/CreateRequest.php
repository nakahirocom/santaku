<?php

namespace App\Http\Requests\Santaku;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question' => 'required|max:200',
            'answer' => 'required|max:100',
            'comment' => 'required|max:200',

        ];
    }

    // Requestクラスのuser関数で今自分がログインしているユーザーが取得できる。
    public function userId(): int
    {
        return $this->user()->id;
    }

    public function question(): string
    {
        return $this->input('question');
    }

    public function answer(): string
    {
        return $this->input('answer');
    }

    public function comment(): string
    {
        return $this->input('comment');
    }

    public function question_path(): string
    {
        return $this->input('question_path') ?? '';
    }

    public function comment_path(): string
    {
        return $this->input('comment_path') ?? '';
    }


    public function reference_url(): string
    {
        return $this->input('reference_url') ?? '';
    }

}
