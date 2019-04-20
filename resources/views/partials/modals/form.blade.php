<div id="{{ $id }}" class="modal fade">
    <div class="modal-dialog">
        <form class="modal-content form-horizontal" method="POST" action="{{ $formAction }}">
            @csrf
            @if (isset($method))
                @method($method)
            @endif

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ $dismissLabel }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="button" data-dismiss="modal">{{ $dismissLabel }}</button>
                <button type="submit" class="class="button button--primary">{{ $submitLabel }}</button>
            </div>
        </form>
    </div>
</div>
