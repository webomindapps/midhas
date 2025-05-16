 <div class=" mini-cart-content-inner"id="hovercartItems">
     @if ($cart && $cart->items->count())
         <div class="d-flex bag_title align-items-center justify-content-between">
             <a href="{{ route('cart') }}" class="fw-bold text-uppercase mc_title">
                 Bag Summary (<span>{{ $count = $cart ? $cart->items()->count() : 0 }}</span>)
             </a>
             <a href="{{ route('cart') }}" class="fw-bold text-uppercase mc_btn d-md-none d-block">
                 View Full Bag
             </a>
         </div>

         <div class="bag_wrapper">
             @foreach ($cart->items as $item)
                 <div class="bag_items">
                     <div class="bag_prd_img">
                         <img src="{{ asset($item->product->thumbnail) }}" alt="{{ $item->name }}" class="img-fluid">
                     </div>
                     <div class="bag_prd_info text-start">
                         <div class="bag_prd_info_title">
                             <a href="" class="d-inline-block pb-1">
                                 {{ $item->name }}
                             </a>
                             <p class="bag_prd_info_price mb-1">
                                 <b>${{ number_format($item->price, 2) }}</b>
                             </p>
                             <small class="bag_prd_info_qty">Qty: {{ $item->quantity }}</small>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>

         <div class="d-flex bag_total py-3 align-items-center justify-content-between">
             <p class="fw-bold text-uppercase mc_title mb-0">Total</p>
             <p class="fw-bold text-uppercase mc_title mb-0">
                 ${{ number_format($cart->grand_total, 2) }}
             </p>
         </div>

         <a href="" class="theme_btn text-uppercase d-block text-white">CheckOut</a>
     @else
         <p class="text-center p-3">Your bag is empty.</p>
     @endif
 </div>
