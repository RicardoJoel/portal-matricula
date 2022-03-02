<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Process;
use App\Section;
use App\Teacher;
use Redirect;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('code', 'ASC')->paginate(1000000);
        $process = Process::where('is_closed', false)->get()->first();
        return view('sections.index', compact('sections', 'process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $processes = Process::where('is_closed', false)->get();
        if (!count($processes))
            return Redirect::back()->with('error','No puede crear secciones debido a que no hay ningún proceso de matrícula aperturado.');
        $process = $processes->first();
        return view('sections.create', compact('process'));
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
            'process_id'=>'required|numeric|min:1',
            'course_id'=>'required|numeric|min:1',
            'teacher_id'=>'required|numeric|min:1',
        ], $this->validationErrorMessages());

        $process = Process::find($request->process_id);
        if ($process === null || $process->is_closed)
            return Redirect::route('sections.index')->with('error','No se pudo crear la sección debido a que el proceso de matrícula ha sido eliminado o cerrado.');
        
        $course = Course::find($request->course_id);
        if ($course === null || $course->is_blocked)
            return Redirect::back()->with('error','No se pudo crear la sección debido a que el curso seleccionado ha sido eliminado o bloqueado.');
        
        $teacher = Teacher::find($request->teacher_id);
        if ($teacher === null || $teacher->is_blocked)
            return Redirect::back()->with('error','No se pudo crear la sección debido a que el docente seleccionado ha sido eliminado o bloqueado.');

        Section::create($request->all());
        return Redirect::route('sections.index')->with('success','Sección aperturada satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::find($id);
        $process = $section->process;
        return view('sections.edit', compact('section', 'process'));
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
            'teacher_id'=>'required|numeric|min:1',
            'is_closed'=>'required|bool',
        ], $this->validationErrorMessages());

        $teacher = Teacher::find($request->teacher_id);
        if ($teacher === null || $teacher->is_blocked)
            return Redirect::back()->with('error','No se pudo actualizar la sección debido a que el docente seleccionado ha sido eliminado o bloqueado.');

        Section::find($id)->update($request->all());
        return Redirect::route('sections.index')->with('success','Sección actualizada satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        foreach($section->enrollments as $enrollment) {
            $enrollment->delete();
        }
        $section->delete();
        return Redirect::route('sections.index')->with('success','Sección eliminada satisfactoriamente.');
    }
    
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'process_id.required' => 'Debe seleccionar obligatoriamente un proceso de matrícula.',
            'process_id.numeric' => 'El identificador del proceso de matrícula debe ser un número entero mayor a cero (0).',
            'process_id.min' => 'El identificador del proceso de matrícula debe ser un número entero mayor a cero (0).',
            'teacher_id.required' => 'Debe seleccionar obligatoriamente un docente.',
            'teacher_id.numeric' => 'El identificador del docente debe ser un número entero mayor a cero (0).',
            'teacher_id.min' => 'El identificador del docente debe ser un número entero mayor a cero (0).',
            'course_id.required' => 'Debe seleccionar obligatoriamente un curso.',
            'course_id.numeric' => 'El identificador del curso debe ser un número entero mayor a cero (0).',
            'course_id.min' => 'El identificador del curso debe ser un número entero mayor a cero (0).',
            'is_closed.required' => 'Debe seleccionar obligatoriamente un estado.',
        ];
    }
}
