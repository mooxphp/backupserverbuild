@php $editing = isset($backupLogItem) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="source_id" label="Source" required>
            @php $selected = old('source_id', ($editing ? $backupLogItem->source_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Source</option>
            @foreach($sources as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="backup_id" label="Backup" required>
            @php $selected = old('backup_id', ($editing ? $backupLogItem->backup_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Backup</option>
            @foreach($backups as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="destination_id"
            label="Destination Id"
            :value="old('destination_id', ($editing ? $backupLogItem->destination_id : ''))"
            maxlength="255"
            placeholder="Destination Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="task"
            label="Task"
            :value="old('task', ($editing ? $backupLogItem->task : ''))"
            maxlength="255"
            placeholder="Task"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="level"
            label="Level"
            :value="old('level', ($editing ? $backupLogItem->level : ''))"
            maxlength="255"
            placeholder="Level"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="message"
            label="Message"
            maxlength="255"
            required
            >{{ old('message', ($editing ? $backupLogItem->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
