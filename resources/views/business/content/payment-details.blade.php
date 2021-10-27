@extends('visitor.layout.mainlayout')
@section('title', 'Payment Details')
@section('content')
<section class="owner-profie-sec">
    <div class="container-fluid p-0">
    <div class="row two-col-row">
    <div class="col store-menu-col p-0">
       <div class="left-store-menu">
          <h2 class="owner-name">{{Str::title("Hello ".Auth::user()->fname." ".Auth::user()->lname."!")}}</h2>
          <ul>
             <li><a href="{{route('business-profile')}}">My Profile</a></li>
             <li><a href="{{route('get-products')}}">My Products</a></li>
             <li><a href="{{route('get-business-orders')}}">Updated Donators <span class="notification-icon"><i class="fas fa-bell"></i></span></a></li>
             <li><a href="{{route('business-payment')}}" class="active">Payment Detail</a></li>
          </ul>
       </div>
    </div>
    <div class="col-md-9 store-content-col">
       <div class="store-content-wrap">
          <div class="top-heading">
             <h2>Payment Detail</h2>
              {{-- <div class="site-btn-4 btn-common">
                 <a href="#"> Add Payment Method</a>
              </div> --}}
          </div>
          <div class="payment_card">
             <div class="row">
                 <div class="col-md-6">
                     <div class="payment_method_add">
                         <div class="form-floating mb-3">
                             <input type="text" class="form-control" id="floatingInput" placeholder="Card Holder Name">
                             <label for="CardHolderName">Card Holder Name</label>
                         </div>
                         <div class="form-floating mb-3">
                             <input type="text" class="form-control" id="CardNumber" placeholder="Card Number">
                             <label for="CardNumber">Card Number</label>
                         </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-floating mb-3">
                                     <input type="text" class="form-control" id="MM/YY" placeholder="MM/YY">
                                     <label for="MM/YY">MM/YY</label>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <div class="form-floating mb-3">
                                     <input type="text" class="form-control" id="CVV" placeholder="CVV">
                                     <label for="CVV">CVV</label>
                                 </div>
                             </div>
                         </div>
                         <div class="site-btn-4 btn-common">
                               <a href="#">Add Card</a>
                           </div>
                     </div>
                 </div>
             </div>
          </div>
       </div>
    </div>
 </section>
@endsection
