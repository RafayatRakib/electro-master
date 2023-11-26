<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Confirmation</title>
    <style>
        /* Basic CSS styles for email content */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Delivery Confirmation</h1>
        <p>Dear Customer,</p>
        <p>Your order with ID  <strong>{{$order->order_number}}</strong> has been delivered successfully!</p>
        <!-- Additional delivery details or personalized message can go here -->
        <p> Plese rate oure product by <a href="">Here</a>. If you want to see the order details please <a href="{{route('order_details',encrypt($order->id))}}">Click</a> here and see the details.</p>

        <p>Thank you for choosing our services.</p>
        <div class="footer">
            <p>This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>
</html>
