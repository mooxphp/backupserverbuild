<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.sources.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('sources.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.status')
                        </h5>
                        <span>{{ $source->status ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.healthy')
                        </h5>
                        <span>{{ $source->healthy ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.name')
                        </h5>
                        <span>{{ $source->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.host')
                        </h5>
                        <span>{{ $source->host ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.ssh_user')
                        </h5>
                        <span>{{ $source->ssh_user ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.ssh_port')
                        </h5>
                        <span>{{ $source->ssh_port ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.ssh_private_key_file')
                        </h5>
                        <span>{{ $source->ssh_private_key_file ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.cron_expression')
                        </h5>
                        <span>{{ $source->cron_expression ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.pre_backup_commands')
                        </h5>
                        <pre>
{{ json_encode($source->pre_backup_commands) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.post_backup_commands')
                        </h5>
                        <pre>
{{ json_encode($source->post_backup_commands) ?? '-' }}</pre
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.includes')
                        </h5>
                        <pre>{{ json_encode($source->includes) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.excludes')
                        </h5>
                        <pre>{{ json_encode($source->excludes) ?? '-' }}</pre>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.destination_id')
                        </h5>
                        <span
                            >{{ optional($source->destination)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.cleanup_strategy_class')
                        </h5>
                        <span
                            >{{ $source->cleanup_strategy_class ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.keep_all_backups_for_days')
                        </h5>
                        <span
                            >{{ $source->keep_all_backups_for_days ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.keep_daily_backups_for_days')
                        </h5>
                        <span
                            >{{ $source->keep_daily_backups_for_days ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.keep_weekly_backups_for_weeks')
                        </h5>
                        <span
                            >{{ $source->keep_weekly_backups_for_weeks ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.keep_monthly_backups_for_months')
                        </h5>
                        <span
                            >{{ $source->keep_monthly_backups_for_months ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.keep_yearly_backups_for_years')
                        </h5>
                        <span
                            >{{ $source->keep_yearly_backups_for_years ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.delete_oldest_backups_when_using_more_megabytes_than')
                        </h5>
                        <span
                            >{{
                            $source->delete_oldest_backups_when_using_more_megabytes_than
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.healthy_maximum_backup_age_in_days')
                        </h5>
                        <span
                            >{{ $source->healthy_maximum_backup_age_in_days ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.sources.inputs.healthy_maximum_storage_in_mb')
                        </h5>
                        <span
                            >{{ $source->healthy_maximum_storage_in_mb ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('sources.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Source::class)
                    <a href="{{ route('sources.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
