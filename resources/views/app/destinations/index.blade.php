<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.destinations.index_title')
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
                            @can('create', App\Models\Destination::class)
                            <a
                                href="{{ route('destinations.create') }}"
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
                                    @lang('crud.destinations.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.destinations.inputs.name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.destinations.inputs.disk_name')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.keep_all_backups_for_days')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.keep_daily_backups_for_days')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.keep_weekly_backups_for_weeks')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.keep_monthly_backups_for_months')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.keep_yearly_backups_for_years')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.delete_oldest_backups_when_using_more_megabytes_than')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.healthy_maximum_backup_age_in_days_per_source')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.healthy_maximum_storage_in_mb_per_source')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.healthy_maximum_storage_in_mb')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.destinations.inputs.healthy_maximum_inode_usage_percentage')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($destinations as $destination)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $destination->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $destination->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $destination->disk_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $destination->keep_all_backups_for_days
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $destination->keep_daily_backups_for_days
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->keep_weekly_backups_for_weeks
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->keep_monthly_backups_for_months
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->keep_yearly_backups_for_years
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->delete_oldest_backups_when_using_more_megabytes_than
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->healthy_maximum_backup_age_in_days_per_source
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->healthy_maximum_storage_in_mb_per_source
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->healthy_maximum_storage_in_mb
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $destination->healthy_maximum_inode_usage_percentage
                                    ?? '-' }}
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
                                        @can('update', $destination)
                                        <a
                                            href="{{ route('destinations.edit', $destination) }}"
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
                                        @endcan @can('view', $destination)
                                        <a
                                            href="{{ route('destinations.show', $destination) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $destination)
                                        <form
                                            action="{{ route('destinations.destroy', $destination) }}"
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
                                <td colspan="14">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="14">
                                    <div class="mt-10 px-4">
                                        {!! $destinations->render() !!}
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
