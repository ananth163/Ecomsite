@extends('admin.layout.base')

@section('title', 'Manage Payments')

@section('pageid', 'adminPayments')

@section('content')
	<div class="payments admin_shared">
		<div class="grid-x ">
				<h2>Manage Payments</h2>
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
			@if(count($payments) == 0)
				<h2>No Payments available to display</h2>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Customer</th>
      							<th>Payment ID</th>
      							<th>Amount</th>
      							<th>Status</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($payments as $payment)
  								<tr>
  									<td>{{$payment->user->username}}</td>
  									<td>{{substr($payment->client_secret,3,24)}}</td>
  									<td>
  										₹{{$payment->amount/100}}
  									</td>
  									<td>
  										{{$payment->status}}
  									</td>
  									<td>{{$payment->updated_at->toFormattedDateString()}}</td>
  									<td>  										
  										<a data-open="deleteitem-{{$payment->id}}">
  											<i class="fas fa-trash"></i>
  										</a>
  										@include('includes.deletemodal', ['id'   => $payment->id, 
  																				'name' => $payment->name,
  																				'item' => 'payment'] )
  									</td>
  								</tr>  								
  							@endforeach
  						</tbody>					
					</table>
					{{ $payments->links('pagination.pagination', 
													['paginator' => $payments]) }}
				</div>
				
			@endif
		</div>
	</div>

@endsection