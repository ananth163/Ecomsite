@extends('admin.layout.base')

@section('title', 'Manage Orders')

@section('pageid', 'adminOrders')

@section('content')
	<div class="orders admin_shared">
		<div class="grid-x ">
				<h2>Manage Orders</h2>
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
			@if(count($orders) == 0)
				<h2>No Orders available to display</h2>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Customer</th>
      							<th>Order No.</th>
      							<th># of Items</th>
      							<th>Amount</th>
      							<th>Status</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($orders as $order)
  								<tr>
  									<td>{{$order->username}}</td>
  									<td>{{$order->orderNumber}}</td>
  									<td>{{count($order->products)}}</td>
  									<td>
  										₹{{$order->amount}}
  									</td>
  									<td>
  										{{$order->status}}
  									</td>
  									<td>{{$order->placedAt}}</td>
  									<td>  
  										<a href="/admin/orders/{{$order->orderNumber}}"><i class="fas fa-edit"></i></a>										
  										<a data-open="deleteitem-{{$order->orderNumber}}">
  											<i class="fas fa-trash"></i>
  										</a>
  										@include('includes.deletemodal', ['id'   => $order->orderNumber, 
  																				'name' => $order->orderNumber,
  																				'item' => 'order'] )
  									</td>
  								</tr>  								
  							@endforeach
  						</tbody>					
					</table>
					{{ $orders->links('pagination.pagination', 
													['paginator' => $orders]) }}
				</div>
				
			@endif
		</div>
	</div>

@endsection