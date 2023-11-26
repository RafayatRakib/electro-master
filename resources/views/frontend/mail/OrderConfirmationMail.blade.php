<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation</title>
  <style>
    body, html, p {
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #ff1100;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }

    .header h1 {
      font-size: 24px;
      margin: 0;
    }

    .order-details {
      padding: 20px;
    }

    .order-details p {
      font-size: 16px;
      line-height: 1.6;
    }

    .order-total {
      background-color: #f4f4f4;
      padding: 20px;
      text-align: right;
    }

    .order-total p {
      font-size: 18px;
      font-weight: bold;
    }

    .footer {
      background-color: rgb(184, 33, 33);
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }

    .footer a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h1>Order Confirmation</h1>
    </div>
    <div class="order-details">
      <p><strong>User name:</strong> {{ $maildata['customerName'] }}</p>
      <p><strong>Order Number:</strong>{{ $maildata['orderNumber'] }}</p>
      <p><strong>Order Date:</strong> {{ $maildata['orderDate'] }} </p>
      <p><strong>Shipping Address:</strong> {{ $maildata['address'] }}</p>
      <p><strong>Payment Method:</strong> {{ strtoupper($maildata['payment']) }} </p>
    </div>
    <div class="order-total">
      <p><strong>Order Total:</strong> {!! $maildata['currency'] !!} {{ number_format($maildata['totalAmount'], 2, '.', ',') }}</p>
    </div>
    <div class="footer">
      <p>Thank you for your order. If you have any questions, please contact our <a href="#">customer support</a>.</p>
    </div>
  </div>

</body>
</html>
