<div class="p-6">
    <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6">
        <x-jet-button wire:click="createShowModal">
            {{ __('Save User Permission') }}
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
                                    Role
                                </th>
                                <th
                                    class="px-6 bg-gray-50 text-left text-xs py-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Route Name
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
                                    {{ $item->role }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $item->route_name }}
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
            {{ __('Are you sure you want to delete this User Permission?') }}
            @else
            <div class="mt-4 grid gap-4 grid-cols-1 md:grid-cols-2">
                <div class="">
                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <select id="role"
                        class="mx-auto appearance-none w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                        wire:model="role" required>
                        <option value="">-- Select a Role --</option>
                        @foreach ($userRoleList as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <x-jet-label for="routeName" value="{{ __('Route Name') }}" />
                    <select id="routeName"
                        class="mx-auto appearance-none w-full mt-1 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                        wire:model="routeName" required>
                        <option value="">-- Select a Route Name --</option>
                        @foreach ($routeNameList as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    @error('role') <span class="text-red-500">{{ $message }}</span> @enderror
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