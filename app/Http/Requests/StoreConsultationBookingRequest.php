<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'client_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,filter', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30', 'regex:/^[\d\s\+\-\(\)]+$/u'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_slot_id' => ['nullable', 'integer', 'exists:booking_slots,id'],
            'time_label' => ['required', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'client_name' => 'الاسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'الهاتف',
            'booking_date' => 'تاريخ الحجز',
            'booking_slot_id' => 'الوقت',
            'time_label' => 'الوقت',
            'note' => 'ملاحظة',
        ];
    }
}
