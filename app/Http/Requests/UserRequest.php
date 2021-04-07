<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        if($this->isMethod('post')){
            return $this->storeRules();
        }elseif($this->isMethod('put')){
            return $this->updateRules();
        }
    }

    //Store Supplier
    public function storeRules(): array
    {
        return [
        ];
    }
    public function storeFilter()
    {
        return $this->only([
            'name',
            'email',
            'password',
        ]);
    }
}
