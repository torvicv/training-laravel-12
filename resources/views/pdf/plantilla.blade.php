<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Plantilla de Presupuesto</title>
  <style>
    body { font-family: sans-serif; margin: 40px; }
    header { text-align: center; margin-bottom: 20px; }
    h1 { font-size: 24px; }
    .info { margin-bottom: 40px; }
    .campo { margin-bottom: 15px; }
    .campo label { display: block; font-weight: bold; margin-bottom: 5px; }
    .campo .valor { border-bottom: 1px solid #000; padding: 5px; min-height: 20px; }
    footer { position: fixed; bottom: 40px; width: 100%; text-align: center; font-size: 12px; color: #777; }
  </style>
</head>
<body>

  <header>
    <h1>Cliente Nº {{ $client->id ?? '____' }}</h1>
    <p>Fecha: {{ now()->format('d/m/Y') }}</p>
  </header>

  <section class="info">
    <p><strong>Cliente:</strong> {{ $client->name ?? '____________________' }}</p>
  </section>

  <section class="firmas">
    <div class="campo">
      <label>Nombre de quien firma</label>
      <div class="valor">{{ $signerName ?? '____________________' }}</div>
    </div>

    <div class="campo">
      <label>DNI de quien firma</label>
      <div class="valor">{{ $signerDni ?? '____________________' }}</div>
    </div>

    <div class="campo">
      <label>Firma</label>
      <div class="valor">
        @if(!empty($signatureUrl))
          <img src="{{ $signatureUrl }}" style="max-width:200px; max-height:80px;">
        @else
          ____________________
        @endif
      </div>
    </div>
  </section>

  <footer>
    Este documento es un ejemplo de plantilla.
  </footer>
</body>
</html>