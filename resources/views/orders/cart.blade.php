@extends('layouts.base')

@section('title', 'Order Summary')

@section('pageid', 'cart')

@section('content')

  <div class="order-summary" id="cart">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <h1>Shopping Cart</h1>

        <div class="shopping-cart">

          <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
          </div>

          @if(count($products) == 0)
            <h3 class="text-center">Your Shopping Cart is Empty</h3>
          @endif

          @foreach($products as $product)
            <div class="product">
              <div class="product-image">
                <img src="/{{$product->image_path}}" width="100" height="100">
              </div>
              <div class="product-details">
                <div class="product-title"><a href="/product/{{$product->id}}">{{$product->name}}</a></div>
                <div class="product-description">{{(strlen($product->description) > 110) ? substr($product->description,0,110) . '...' : $product->description}}</div>
                @if($product->stock > 0)
                  <div class="product-description" style="color: green;">In Stock</div>
                @else
                  <div class="product-description" style="color: red;">Out of Stock</div>
                @endif
              </div>
              <div class="product-price">{{$product->price}}</div>
              <div class="product-quantity">
                <input type="number" value="{{$product->quantity}}" min="1" max="{{$product->stock}}" data-token="{{App\Classes\CSRFHandler::getToken()}}" data-id="{{$product->id}}">
              </div>
              <div class="product-removal">
                <button class="remove-product" data-token="{{App\Classes\CSRFHandler::getToken()}}" data-id="{{$product->id}}">
                  Remove
                </button>
              </div>
              <div class="product-line-price">{{($product->price) * ($product->quantity) }}</div>
            </div>
          @endforeach  
          @if(count($products) > 0)
            <div class="totals">
              <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal">{{Cart()->getSubTotal()}}</div>
              </div>
              <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax">{{Cart()->getTax()}}</div>
              </div>
              <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">15.00</div>
              </div>
              <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">{{Cart()->getFormattedAmount()}}</div>
              </div>
            </div>
            <div class="text-right">
              <a href="/" class="button secondary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Continue Shopping</a>
              @if(isAuthenticated())
                <a href="/cart/payment" class="button success"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Checkout</a>
              @else
                <a href="/login" class="button success"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Checkout</a>
              @endif
            </div>                     
          @endif
        </div>
      </div>
    </div>
  </div>

@endsection
