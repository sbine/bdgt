@foreach ($categories as $category)
	<option value="{{ $category->id }}">{{ $category->label }}</option>
@endforeach