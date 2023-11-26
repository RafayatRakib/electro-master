@extends('frontend.master')
@section('title','Return product')
@section('content')

<div class="container">

    @if (session()->get('success'))
        <div style="margin-bottom: 40px">
        <div class="alert alert-success" style="width: 60%; margin: auto; text-align: center">
            <p style="margin: auto">{{session()->get('success')}}</p>
        </div>
        </div>
    @endif

    <div>
        <p>We want you to be completely satisfied with your purchase. If you're not happy with your order for any reason, we'll gladly accept returns within [number of days] days of the purchase date. Please note the following guidelines:

            Eligibility Criteria for Returns
            Unused Condition: Returned items must be unused, unworn, and in the same condition as received.
            Original Packaging: Products should be returned in their original packaging with all tags attached.
            Non-Returnable Items
            The following items are non-returnable:
            
            Personalized Items: Products that have been customized or personalized cannot be returned unless there’s a manufacturing defect.
            Perishable Goods: Items that can perish or deteriorate over time.
            Return Process
            To initiate a return:
            
            Contact Us: Please contact our customer support team at [customer support email or phone number] to request a return and provide the order details.
            Return Authorization: Once authorized, you will receive a return authorization along with instructions on how to proceed.
            Refunds
            Refund Processing: Upon receiving the returned item, we'll inspect it and process the refund within [number of days] days. Refunds will be issued to the original payment method.
            Shipping Costs: Please note that shipping costs are non-refundable. Return shipping fees may apply and will be deducted from the refund amount.
            Exchanges
            We do not offer direct exchanges. If you need a different size, color, or item, please initiate a return and place a new order.
            
            Damaged or Defective Items
            In case of receiving damaged or defective items, please contact us immediately for assistance. We'll arrange a replacement or issue a refund as needed.
            
            Contact Information
            For any questions about our return policy or assistance with a return, please contact our customer support team at [customer support email or phone number].</p>
    </div>
    <div class="row">

        <div class="col-md-6">
            <img width="250px" src="{{asset($product->product_photo)}}" alt="" srcset="">
            <h4 style="margin-top: 40px"><a href="{{url('/product/details/'.$product->id.'/'.$product->product_slug)}}">{{$product->product_name}}</a></h4>
         </div>


        <div class="col-md-6">
            <h2>Select a Return Reason</h2>
            <form action="/submit-return" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="returnReason">Reason for Return:</label>
                    <select id="returnReason" name="returnReason" class="form-control">
                        <option value="" selected disabled>Select a reason</option>
                       @foreach ($returnReson as $item)
                       <option value="{{$item->id}}"> {{$item->return_reson}} </option>
                       @endforeach
                    </select>
               @error('returnReason') <strong class="text-danger">{{$message}}</strong> @enderror 

                </div>
                <div class="form-group">
                    <label for="additionalComments">Comments:</label>
                    <textarea id="additionalComments" name="comments" rows="4" max-rows="4" class="form-control"></textarea>
                    @error('comments') <strong class="text-danger">{{$message}}</strong> @enderror 
                   
                    <label style="margin-top:10px" for="additionalComments">Photo of product:</label>
                    <input class="form-control"  type="file" multiple name="return_images[]" placeholder="Optional">
                    @error('return_images') <strong class="text-danger">{{$message}}</strong> @enderror 
                    <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>

        </div>
    </div>





</div>
@section('script')

<script>
   $(document).ready(function() {
      $('.delete-review').on('click', function(e) {
         e.preventDefault(); // Prevent the default action of following the link
         
         var deleteUrl = $(this).attr('href');
         
         if (confirm('Are you sure to delete it?')) {
            // User confirmed deletion, proceed to the delete URL
                window.location.href = deleteUrl;
               } else {
                  // User canceled deletion, do nothing
               }
            });
         });
      </script>
@endsection


@endsection