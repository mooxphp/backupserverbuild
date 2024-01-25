<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.sources.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Source::class)
                            <a
                                href="{{ route('sources.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.healthy')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.host')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.ssh_user')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.ssh_port')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.ssh_private_key_file')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.cron_expression')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.pre_backup_commands')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.post_backup_commands')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.includes')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.excludes')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.destination_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.sources.inputs.cleanup_strategy_class')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.keep_all_backups_for_days')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.keep_daily_backups_for_days')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.keep_weekly_backups_for_weeks')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.keep_monthly_backups_for_months')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.keep_yearly_backups_for_years')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.delete_oldest_backups_when_using_more_megabytes_than')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.healthy_maximum_backup_age_in_days')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.sources.inputs.healthy_maximum_storage_in_mb')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($sources as $source)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $source->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->healthy ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->host ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->ssh_user ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->ssh_port ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->ssh_private_key_file ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->cron_expression ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($source->pre_backup_commands) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($source->post_backup_commands) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($source->includes) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <pre>
{{ json_encode($source->excludes) ?? '-' }}</pre
                                    >
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($source->destination)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $source->cleanup_strategy_class ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->keep_all_backups_for_days ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->keep_daily_backups_for_days ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->keep_weekly_backups_for_weeks ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->keep_monthly_backups_for_months
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->keep_yearly_backups_for_years ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $source->delete_oldest_backups_when_using_more_megabytes_than
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $source->healthy_maximum_backup_age_in_days
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $source->healthy_maximum_storage_in_mb ??
                                    '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $source)
                                        <a
                                            href="{{ route('sources.edit', $source) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $source)
                                        <a
                                            href="{{ route('sources.show', $source) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $source)
                                        <form
                                            action="{{ route('sources.destroy', $source) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="23">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="23">
                                    <div class="mt-10 px-4">
                                        {!! $sources->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
