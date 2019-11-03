<div class="bg-white rounded-sm shadow">
    <div class="bg-blue-700 rounded-t px-4 py-1"></div>

    <div class="py-8">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="bg-gray-100 border-t text-center text-gray-600 text-sm rounded-b p-4">
            {{ $footer }}
        </div>
    @endisset
</div>
