<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.backups.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('backups.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.status')
                        </h5>
                        <span>{{ $backup->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.source_id')
                        </h5>
                        <span
                            >{{ optional($backup->source)->name ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.destination_id')
                        </h5>
                        <span
                            >{{ optional($backup->destination)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.disk_name')
                        </h5>
                        <span>{{ $backup->disk_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.path')
                        </h5>
                        <span>{{ $backup->path ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.size_in_kb')
                        </h5>
                        <span>{{ $backup->size_in_kb ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.real_size_in_kb')
                        </h5>
                        <span>{{ $backup->real_size_in_kb ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.completed_at')
                        </h5>
                        <span>{{ $backup->completed_at ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.rsync_summary')
                        </h5>
                        <span>{{ $backup->rsync_summary ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.rsync_time_in_seconds')
                        </h5>
                        <span>{{ $backup->rsync_time_in_seconds ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.rsync_current_transfer_speed')
                        </h5>
                        <span
                            >{{ $backup->rsync_current_transfer_speed ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.backups.inputs.rsync_average_transfer_speed_in_MB_per_second')
                        </h5>
                        <span
                            >{{
                            $backup->rsync_average_transfer_speed_in_MB_per_second
                            ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('backups.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Backup::class)
                    <a href="{{ route('backups.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
