<form class="flex flex-col" method="POST" action="{{ $formAction }}">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <h4 class="text-2xl mb-10">{{ $title }}</h4>

    {{ $slot }}

    <div class="flex justify-between mt-10">
        <button type="button" class="button" @click="setTo(false)">{{ $dismissLabel }}</button>
        <button type="submit" class="button button--primary">{{ $submitLabel }}</button>
    </div>
</form>
