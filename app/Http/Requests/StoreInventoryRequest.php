<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', [
            Inventory::class,
            $this->route('current_team'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inventory' => ['required', 'array'],
            'inventory.date' => ['required', 'date', 'unique:inventories,date'],

            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', Rule::exists('products', 'id')->where('team_id', $this->route('current_team')->id)],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.total_cost' => ['required', 'numeric', 'min:0'],
            'products.*.total_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
