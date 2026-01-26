<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>{{ $reporte->nombre }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        .meta { margin-bottom: 14px; }
        .meta p { margin: 2px 0; }
        .section { margin-top: 14px; }
        .section h2 { font-size: 14px; margin: 0 0 6px; border-bottom: 1px solid #ddd; padding-bottom: 4px; }
        .box { padding: 10px; background: #f7f7f7; border: 1px solid #e5e5e5; border-radius: 6px; }
    </style>
</head>
<body>

    <h1>Reporte: {{ $reporte->nombre }}</h1>

    <div class="meta">
        <p><strong>ID:</strong> {{ $reporte->id }}</p>
        <p><strong>Tipo:</strong> {{ $reporte->tipo }}</p>
        <p><strong>Responsable:</strong> {{ $reporte->responsable->name ?? '—' }}</p>
        <p><strong>Fecha de creación:</strong> {{ $reporte->fecha_creacion ?? '—' }}</p>
    </div>

    <div class="section">
        <h2>Antecedentes</h2>
        <div class="box">
            {!! nl2br(e($reporte->antecedentes ?? '—')) !!}
        </div>
    </div>

    <div class="section">
        <h2>Desarrollo</h2>
        <div class="box">
            {!! nl2br(e($reporte->desarrollo ?? '—')) !!}
        </div>
    </div>

    <div class="section">
        <h2>Conclusiones</h2>
        <div class="box">
            {!! nl2br(e($reporte->conclusiones ?? '—')) !!}
        </div>
    </div>

</body>
</html>
