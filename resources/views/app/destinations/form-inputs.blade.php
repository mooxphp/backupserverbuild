@php $editing = isset($destination) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $destination->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $destination->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="disk_name"
            label="Disk Name"
            :value="old('disk_name', ($editing ? $destination->disk_name : ''))"
            maxlength="255"
            placeholder="Disk Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_all_backups_for_days"
            label="Keep All Backups For Days"
            :value="old('keep_all_backups_for_days', ($editing ? $destination->keep_all_backups_for_days : ''))"
            max="255"
            placeholder="Keep All Backups For Days"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_daily_backups_for_days"
            label="Keep Daily Backups For Days"
            :value="old('keep_daily_backups_for_days', ($editing ? $destination->keep_daily_backups_for_days : ''))"
            max="255"
            placeholder="Keep Daily Backups For Days"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_weekly_backups_for_weeks"
            label="Keep Weekly Backups For Weeks"
            :value="old('keep_weekly_backups_for_weeks', ($editing ? $destination->keep_weekly_backups_for_weeks : ''))"
            max="255"
            placeholder="Keep Weekly Backups For Weeks"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_monthly_backups_for_months"
            label="Keep Monthly Backups For Months"
            :value="old('keep_monthly_backups_for_months', ($editing ? $destination->keep_monthly_backups_for_months : ''))"
            max="255"
            placeholder="Keep Monthly Backups For Months"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_yearly_backups_for_years"
            label="Keep Yearly Backups For Years"
            :value="old('keep_yearly_backups_for_years', ($editing ? $destination->keep_yearly_backups_for_years : ''))"
            max="255"
            placeholder="Keep Yearly Backups For Years"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="delete_oldest_backups_when_using_more_megabytes_than"
            label="Delete Oldest Backups When Using More Megabytes Than"
            :value="old('delete_oldest_backups_when_using_more_megabytes_than', ($editing ? $destination->delete_oldest_backups_when_using_more_megabytes_than : ''))"
            max="255"
            placeholder="Delete Oldest Backups When Using More Megabytes Than"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_backup_age_in_days_per_source"
            label="Healthy Maximum Backup Age In Days Per Source"
            :value="old('healthy_maximum_backup_age_in_days_per_source', ($editing ? $destination->healthy_maximum_backup_age_in_days_per_source : ''))"
            max="255"
            placeholder="Healthy Maximum Backup Age In Days Per Source"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_storage_in_mb_per_source"
            label="Healthy Maximum Storage In Mb Per Source"
            :value="old('healthy_maximum_storage_in_mb_per_source', ($editing ? $destination->healthy_maximum_storage_in_mb_per_source : ''))"
            max="255"
            placeholder="Healthy Maximum Storage In Mb Per Source"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_storage_in_mb"
            label="Healthy Maximum Storage In Mb"
            :value="old('healthy_maximum_storage_in_mb', ($editing ? $destination->healthy_maximum_storage_in_mb : ''))"
            max="255"
            placeholder="Healthy Maximum Storage In Mb"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_inode_usage_percentage"
            label="Healthy Maximum Inode Usage Percentage"
            :value="old('healthy_maximum_inode_usage_percentage', ($editing ? $destination->healthy_maximum_inode_usage_percentage : ''))"
            max="255"
            placeholder="Healthy Maximum Inode Usage Percentage"
        ></x-inputs.number>
    </x-inputs.group>
</div>
