@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active ? ' bg-sky-50 text-sky-600' : 'text-gray-700 hover:bg-gray-200 hover:text-gray-700 transition-colors' }}
        flex items-center gap-2 px-4 py-3 text-sm font-medium rounded-lg hover:bg-gray-50 text-gray-700"
    aria-current="{{ $active ? 'page' : false }}">


    {{ $slot }}
</a>
