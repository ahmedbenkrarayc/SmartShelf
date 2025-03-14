<!DOCTYPE html>
<html>
<head>
    <title>⚠️ Low Stock Alert</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px; }
        .container { max-width: 600px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .header { background-color: #ef4444; color: white; padding: 15px; text-align: center; font-size: 20px; font-weight: bold; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; text-align: center; }
        .product-name { font-size: 24px; font-weight: bold; color: #1e293b; }
        .stock-warning { font-size: 18px; color: #ef4444; font-weight: bold; }
        .footer { margin-top: 20px; text-align: center; font-size: 14px; color: #64748b; }
        .btn { background-color: #3b82f6; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn:hover { background-color: #2563eb; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">⚠️ Low Stock Alert</div>
        <div class="content">
            <p class="product-name">{{ $product->name }}</p>
            <p class="stock-warning">Stock is critically low: {{ $product->stock }} left!</p>
        </div>
        <div class="footer">
            This is an automated email. Please do not reply.
        </div>
    </div>
</body>
</html>
