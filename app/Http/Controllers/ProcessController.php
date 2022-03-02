<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Process;
use Redirect;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::orderByRaw('code ASC')->paginate(1000000);
        return view('processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $processes = Process::where('is_closed', false)->get();
        if (count($processes))
            return Redirect::back()->with('error','No puede aperturar un nuevo proceso de matrícula mientras haya uno ya abierto.');
        return view('processes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'start_at' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_at' => 'required|date|date_format:Y-m-d|after_or_equal:start_at',
            'code' => 'required|string|unique:processes,code,NULL,id,deleted_at,NULL|regex:/[0-9]{4}-[1-2]{1}/',
        ], $this->validationErrorMessages());

        $processes = Process::where('is_closed',false);
        if ($processes->count())
            return Redirect::route('processes.index')->with('error','No se pudo aperturar el proceso de matrícula debido a que actualmente existe uno ya abierto.');
        
        Process::create($request->all());
        return Redirect::route('processes.index')->with('success','Proceso de matrícula aperturado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $process = Process::find($id);
        return view('processes.show', compact('process'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $process = Process::find($id);
        return view('processes.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'start_at' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_at' => 'required|date|date_format:Y-m-d|after_or_equal:start_at',
            'code' => 'required|string|unique:processes,code,'.$id.',id,deleted_at,NULL|regex:/[0-9]{4}-[1-2]{1}/',
            'is_closed'=>'required|bool',
        ], $this->validationErrorMessages());

        $processes = Process::where('is_closed',false)->where('id','!=',$id);
        if ($processes->count())
            return Redirect::back()->with('error','No se pudo actualizar el proceso de matrícula pues actualmente existe otro abierto.');
        
        $process->update($request->all());
        foreach($process->sections as $section) {
            $section->is_closed = $process->is_closed;
            $section->save();
        }
        return Redirect::route('processes.index')->with('success','Proceso de matrícula actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = Process::find($id);
        foreach($process->sections as $section) {
            foreach($section->enrollments as $enrollment) {
                $enrollment->delete();
            }
            $section->delete();
        }
        $process->delete();
        return Redirect::route('processes.index')->with('success','Proceso de matrícula eliminado satisfactoriamente.');
    }
        
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'start_at.required' => 'Debe ingresar obligatoriamente una fecha inicio.',
            'start_at.date_format' => 'El formato de fecha inicio debe ser dd/mm/aaaa',
            'start_at.after_or_equal' => 'La fecha inicio no puede ser anterior a la fecha actual.',
            'end_at.required' => 'Debe ingresar obligatoriamente una fecha fin.',
            'end_at.date_format' => 'El formato de fecha fin debe ser dd/mm/aaaa',
            'end_at.after_or_equal' => 'La fecha fin no puede ser anterior a la fecha inicio.',
            'code.required' => 'Debe seleccionar obligatoriamente un semestre.',
            'code.unique' => 'El semestre seleccionado ya ha sido tomado.',
            'code.regex' => 'El semestre debe estar formado por el año seguido de un guión y, finalmente, el semestre en curso.',
            'is_blocked.required' => 'Debe seleccionar obligatoriamente un estado.',
        ];
    }
}
