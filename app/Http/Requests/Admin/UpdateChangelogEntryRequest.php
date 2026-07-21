<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChangelogEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'version' => ['required', 'string', 'max:20'],
            'released_at' => ['required', 'date'],
            'type' => ['required', 'string', 'in:feature,improvement,fix,release'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'author_name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'version' => 'رقم الإصدار',
            'released_at' => 'تاريخ الإصدار',
            'type' => 'النوع',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'author_name' => 'الكاتب',
        ];
    }
}
