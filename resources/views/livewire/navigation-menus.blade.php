<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    {{-- Data Table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Sequence
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Label
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Url
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $item->type }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $item->sequence }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $item->label }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    <a class="text-indigo-600 hover:text-indigo-900" target="_blank" href="{{ url("/$item->slug") }}">
                                        {{ $item->slug }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                                        {{ __('Edit') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                                        {{ __('Delete') }}
                                    </x-jet-danger-button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">
                                    No Results Found
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br />
    {{ $data->links() }}

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            @if ($isDelete)
            {{ __('Delete Page') }}
            @elseif ($modelId)
            {{ __('Update Page') }}
            @else
            {{ __('Save Page') }}
            @endif
        </x-slot>

        <x-slot name="content">
            @if ($isDelete)
            {{ __('Are you sure you want to delete this navigation item?') }}
            @else
            <div class="mt-4">
                <x-jet-label for="label" value="{{ __('Label') }}" />
                <x-jet-input id="label" class="block mt-1 w-full" type="text" wire:model.debounce.500ms="label"
                    required />
                @error('label') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span
                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                        {{ config('app.url') }}:8000/
                    </span>
                    <input id="slug" wire:model="slug"
                        class="flex-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-r-md w-full shadow-sm"
                        type="text" placeholder="url-slug" required />
                </div>
                @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4 flex items-center space-x-4">
                <div class="flex-1">
                    <x-jet-label for="type" value="{{ __('Type') }}" />
                    <select id="type"
                        class="mx-auto text-center appearance-none w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                        wire:model="type">
                        <option value="SidebarNav">SidebarNav</option>
                        <option value="TopNav">TopNav</option>
                    </select>
                </div>
                <div class="flex-1">
                    <x-jet-label for="sequence" value="{{ __('Sequence') }}" />
                    <x-jet-input id="sequence" class="block mt-1 w-full text-center" type="text"
                        wire:model.debounce.800ms="sequence" required />
                    @error('sequence') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($isDelete)
            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
            @elseif($modelId)
            <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>