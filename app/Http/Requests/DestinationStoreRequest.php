<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'disk_name' => ['required', 'max:255', 'string'],
            'keep_all_backups_for_days' => ['nullable', 'numeric'],
            'keep_daily_backups_for_days' => ['nullable', 'numeric'],
            'keep_weekly_backups_for_weeks' => ['nullable', 'numeric'],
            'keep_monthly_backups_for_months' => ['nullable', 'numeric'],
            'keep_yearly_backups_for_years' => ['nullable', 'numeric'],
            'delete_oldest_backups_when_using_more_megabytes_than' => [
                'nullable',
                'numeric',
            ],
            'healthy_maximum_backup_age_in_days_per_source' => [
                'nullable',
                'numeric',
            ],
            'healthy_maximum_storage_in_mb_per_source' => [
                'nullable',
                'numeric',
            ],
            'healthy_maximum_storage_in_mb' => ['nullable', 'numeric'],
            'healthy_maximum_inode_usage_percentage' => ['nullable', 'numeric'],
        ];
    }
}
