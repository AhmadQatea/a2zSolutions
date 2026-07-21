<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCaseStudyRequest extends FormRequest
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
            'service_id' => ['required', 'exists:services,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'focus_type' => ['required', 'string', 'in:problem,goal'],
            'client' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'string', 'max:50'],
            'title' => ['required', 'string', 'max:255'],
            'image_path' => ['required', 'string', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'highlight_value' => ['required', 'string', 'max:30'],
            'highlight_label' => ['required', 'string', 'max:255'],
            'problem' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'goal' => ['nullable', 'string'],
            'actions_taken' => ['nullable', 'string'],
            'stack' => ['nullable', 'string'],
            'results' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'service_id' => 'الخدمة',
            'project_id' => 'المشروع',
            'client' => 'العميل',
            'duration' => 'المدة',
            'title' => 'العنوان',
            'image_path' => 'مسار الصورة',
            'highlight_value' => 'قيمة الإنجاز',
            'highlight_label' => 'وصف الإنجاز',
        ];
    }
}
