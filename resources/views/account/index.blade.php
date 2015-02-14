@extends('app')

@section('breadcrumbs.items')
	<li><a href="/accounts">Accounts</a></li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="list-group">
					<div class="list-group-item">
						<div class="list-group-item-text">
							<div class="pull-right">
								<a href="#addAccountModal" data-toggle="modal" class="btn btn-success">
									<i class="fa fa-plus"></i> Add Account
								</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					@foreach ($accounts as $account)
						<a href="/accounts/{{ $account->id }}" class="list-group-item">
							<span class="badge">{{ $account->transactions->count() }}</span>
							<h4 class="list-group-item-heading">{{ $account->name }}</h4>
							<p class="list-group-item-text">$ {{ number_format($account->balance, 2) }}</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div id="addAccountModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/accounts">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add an Account</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="name" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Balance</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="balance">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Interest Rate</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" name="interest">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Date Opened</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="date_opened">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
@endsection