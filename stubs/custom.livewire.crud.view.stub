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
                                    Header 1
                                    </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Header 2
                                    </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Header 3
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
                                    Data 1
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    Data 2
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    Data 3
                                </td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <x-jet-button wire:click="updateShowModal(1)">
                                        {{ __('Edit') }}
                                    </x-jet-button>
                                    <x-jet-danger-button wire:click="deleteShowModal(1)">
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
            {{ __('Are you sure you want to delete this page? Once the page is deleted. all of its resources and data
            will be permanently deleted.') }}
            @else
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title"
                    required />
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            @if ($isDelete)
            <x-jet-danger-button class="ml-2" wire:click="deletePage" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-jet-danger-button>
            @elseif($modelId)
            <x-jet-button class="ml-2" wire:click="updatePage" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" wire:click="createPage" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>