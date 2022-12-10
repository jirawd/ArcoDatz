{{-- <!-- //views/shop/shopping-cart -->
<a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
 <!-- //shoppingcart view -->
<li><a href="{{ route('product.reduceByOne',['id'=>$product['item']['item_id']]) }}">Reduce By 1</a></li>
<li><a href="{{ route('product.remove',['id'=>$product['item']['id']]) }}">Reduce All</a></li> --}}