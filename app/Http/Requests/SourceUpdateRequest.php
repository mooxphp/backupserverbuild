<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SourceUpdateRequest extends FormRequest
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
            'healthy' => ['required', 'max:255'],
            'name' => ['required', 'max:255', 'string'],
            'host' => ['required', 'max:255', 'string'],
            'ssh_user' => ['required', 'max:255', 'string'],
            'ssh_port' => ['required', 'numeric'],
            'ssh_private_key_file' => ['nullable', 'max:255', 'string'],
            'cron_expression' => ['required', 'max:255', 'string'],
            'pre_backup_commands' => ['nullable', 'max:255', 'json'],
            'post_backup_commands' => ['nullable', 'max:255', 'json'],
            'includes' => ['nullable', 'max:255', 'json'],
            'excludes' => ['nullable', 'max:255', 'json'],
            'destination_id' => [
                'nullable',
                'exists:backup_server_destinations,id',
            ],
            'cleanup_strategy_class' => ['nullable', 'max:255', 'string'],
            'keep_all_backups_for_days' => ['nullable', 'numeric'],
            'keep_daily_backups_for_days' => ['nullable', 'numeric'],
            'keep_weekly_backups_for_weeks' => ['nullable', 'numeric'],
            'keep_monthly_backups_for_months' => ['nullable', 'numeric'],
            'keep_yearly_backups_for_years' => ['nullable', 'numeric'],
            'delete_oldest_backups_when_using_more_megabytes_than' => [
                'nullable',
                'numeric',
            ],
            'healthy_maximum_backup_age_in_days' => ['nullable', 'numeric'],
            'healthy_maximum_storage_in_mb' => ['nullable', 'numeric'],
        ];
    }
}
