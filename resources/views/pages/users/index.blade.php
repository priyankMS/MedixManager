@extends('layout.master')

@section('content')
    <div class="container">
        <div class="row">
            <section class="header">
                <div>
                    <h1>User List</p>
                </div>
            </section>
        </div>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					@include('pages.users.componet.list')
				</div>
			</div>
		</div>
    </div>
@endsection
