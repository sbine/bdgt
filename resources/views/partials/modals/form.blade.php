<div class="modal-dialog">
    <form class="flex flex-col" method="POST" action="{{ $formAction }}">
        @csrf
        @if (isset($method))
            @method($method)
        @endif

        <h4 class="text-2xl mb-10">{{ $title }}</h4>

        {{ $slot }}

        <div class="flex justify-between mt-10">
            <button type="button" class="button" data-dismiss="modal">{{ $dismissLabel }}</button>
            <button type="submit" class="button button--primary">{{ $submitLabel }}</button>
        </div>
    </form>
</div>
