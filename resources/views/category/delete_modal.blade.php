<div id="deleteCategoryModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/categories/{{ $category->id }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="DELETE">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">Delete Category</h3>
			</div>
			<div class="modal-body">
				<p class="text-danger">Are you sure you want to delete this category? This operation cannot be undone.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Delete</button>
			</div>
		</form>
	</div>
</div>