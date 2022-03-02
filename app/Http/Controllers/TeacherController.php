<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Redirect;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderByRaw('name ASC', 'lastname ASC')->paginate(1000000);
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
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
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'document' => 'required|string|unique:teachers,document,NULL,id,deleted_at,NULL|regex:/[0-9]{8}/',
        ], $this->validationErrorMessages());
        Teacher::create($request->all());
        return Redirect::route('teachers.index')->with('success','Docente creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('teachers.edit', compact('teacher'));
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
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'document' => 'required|string|unique:teachers,document,'.$id.',id,deleted_at,NULL|regex:/[0-9]{8}/',
            'is_blocked'=>'required|bool',
        ], $this->validationErrorMessages());
        Teacher::find($id)->update($request->all());
        return Redirect::route('teachers.index')->with('success','Docente actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::find($id)->delete();
        return Redirect::route('teachers.index')->with('success','Docente eliminado satisfactoriamente.');
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'name.required' => 'Debe ingresar obligatoriamente un nombre.',
            'name.regex' => 'El nombre debe contener entre uno (1) y cincuenta (50) caracteres, incluyendo letras y espacios en blanco entre palabras.',
            'name.max' => 'El nombre debe contener entre uno (1) y cincuenta (50) caracteres.',
            'lastname.required' => 'Debe ingresar obligatoriamente un apellido.',
            'lastname.regex' => 'El apellido debe contener entre uno (1) y cincuenta (50) caracteres, incluyendo letras y espacios en blanco entre palabras.',
            'lastname.max' => 'El apellido debe contener entre uno (1) y cincuenta (50) caracteres.',
            'document.required' => 'Debe ingresar obligatoriamente un DNI.',
            'document.unique' => 'El DNI ingresado ya existe en el sistema.',
            'document.regex' => 'El DNI debe debe estar compuesto por ocho (8) dígitos.',
            'is_blocked.required' => 'Debe seleccionar obligatoriamente un estado.',
        ];
    }
}
