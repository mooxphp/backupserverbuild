<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackupUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'max:255', 'string'],
            'source_id' => ['required', 'exists:backup_server_sources,id'],
            'destination_id' => [
                'required',
                'exists:backup_server_destinations,id',
            ],
            'disk_name' => ['required', 'max:255', 'string'],
            'path' => ['nullable', 'max:255', 'string'],
            'size_in_kb' => ['nullable', 'max:255'],
            'real_size_in_kb' => ['nullable', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'rsync_summary' => ['nullable', 'max:255', 'string'],
            'rsync_time_in_seconds' => ['nullable', 'max:255'],
            'rsync_current_transfer_speed' => ['nullable', 'max:255', 'string'],
            'rsync_average_transfer_speed_in_MB_per_second' => [
                'nullable',
                'max:255',
                'string',
            ],
        ];
    }
}
