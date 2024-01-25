@php $editing = isset($backup) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="status"
            label="Status"
            :value="old('status', ($editing ? $backup->status : ''))"
            maxlength="255"
            placeholder="Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="source_id" label="Source" required>
            @php $selected = old('source_id', ($editing ? $backup->source_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Source</option>
            @foreach($sources as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="destination_id" label="Destination" required>
            @php $selected = old('destination_id', ($editing ? $backup->destination_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Destination</option>
            @foreach($destinations as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="disk_name"
            label="Disk Name"
            :value="old('disk_name', ($editing ? $backup->disk_name : ''))"
            maxlength="255"
            placeholder="Disk Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="path"
            label="Path"
            :value="old('path', ($editing ? $backup->path : ''))"
            maxlength="255"
            placeholder="Path"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="size_in_kb"
            label="Size In Kb"
            :value="old('size_in_kb', ($editing ? $backup->size_in_kb : ''))"
            maxlength="255"
            placeholder="Size In Kb"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="real_size_in_kb"
            label="Real Size In Kb"
            :value="old('real_size_in_kb', ($editing ? $backup->real_size_in_kb : ''))"
            maxlength="255"
            placeholder="Real Size In Kb"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="completed_at"
            label="Completed At"
            value="{{ old('completed_at', ($editing ? optional($backup->completed_at)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="rsync_summary"
            label="Rsync Summary"
            maxlength="255"
            >{{ old('rsync_summary', ($editing ? $backup->rsync_summary : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="rsync_time_in_seconds"
            label="Rsync Time In Seconds"
            :value="old('rsync_time_in_seconds', ($editing ? $backup->rsync_time_in_seconds : ''))"
            maxlength="255"
            placeholder="Rsync Time In Seconds"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="rsync_current_transfer_speed"
            label="Rsync Current Transfer Speed"
            :value="old('rsync_current_transfer_speed', ($editing ? $backup->rsync_current_transfer_speed : ''))"
            maxlength="255"
            placeholder="Rsync Current Transfer Speed"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="rsync_average_transfer_speed_in_MB_per_second"
            label="Rsync Average Transfer Speed In Mb Per Second"
            :value="old('rsync_average_transfer_speed_in_MB_per_second', ($editing ? $backup->rsync_average_transfer_speed_in_MB_per_second : ''))"
            maxlength="255"
            placeholder="Rsync Average Transfer Speed In Mb Per Second"
        ></x-inputs.text>
    </x-inputs.group>
</div>
