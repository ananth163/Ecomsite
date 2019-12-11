@extends('admin.layout.base')

@section('title', 'Manage Users')

@section('pageid', 'adminUsers')

@section('content')
	<div class="users admin_shared">
		<div class="grid-x ">
				<h2>Manage Users</h2>
				<hr />
		</div>
		@include('includes.messages')
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<form action="" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" placeholder="Search by ID">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Search">
		          	  </div>
			        </div>
				</form>
			</div>			
		</div>
		<div class="grid-x grid-padding-x">
			@if(count($users) == 0)
				<h2>No users available to display</h2>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>User ID</th>
      							<th>Username</th>
      							<th>Full Name</th>
                    <th>Email</th>
      							<th>Address</th>
      							<th>Role</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($users as $user)
  								<tr>
  									<td>{{$user->id}}</td>
  									<td>{{$user->username}}</td>
  									<td>{{$user->fullname}}</td>
  									<td>{{$user->email}}</td>
  									<td>{{$user->address}}</td>
  									<td>{{$user->role}}</td>
                    <td>{{$user->created_at->toFormattedDateString()}}</td>
  									<td>  										
  										<a data-open="deleteitem-{{$user->userNumber}}">
  											<i class="fas fa-trash"></i>
  										</a>
  										@include('includes.deletemodal', ['id'   => $user->id, 
  																				'name' => $user->username,
  																				'item' => 'user'] )
  									</td>
  								</tr>  								
  							@endforeach
  						</tbody>					
					</table>
					{{ $users->links('pagination.pagination', 
													['paginator' => $users]) }}
				</div>
				
			@endif
		</div>
	</div>

@endsection