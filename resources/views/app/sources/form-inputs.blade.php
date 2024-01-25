@php $editing = isset($source) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $source->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="healthy"
            label="Healthy"
            :value="old('healthy', ($editing ? $source->healthy : ''))"
            maxlength="255"
            placeholder="Healthy"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $source->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="host"
            label="Host"
            :value="old('host', ($editing ? $source->host : ''))"
            maxlength="255"
            placeholder="Host"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ssh_user"
            label="Ssh User"
            :value="old('ssh_user', ($editing ? $source->ssh_user : ''))"
            maxlength="255"
            placeholder="Ssh User"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="ssh_port"
            label="Ssh Port"
            :value="old('ssh_port', ($editing ? $source->ssh_port : ''))"
            max="255"
            placeholder="Ssh Port"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="ssh_private_key_file"
            label="Ssh Private Key File"
            :value="old('ssh_private_key_file', ($editing ? $source->ssh_private_key_file : ''))"
            maxlength="255"
            placeholder="Ssh Private Key File"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cron_expression"
            label="Cron Expression"
            :value="old('cron_expression', ($editing ? $source->cron_expression : ''))"
            maxlength="255"
            placeholder="Cron Expression"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="pre_backup_commands"
            label="Pre Backup Commands"
            maxlength="255"
            >{{ old('pre_backup_commands', ($editing ?
            json_encode($source->pre_backup_commands) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="post_backup_commands"
            label="Post Backup Commands"
            maxlength="255"
            >{{ old('post_backup_commands', ($editing ?
            json_encode($source->post_backup_commands) : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="includes" label="Includes" maxlength="255"
            >{{ old('includes', ($editing ? json_encode($source->includes) :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="excludes" label="Excludes" maxlength="255"
            >{{ old('excludes', ($editing ? json_encode($source->excludes) :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="destination_id" label="Destination">
            @php $selected = old('destination_id', ($editing ? $source->destination_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Destination</option>
            @foreach($destinations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="cleanup_strategy_class"
            label="Cleanup Strategy Class"
            :value="old('cleanup_strategy_class', ($editing ? $source->cleanup_strategy_class : ''))"
            maxlength="255"
            placeholder="Cleanup Strategy Class"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_all_backups_for_days"
            label="Keep All Backups For Days"
            :value="old('keep_all_backups_for_days', ($editing ? $source->keep_all_backups_for_days : ''))"
            max="255"
            placeholder="Keep All Backups For Days"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_daily_backups_for_days"
            label="Keep Daily Backups For Days"
            :value="old('keep_daily_backups_for_days', ($editing ? $source->keep_daily_backups_for_days : ''))"
            max="255"
            placeholder="Keep Daily Backups For Days"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_weekly_backups_for_weeks"
            label="Keep Weekly Backups For Weeks"
            :value="old('keep_weekly_backups_for_weeks', ($editing ? $source->keep_weekly_backups_for_weeks : ''))"
            max="255"
            placeholder="Keep Weekly Backups For Weeks"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_monthly_backups_for_months"
            label="Keep Monthly Backups For Months"
            :value="old('keep_monthly_backups_for_months', ($editing ? $source->keep_monthly_backups_for_months : ''))"
            max="255"
            placeholder="Keep Monthly Backups For Months"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="keep_yearly_backups_for_years"
            label="Keep Yearly Backups For Years"
            :value="old('keep_yearly_backups_for_years', ($editing ? $source->keep_yearly_backups_for_years : ''))"
            max="255"
            placeholder="Keep Yearly Backups For Years"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="delete_oldest_backups_when_using_more_megabytes_than"
            label="Delete Oldest Backups When Using More Megabytes Than"
            :value="old('delete_oldest_backups_when_using_more_megabytes_than', ($editing ? $source->delete_oldest_backups_when_using_more_megabytes_than : ''))"
            max="255"
            placeholder="Delete Oldest Backups When Using More Megabytes Than"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_backup_age_in_days"
            label="Healthy Maximum Backup Age In Days"
            :value="old('healthy_maximum_backup_age_in_days', ($editing ? $source->healthy_maximum_backup_age_in_days : ''))"
            max="255"
            placeholder="Healthy Maximum Backup Age In Days"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="healthy_maximum_storage_in_mb"
            label="Healthy Maximum Storage In Mb"
            :value="old('healthy_maximum_storage_in_mb', ($editing ? $source->healthy_maximum_storage_in_mb : ''))"
            max="255"
            placeholder="Healthy Maximum Storage In Mb"
        ></x-inputs.number>
    </x-inputs.group>
</div>
