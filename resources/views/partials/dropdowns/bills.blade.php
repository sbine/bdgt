<option></option>
@foreach ($bills as $bill)
    <option value="{{ $bill->id }}">{{ $bill->label }}</option>
@endforeach
