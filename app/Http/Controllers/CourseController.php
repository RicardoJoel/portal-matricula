<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Redirect;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderByRaw('name ASC')->paginate(1000000);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
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
            'name' => 'required|string|max:50|regex:/(^([A-Za-z0-9 ÑñáéíóúÜü,.:;¡!¿?\'"()<>_\-+\/*=#$%&°{}]+)?$)/',
            'code' => 'required|string|unique:courses,code,NULL,id,deleted_at,NULL|regex:/[A-Z]{3}[0-9]{3}/',
            'hours' => 'required|numeric|min:1|max:100',
        ], $this->validationErrorMessages());
        Course::create($request->all());
        return Redirect::route('courses.index')->with('success','Curso creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit', compact('course'));
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
            'name' => 'required|string|max:50|regex:/(^([A-Za-z0-9 ÑñáéíóúÜü,.:;¡!¿?\'"()<>_\-+\/*=#$%&°{}]+)?$)/',
            'code' => 'required|string|unique:courses,code,'.$id.',id,deleted_at,NULL|regex:/[A-Z]{3}[0-9]{3}/',
            'hours' => 'required|numeric|min:1|max:100',
            'is_blocked' => 'required|bool',
        ], $this->validationErrorMessages());
        $course = Course::find($id);
        $course->update($request->all());
        foreach($course->sections as $section) {
            $section->is_closed = $course->is_blocked;
            $section->save();
        }
        return Redirect::route('courses.index')->with('success','Curso actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        foreach($course->sections as $section) {
            foreach($section->enrollments as $enrollment) {
                $enrollment->delete();
            }
            $section->delete();
        }
        $course->delete();
        return Redirect::route('courses.index')->with('success','Curso eliminado satisfactoriamente.');
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
            'name.regex' => 'El nombre debe contener entre uno (1) y cincuenta (50) caracteres, incluyendo letras, dígitos, espacios en blanco y signos de puntuación.',
            'name.max' => 'El nombre debe contener entre uno (1) y cincuenta (50) caracteres, incluyendo letras, dígitos, espacios en blanco y signos de puntuación.',
            'code.required' => 'Debe ingresar obligatoriamente un código.',
            'code.unique' => 'El código ingresado ya existe en el sistema.',
            'code.regex' => 'El código debe estar compuesto por tres (3) letras seguidas de tres (3) dígitos.',
            'hours.required' => 'Debe ingresar obligatoriamente las horas de dictado.',
            'hours.numeric' => 'Las horas de dictado debe ser un número entero entre uno (1) y cien (100).',
            'hours.min' => 'Las horas de dictado debe ser un número entero entre uno (1) y cien (100).',
            'hours.max' => 'Las horas de dictado debe ser un número entero entre uno (1) y cien (100).',
            'is_blocked.required' => 'Debe seleccionar obligatoriamente un estado.',
        ];
    }
}
