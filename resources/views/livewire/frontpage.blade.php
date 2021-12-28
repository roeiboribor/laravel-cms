<div class="divide-y divide-gray-800" x-data="{show: false}">
    <nav class="bg-gray-900 px-3 py-2 flex items-center shadow-lg">
        <div>
            <button @click="show = !show"
                class="block h-8 mr-3 text-gray-400 transition duration-300 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">
                    <path x-show="!show" fill-rule="evenodd"
                        d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                    <path x-show="show" fill-rule="evenodd"
                        d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z" />
                </svg>
            </button>
        </div>
        <div class="h-12 w-full flex items-center">
            <a href=" {{ url('/dashboard') }}" class="w-full">
                <img class="h-8" src="{{ asset('img/orig.svg') }}" alt="Logo">
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            {{-- Top Navigation --}}
            <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                @if ($topNavLinks->count())
                @foreach ($topNavLinks as $item)
                <a href="{{ url('/'.$item->slug) }}">
                    <li class="cursor-pointer px-4 py-2 hover:underline">{{ $item->label }}</li>
                </a>
                @endforeach
                @endif
            </ul>
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="bg-gray-900 text-gray-700 sm:w-4/12 md:w-3/12 lg:w-2/12 divide-y divide-gray-700 divide-dashed">
            {{-- Desktop web View --}}
            <ul class="hidden sm:block text-gray-200 text-xs sm:text-left">
                @if ($sidebarLinks->count())
                @foreach ($sidebarLinks as $item)
                <a href="{{ url('/'.$item->slug) }}">
                    <li class="cursor-pointer px-4 py-2 transition duration-300 hover:bg-gray-800">{{ $item->label }}
                    </li>
                </a>
                @endforeach
                @endif
            </ul>

            {{-- Mobile web View --}}
            <div x-show="show" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                <ul class="text-gray-200 text-xs">
                    @if ($sidebarLinks->count())
                    @foreach ($sidebarLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="cursor-pointer px-4 py-2 transition duration-300 hover:bg-gray-800">{{ $item->label
                            }}</li>
                    </a>
                    @endforeach
                    @endif
                </ul>

                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-gray-200 text-xs">
                    @if ($sidebarLinks->count())
                    @foreach ($sidebarLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">
                            {{ $item->label }}
                        </li>
                    </a>
                    @endforeach
                    @endif
                </ul>
            </div>
        </aside>
        <main class="bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
            <section class="divide-y text-gray-900">
                <h1 class="text-3xl font-bold">{{ $title }}</h1>
                <article>
                    <div class="mt-5 text-sm">
                        {!! $content !!}
                    </div>
                </article>
            </section>
        </main>
    </div>
</div>