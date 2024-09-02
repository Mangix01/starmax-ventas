<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadosControlador extends Controller
{
	public function index(){
		$empleados = Empleado::get();
		// dd($empleados);
		return view('empleados.index', compact('empleados'));
	}

	public function store(Request $request){
		// $empleado = new Empleado;
		// $empleado->nombre = $request->nombre;
		// $empleado->email = $request->email;
		// $empleado->save();

		// Validar los datos del request
	    $request->validate([
	        'nombre' => 'required|string|max:255',
	        'email' => 'required|email|max:255',
	    ]);

		Empleado::create([
		    'nombre' => $request->nombre,
		    'email' => $request->email,
		]);

		return redirect()->to('empleados');
	}

	public function update(Request $request, $id){
		// $empleado = Empleado::findOrFail($id);
		// $empleado->nombre = $request->nombre;
		// $empleado->email = $request->email;
		// $empleado->update();

		// Validar los datos del request
	    $request->validate([
	        'nombre' => 'required|string|max:255',
	        'email' => 'required|email|max:255',
	    ]);

		Empleado::where('id', $id)->update([
		    'nombre' => $request->nombre,
		    'email' => $request->email,
		]);

		return redirect()->to('empleados');
	}

	public function destroy( $id){
		$empleado = Empleado::findOrFail($id);
		$empleado->delete();

		return redirect()->to('empleados');
	}
}