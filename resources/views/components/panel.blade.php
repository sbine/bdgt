<div class="bg-white rounded-xs shadow-sm">
    <div class="bg-blue-700 rounded-t px-4 py-1"></div>

    <div class="px-6 py-8">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="bg-gray-100 border-t border-gray-400 text-center text-gray-600 text-sm rounded-b p-4">
            {{ $footer }}
        </div>
    @endisset
</div>
