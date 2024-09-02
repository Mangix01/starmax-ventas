<?php
namespace App\Helpers;

use App\Models\Auditori;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function guardarLog($operacion, $notas)
    {
        // dd('grabando logs...');
        // try {
            $logs_segurida = new Auditori;
            $logs_segurida->usuario = Auth::user()->name;
            $logs_segurida->operacion = $operacion;
            $logs_segurida->notas = $notas;
            $logs_segurida->save();
        // } catch (\Exception $e) {
        //     // Manejar el error si es necesario
        //      toastr()->error(__('La grabación del Log NO ha sido exitosa...'));
        // }
    }
}