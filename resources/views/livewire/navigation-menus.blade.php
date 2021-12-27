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
                            {{-- @if ($data->count())
                            @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {{ $item->title }}
                                    @php
                                    switch ($item->default_page) {
                                    case 'home':
                                    echo '<span class="text-green-400 text-xs font-bold">[Default
                                        Home Page]</span>';
                                    break;
                                    case 'error':
                                    echo '<span class="text-red-400 text-xs font-bold">[Default
                                        404 Error Page]</span>';
                                    break;
                                    default:
                                    echo '';
                                    break;
                                    }
                                    @endphp
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    <a class="text-indigo-600 hover:text-indigo-900" target="_blank" href="{{ url("/$item->slug") }}">
                                        {{ $item->slug }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-no-wrap">
                                    {!! \Illuminate\Support\Str::limit($item->content,50,'...') !!}
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
                            @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br />
    {{-- {{ $data->links() }} --}}

    {{-- Modal Form --}}
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{-- @if ($isDelete)
            {{ __('Delete Page') }}
            @elseif ($modelId)
            {{ __('Update Page') }}
            @else
            {{ __('Save Page') }}
            @endif --}}
        </x-slot>
        $table->integer('sequence');
        $table->enum('type', ['sidebarNav', 'TopNav']);
        $table->string('label');
        $table->string('slug');
        <x-slot name="content">
            {{-- @if ($isDelete)
            {{ __('Are you sure you want to delete this navigation item?') }}
            @else
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title"
                    required />
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
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
            <div class="mt-4 flex items-center">
                <x-jet-label for="defaultPage" value="{{ __('Default Page') }}" />
                <select id="defaultPage"
                    class="mx-auto w-1/2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 shadow-sm"
                    wire:model="defaultPage">
                    <option value="">None</option>
                    <option value="home">Home page</option>
                    <option value="error">404 Error</option>
                </select>
            </div>
            <div class="mt-4">
                <x-jet-label for="title" value="{{ __('Content') }}" />
                <div class="rounded-md shadow-sm">
                    <div class="mt-1 bg-white">
                        <div class="body-content" wire:ignore>
                            <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.100000ms="content"
                                wire:key="trix-content-unique-key">
                            </trix-editor>
                        </div>
                    </div>
                </div>
                @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            @endif --}}
        </x-slot>

        <x-slot name="footer">
            {{-- <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
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
            @endif --}}
        </x-slot>
    </x-jet-dialog-modal>
</div>