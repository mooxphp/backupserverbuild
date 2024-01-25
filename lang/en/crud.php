<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'backups' => [
        'name' => 'Backups',
        'index_title' => 'Backups List',
        'new_title' => 'New Backup',
        'create_title' => 'Create Backup',
        'edit_title' => 'Edit Backup',
        'show_title' => 'Show Backup',
        'inputs' => [
            'status' => 'Status',
            'source_id' => 'Source',
            'destination_id' => 'Destination',
            'disk_name' => 'Disk Name',
            'path' => 'Path',
            'size_in_kb' => 'Size In Kb',
            'real_size_in_kb' => 'Real Size In Kb',
            'completed_at' => 'Completed At',
            'rsync_summary' => 'Rsync Summary',
            'rsync_time_in_seconds' => 'Rsync Time In Seconds',
            'rsync_current_transfer_speed' => 'Rsync Current Transfer Speed',
            'rsync_average_transfer_speed_in_MB_per_second' =>
                'Rsync Average Transfer Speed In Mb Per Second',
        ],
    ],

    'backup_log_items' => [
        'name' => 'Backup Log Items',
        'index_title' => 'BackupLogItems List',
        'new_title' => 'New Backup log item',
        'create_title' => 'Create BackupLogItem',
        'edit_title' => 'Edit BackupLogItem',
        'show_title' => 'Show BackupLogItem',
        'inputs' => [
            'source_id' => 'Source',
            'backup_id' => 'Backup',
            'destination_id' => 'Destination Id',
            'task' => 'Task',
            'level' => 'Level',
            'message' => 'Message',
        ],
    ],

    'destinations' => [
        'name' => 'Destinations',
        'index_title' => 'Destinations List',
        'new_title' => 'New Destination',
        'create_title' => 'Create Destination',
        'edit_title' => 'Edit Destination',
        'show_title' => 'Show Destination',
        'inputs' => [
            'status' => 'Status',
            'name' => 'Name',
            'disk_name' => 'Disk Name',
            'keep_all_backups_for_days' => 'Keep All Backups For Days',
            'keep_daily_backups_for_days' => 'Keep Daily Backups For Days',
            'keep_weekly_backups_for_weeks' => 'Keep Weekly Backups For Weeks',
            'keep_monthly_backups_for_months' =>
                'Keep Monthly Backups For Months',
            'keep_yearly_backups_for_years' => 'Keep Yearly Backups For Years',
            'delete_oldest_backups_when_using_more_megabytes_than' =>
                'Delete Oldest Backups When Using More Megabytes Than',
            'healthy_maximum_backup_age_in_days_per_source' =>
                'Healthy Maximum Backup Age In Days Per Source',
            'healthy_maximum_storage_in_mb_per_source' =>
                'Healthy Maximum Storage In Mb Per Source',
            'healthy_maximum_storage_in_mb' => 'Healthy Maximum Storage In Mb',
            'healthy_maximum_inode_usage_percentage' =>
                'Healthy Maximum Inode Usage Percentage',
        ],
    ],

    'sources' => [
        'name' => 'Sources',
        'index_title' => 'Sources List',
        'new_title' => 'New Source',
        'create_title' => 'Create Source',
        'edit_title' => 'Edit Source',
        'show_title' => 'Show Source',
        'inputs' => [
            'status' => 'Status',
            'healthy' => 'Healthy',
            'name' => 'Name',
            'host' => 'Host',
            'ssh_user' => 'Ssh User',
            'ssh_port' => 'Ssh Port',
            'ssh_private_key_file' => 'Ssh Private Key File',
            'cron_expression' => 'Cron Expression',
            'pre_backup_commands' => 'Pre Backup Commands',
            'post_backup_commands' => 'Post Backup Commands',
            'includes' => 'Includes',
            'excludes' => 'Excludes',
            'destination_id' => 'Destination',
            'cleanup_strategy_class' => 'Cleanup Strategy Class',
            'keep_all_backups_for_days' => 'Keep All Backups For Days',
            'keep_daily_backups_for_days' => 'Keep Daily Backups For Days',
            'keep_weekly_backups_for_weeks' => 'Keep Weekly Backups For Weeks',
            'keep_monthly_backups_for_months' =>
                'Keep Monthly Backups For Months',
            'keep_yearly_backups_for_years' => 'Keep Yearly Backups For Years',
            'delete_oldest_backups_when_using_more_megabytes_than' =>
                'Delete Oldest Backups When Using More Megabytes Than',
            'healthy_maximum_backup_age_in_days' =>
                'Healthy Maximum Backup Age In Days',
            'healthy_maximum_storage_in_mb' => 'Healthy Maximum Storage In Mb',
        ],
    ],
];
