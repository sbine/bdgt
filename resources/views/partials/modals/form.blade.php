<form method="POST" action="{{ $formAction }}">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="sm:w-5/6 p-8">
        <h4 class="text-2xl mb-10">{{ $title }}</h4>

        <div>
            {{ $slot }}
        </div>
    </div>

    <div class="flex justify-end bg-gray-100 border-t border-gray-400 px-8 xl:px-10 py-6">
        <button type="button" class="link mr-6" @click="setTo(false)">{{ $dismissLabel }}</button>
        <button type="submit" class="button button--primary">{{ $submitLabel }}</button>
    </div>
</form>
