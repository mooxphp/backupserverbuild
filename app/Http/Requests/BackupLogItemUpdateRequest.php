<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackupLogItemUpdateRequest extends FormRequest
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
            'source_id' => ['required', 'exists:backup_server_sources,id'],
            'backup_id' => ['required', 'exists:backup_server_backups,id'],
            'destination_id' => ['required', 'max:255'],
            'task' => ['required', 'max:255', 'string'],
            'level' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:255', 'string'],
        ];
    }
}
