<?php

namespace App\Http\Controllers;

use App\Models\Client;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\PdfReader;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;

class ClientController extends Controller
{
    // Muestra el formulario con el PDF embebido
    public function form(Client $client)
    {
        return inertia('Client/Form', [
            'pdfUrl'     => route('pdf.plantilla', $client->id),
            'submitRoute'=> route('pdf.firmar', $client->id),
            'redirectUrl'=> session('redirectUrl') ?? null,
        ]);
    }

    // Procesa firma e incrusta en el PDF
    public function firmar(Request $request, Client $client)
    {
        $data = $request->validate([
            'signerName' => 'required|string',
            'signerDni'  => 'required|string',
            'signature'  => 'required|image|max:22048',
        ]);

        // 1) Guarda la imagen de firma temporalmente
        $imgPath = $request->file('signature')
            ->store("firmas", 'public');

        // 2) Define rutas
        $templatePath = storage_path("app/public/plantillas/{$client->id}.pdf");

    // Si no existe el archivo de plantilla, crearlo
    if (!file_exists($templatePath)) {
        // Crea un PDF básico con una página en blanco (como plantilla)
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        // Agrega algunos textos para simular una plantilla vacía (ajusta esto según tu plantilla real)
        $pdf->SetXY(50, 200);
        $pdf->Write(0, "Nombre de firma: ____________");

        $pdf->SetXY(50, 210);
        $pdf->Write(0, "DNI de firma: ____________");

        // Guarda la plantilla vacía
        $pdf->Output($templatePath, 'F');
    }

    // Ruta del archivo PDF firmado
    $outputPath = storage_path("app/public/firmados/{$client->id}-firmado.pdf");

    // 3) Carga FPDI para importar la plantilla
    $pdf = new Fpdi();
    $pageCount = $pdf->setSourceFile($templatePath);

    // 4) Importa cada página y agrega datos
    for ($i = 1; $i <= $pageCount; $i++) {
        $tplId = $pdf->importPage($i);
        $pdf->AddPage();
        $pdf->useTemplate($tplId);

        // Sólo en la primera página incrustamos los datos
        if ($i === 1) {
            $pdf->SetXY(0, 0);
            // Texto
            $pdf->SetFont('Helvetica', '', 12);
            $pdf->SetTextColor(0, 0, 0);

            // Nombre
            $pdf->SetXY(50, 200);
            $pdf->Write(0, $data['signerName']);

            // DNI
            $pdf->SetXY(50, 210);
            $pdf->Write(0, $data['signerDni']);

            // Firma (40mm de ancho)
            $signaturePath = storage_path("app/public/{$imgPath}"); // Ruta completa de la firma
            // dd($signaturePath);
            $pdf->Image($signaturePath, 50, 220, 40);
        }
    }

    // 5) Guarda el PDF firmado
    $pdf->Output($outputPath, 'F');

    if (!file_exists($outputPath)) {
        dd('El archivo no existe en:', $outputPath);
    }

    Storage::disk('public')->download("firmados/{$client->id}-firmado.pdf");

    return back()->with('redirectUrl', route('pdf.download', $client->id));
    }

    public function generarPlantilla($clientId)
{
    $client = Client::findOrFail($clientId);
    $presupuesto = $client->presupuesto; // ajusta esto según la relación

    $pdf = Pdf::loadView('pdf.plantilla', [
        'presupuesto'  => $presupuesto,
        'cliente'      => $client,
        'signerName'   => null,
        'signerDni'    => null,
        'signatureUrl' => null,
    ])->setPaper('a4');

    return $pdf->stream("presupuesto_{$clientId}.pdf");
}

public function descargar(Client $client)
{
    $path = "storage/firmados/{$client->id}-firmado.pdf";

    //if (file_exists($path)) {
    //    abort(404, 'Archivo no encontrado');
    //}

    return response()->download($path);
}
}
