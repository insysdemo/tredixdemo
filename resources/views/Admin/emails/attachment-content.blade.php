<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
</head>
<body>
    <h1>Customer Report</h1>
    <p>Dear {{ $Product->customer->name }},</p>
    <p>Thank you for being a valuable customer. Here is your report:</p>

    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-top: 20px;">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $Product->product_code }}</td> 
                <td>{{ $Product->name }}</td> 
                <td>{{ $Product->description }}</td> 
                <td>${{ number_format($Product->price, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p>We appreciate your business!</p>
</body>
</html>
