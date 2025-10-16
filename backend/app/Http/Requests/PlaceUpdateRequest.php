<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\AppHelpers;

class PlaceUpdateRequest extends PlaceStoreRequest
{
    /**
     * Determine if the user is authorize to make this request
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request
     * 
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        return AppHelpers::updateHelperRules($rules);
    }
}
?>