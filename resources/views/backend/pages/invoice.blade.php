<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #6</title>
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #000000;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>
  <div class="invoice overflow-auto">
    <div style="min-width: 600px">
        {{-- <header>
            <div class="row d-flex justify-content-space-between">
                <div class="col-md-8 col-xl-8">
                    <a href="javascript:;">
                        <svg width="50" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <!-- Your SVG Logo Path Here -->
                        </svg>
                    </a>
                </div>
                <div class="col-md-4 company-details">
                    <h2 class="name">
                        <a target="_blank" href="javascript:;">Sneat</a>
                    </h2>
                    <div>455 Foggy Heights, AZ 85004, US</div>
                    <div>(123) 456-789</div>
                    <div>company@example.com</div>
                </div>
            </div>
        </header>
        <main>
            <div class="row contacts d-flex justify-content-between">
                <div class="col-md-8 invoice-to">
                    <div class="text-gray-light">INVOICE TO:</div>
                    <h2 class="to">John Doe</h2>
                    <div class="address">796 Silver Harbour, TX 79273, US</div>
                    <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                </div>
                <div class="col-md-4 invoice-details">
                    <h1 class="invoice-id">INVOICE 3-2-1</h1>
                    <div class="date">Date of Invoice: 01/10/2018</div>
                    <div class="date">Due Date: 30/10/2018</div>
                </div>
            </div>
        </main> --}}


        <table class="order-details">
          <thead>
              <tr>

                  <th width="100%" colspan="2" class="text-end company-data">
                    <h2 class="text-start">Electro</h2>

                      <div >INVOICE TO: Jone Doe</div>
                      <div class="address">{{$order->adress }},
                        {{$order->upazila->upazila_name }}, 
                        {{$order->district->district_name }} </div>
                      <div class="email">{{$order->email}}</div>
                      <div class="phone">{{$order->phone}}</div>
                      <h4 class="invoice-id">Invoice No: {{$order->invoice_no}}</h4>
                      <div class="date">Date of Invoice: {{Illuminate\Support\Carbon::now()->format('d/M/Y - H : m')}}</div>
                      <div class="date">Order Date Date: {{Illuminate\Support\Carbon::parse($order->order_date)->format('h:i A')}}</div>
                    </th>
              </tr>

          </thead>

      </table>


        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <!-- Loop through your order items and display them here -->
                    <!-- Example: -->
                    @foreach ($order_item as $key => $item)
                    <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$item->product->product_name}}</td>
                       <td><strong>${{ $item->price }}</strong></td>
                       <td><strong>{{$item->qty}}</strong></td>
                       <td><strong>${{$item->price * $item->qty}}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                  <tr>
                     <td colspan="2"></td>
                     <td colspan="2">SUBTOTAL</td>
                     <td>${{$order->total_amount}}</td>
                  </tr>
                  <tr>
                     <td colspan="2"></td>
                     <td colspan="2">Delivery Charge</td>
                     <td>$ {{$order->district->delivery_charge}} </td>
                  </tr>
                  @if ($order->total_discount)
                  <tr>
                     <td colspan="2"></td>
                     <td colspan="2">Total Discount</td>
                     <td>${{$order->total_discount}}</td>
                  </tr>
                  @endif
                  <tr>
                     <td colspan="2"></td>
                     <td colspan="2">GRAND TOTAL</td>
                     <td>$ {{$order->total_amount+$order->district->delivery_charge}} </td>
                  </tr>
               </tfoot>
            </table>
            <div class="table-border-bottom-0"></div>
        </div>
    </div>
</div>
<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
</body>
</html>