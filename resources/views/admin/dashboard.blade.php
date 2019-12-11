@extends('admin.layout.base')

@section('title', 'Dashboard')

@section('pageid', 'adminDashboard')

@section('content')
	<div class="dashboard admin_shared">
		<div class="grid-x collapse expanded" data-equalizer data-equalizer-on="medium">
			{{-- Order Summary --}}
			<div class="cell small-12 medium-3 summary" data-equalizer-watch>
				<div class="card" >
					<div class="card-divider">
						<div class="grid-x">
							<a href="#">Order Details</a>
						</div>
					</div>
					<div class="card-section">
						<div class="grid-x">
							<div class="cell small-3">
								<i class="fa fa-shopping-cart" aria-hidden="true"></i>
							</div>
							<div class="cell small-9">
								<p>Total Orders</p><h4>{{$orders}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- Stock Summary --}}
			<div class="cell small-12 medium-3 summary" data-equalizer-watch>
				<div class="card" >
					<div class="card-divider">
						<div class="grid-x">
							<a href="/admin/manage_inventory">View Products</a>
						</div>
					</div>
					<div class="card-section">
						<div class="grid-x">
							<div class="cell small-3">
								<i class="fa fa-thermometer-empty" aria-hidden="true"></i>
							</div>
							<div class="cell small-9">
								<p>Total Stock</p><h4>{{$products}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- Revenue Summary --}}
			<div class="cell small-12 medium-3 summary" data-equalizer-watch>
				<div class="card" >
					<div class="card-divider">
						<div class="grid-x">
							<a href="#">Payment Details</a>
						</div>
					</div>
					<div class="card-section">
						<div class="grid-x">
							<div class="cell small-3">
								<i class="fa fa-money-bill-wave" aria-hidden="true"></i>
							</div>
							<div class="cell small-9">
								<p>Revenue</p><h4>₹{{number_format($payments/100, 2)}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- Signup Summary --}}
			<div class="cell small-12 medium-3 summary" data-equalizer-watch>
				<div class="card" >
					<div class="card-divider">
						<div class="grid-x">
							<a href="#">Registered Users</a>
						</div>
					</div>
					<div class="card-section">
						<div class="grid-x">
							<div class="cell small-3">
								<i class="fa fa-users" aria-hidden="true"></i>
							</div>
							<div class="cell small-9">
								<p>Total Signups</p><h4>{{$users}}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="grid-x collapse expanded graph">
			<div class="cell small-12 medium-6 monthly-sales">
				<div class="card">
					<div class="card-section">
						<h4>Monthly Orders</h4>
						<canvas id="order"></canvas>
					</div>
				</div>
				
			</div>
			<div class="cell small-12 medium-6 monthly-revenue">
				<div class="card">
					<div class="card-section">
						<h4>Monthly Revenue</h4>
						<canvas id="revenue"></canvas>
					</div>
				</div>
				
			</div>
		</div>
	</div>

@endsection