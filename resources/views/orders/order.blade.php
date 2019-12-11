@extends('layouts.base')

@section('title', 'Order Summary')

@section('pageid', 'cart')

@section('content')

  <div class="order-summary" id="cart">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <h1>Order#{{$order->orderNumber}}</h1>

        <div class="shopping-cart">

          <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
          </div>

          @foreach($order->products as $product)
            <div class="product">
              <div class="product-image">
                <img src="/{{$product->image_path}}" width="100" height="100">
              </div>
              <div class="product-details">
                <div class="product-title"><a href="/product/{{$product->id}}">{{$product->name}}</a></div>
                <div class="product-description">{{(strlen($product->description) > 110) ? substr($product->description,0,110) . '...' : $product->description}}</div>
              </div>
              <div class="product-price">{{$product->price}}</div>
              <div class="product-quantity">{{$product->quantity}}
              </div>

              <div class="product-line-price">{{($product->price) * ($product->quantity) }}</div>
            </div>
          @endforeach  
            <div class="totals">
              <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">{{$order->subTotal}}</div>
              </div>
              <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax">{{$order->tax}}</div>
              </div>
              <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">{{$order->shipping}}</div>
              </div>
              <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">{{$order->amount}}</div>
              </div>
            </div>
            <div class="text-right">
              <a href="/" class="button alert">Get Invoice</a>
            </div>                     
        </div>
      </div>
    </div>
  </div>

@endsection
