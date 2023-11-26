<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add some basic styling to your email */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #0070c9;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .content {
            background: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registration Confirmation</h1>
        </div>
        <div class="content">
            {{-- <p>Hello {{$maildata['name']}},</p>
            <p>{!!$maildata['body']!!}</p> --}}
        </div>
    </div>
</body>
</html>
