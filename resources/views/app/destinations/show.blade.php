<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.destinations.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('destinations.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.status')
                        </h5>
                        <span>{{ $destination->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.name')
                        </h5>
                        <span>{{ $destination->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.disk_name')
                        </h5>
                        <span>{{ $destination->disk_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.keep_all_backups_for_days')
                        </h5>
                        <span
                            >{{ $destination->keep_all_backups_for_days ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.keep_daily_backups_for_days')
                        </h5>
                        <span
                            >{{ $destination->keep_daily_backups_for_days ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.keep_weekly_backups_for_weeks')
                        </h5>
                        <span
                            >{{ $destination->keep_weekly_backups_for_weeks ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.keep_monthly_backups_for_months')
                        </h5>
                        <span
                            >{{ $destination->keep_monthly_backups_for_months ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.keep_yearly_backups_for_years')
                        </h5>
                        <span
                            >{{ $destination->keep_yearly_backups_for_years ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.delete_oldest_backups_when_using_more_megabytes_than')
                        </h5>
                        <span
                            >{{
                            $destination->delete_oldest_backups_when_using_more_megabytes_than
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.healthy_maximum_backup_age_in_days_per_source')
                        </h5>
                        <span
                            >{{
                            $destination->healthy_maximum_backup_age_in_days_per_source
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.healthy_maximum_storage_in_mb_per_source')
                        </h5>
                        <span
                            >{{
                            $destination->healthy_maximum_storage_in_mb_per_source
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.healthy_maximum_storage_in_mb')
                        </h5>
                        <span
                            >{{ $destination->healthy_maximum_storage_in_mb ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.destinations.inputs.healthy_maximum_inode_usage_percentage')
                        </h5>
                        <span
                            >{{
                            $destination->healthy_maximum_inode_usage_percentage
                            ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('destinations.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Destination::class)
                    <a href="{{ route('destinations.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
