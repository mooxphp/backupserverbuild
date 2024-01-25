<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.backups.index_title')
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
                            @can('create', App\Models\Backup::class)
                            <a
                                href="{{ route('backups.create') }}"
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
                                    @lang('crud.backups.inputs.status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.source_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.destination_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.disk_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.path')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.size_in_kb')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.real_size_in_kb')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.completed_at')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.rsync_summary')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.rsync_time_in_seconds')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.rsync_current_transfer_speed')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.backups.inputs.rsync_average_transfer_speed_in_MB_per_second')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($backups as $backup)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->status ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($backup->source)->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($backup->destination)->name ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->disk_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->path ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->size_in_kb ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->real_size_in_kb ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->completed_at ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->rsync_summary ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->rsync_time_in_seconds ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $backup->rsync_current_transfer_speed ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    $backup->rsync_average_transfer_speed_in_MB_per_second
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
                                        @can('update', $backup)
                                        <a
                                            href="{{ route('backups.edit', $backup) }}"
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
                                        @endcan @can('view', $backup)
                                        <a
                                            href="{{ route('backups.show', $backup) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $backup)
                                        <form
                                            action="{{ route('backups.destroy', $backup) }}"
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
                                <td colspan="13">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="13">
                                    <div class="mt-10 px-4">
                                        {!! $backups->render() !!}
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
