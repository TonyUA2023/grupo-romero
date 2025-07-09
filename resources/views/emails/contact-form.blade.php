<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
        .content { padding: 30px; background-color: #fff; border: 1px solid #dee2e6; }
        .footer { text-align: center; padding: 20px; color: #6c757d; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>GRC Clínica Optométrica</h2>
            <h3>Nuevo mensaje de contacto</h3>
        </div>
        
        <div class="content">
            <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
            
            @if($data['service'])
            <p><strong>Servicio de interés:</strong> {{ $data['service'] }}</p>
            @endif
            
            <p><strong>Mensaje:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
        
        <div class="footer">
            <p>Este mensaje fue enviado desde el formulario de contacto del sitio web.</p>
        </div>
    </div>
</body>
</html>