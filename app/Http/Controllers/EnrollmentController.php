<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Enrollment;
use App\Process;
use App\Student;
use App\Section;
use Redirect;
use DB;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::where('is_closed', false)->get();
        if (!count($processes))
            return Redirect::back()->with('error','Actualmente no hay ningún proceso de matrícula aperturado.');
        
        $process = $processes->first();
        $students = Student::orderByRaw('name ASC', 'lastname ASC')->paginate(1000000);
        return view('enrollments.index', compact('students', 'process'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('errors.404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('errors.404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $processes = Process::where('is_closed', false)->get();
        if (!count($processes))
            return Redirect::back()->with('error','Actualmente no hay ningún proceso de matrícula aperturado.');

        $student = Student::find($id);
        if ($student->is_blocked)
            return Redirect::back()->with('error','El alumno seleccionado se encuentra bloqueado en el sistema.');
            
        $process = $processes->first();
        $enrollments = Enrollment::leftJoin('sections','sections.id','enrollments.section_id')
            ->leftJoin('processes','processes.id','sections.process_id')
            ->where('process_id',$process->id)
            ->where('student_id',$student->id)
            ->orderBy('enrollments.created_at','ASC')
            ->get('enrollments.*');
        return view('enrollments.edit', compact('student', 'process', 'enrollments'));
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
            'section_id'=>'required|numeric|min:1',
        ]);
        
        $section = Section::find($request->section_id);
        if ($section->quantity > 9)
            return Redirect::back()->with('error','La sección seleccionada ya no tiene vacantes disponibles.');
        
        $enrollments = Enrollment::leftJoin('sections','sections.id','enrollments.section_id')
            ->leftJoin('processes','processes.id','sections.process_id')
            ->where('process_id',$section->process->id)
            ->where('student_id',$id)
            ->get();
        if (count($enrollments) > 7)
            return Redirect::back()->with('error','No se pudo inscribir al alumno debido a que ya que se encuentra inscrito en ocho (8) cursos.');                        

        $enrollments = Enrollment::leftJoin('sections','sections.id','enrollments.section_id')
                             ->leftJoin('processes','processes.id','sections.process_id')
                             ->leftJoin('courses','courses.id','sections.course_id')
                             ->where('process_id',$section->process->id)
                             ->where('student_id',$id)
                             ->where('course_id',$section->course->id)
                             ->get();
        if (count($enrollments) > 0)
            return Redirect::back()->with('error','No se pudo inscribir al alumno debido a que ya que se encuentra inscrito en el curso.');                        
            
        Enrollment::create([
            'user_id' => Auth::user()->id,
            'section_id' => $request->section_id,
            'student_id' => $id,
        ]);
        $section->quantity = $section->quantity + 1;
        $section->save();
        return Redirect::back()->with('success','Inscripción realizada satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);
        $enrollment->delete();
        $section = Section::find($enrollment->section_id);
        $section->quantity = $section->quantity - 1;
        $section->save();
        return Redirect::back()->with('success','Alumno retirado satisfactoriamente.');
    }

    public function report()
    {
        $process_id = '';
        $section_id = '';
        $teacher_id = '';
        $course_id = '';
        $items = collect([]);

        return view('enrollments.report', compact('items', 'process_id', 'course_id', 'section_id', 'teacher_id'));
    }

    public function generate(Request $request)
    {
        $process_id = $request->process_id;
        $section_id = $request->section_id;
        $teacher_id = $request->teacher_id;
        $course_id = $request->course_id;

        $items = Enrollment::select([
            'processes.code as process',
            'courses.name as course', 
            'sections.code as section',
            DB::raw('concat(teachers.lastname,", ",teachers.name) as teacher'), 
            DB::raw('count(enrollments.id) as quantity')
        ])
            ->leftJoin('sections','sections.id','enrollments.section_id')
            ->leftJoin('processes','processes.id','sections.process_id')
            ->leftJoin('teachers','teachers.id','sections.teacher_id')
            ->leftJoin('courses','courses.id','sections.course_id')
            ->where(function ($query) use ($process_id) {
                if ($process_id !== null)
                    $query->where('process_id',$process_id);
                return $query;
            })
            ->where(function ($query) use ($course_id) {
                if ($course_id !== null)
                    $query->where('course_id',$course_id);
                return $query;
            })
            ->where(function ($query) use ($section_id) {
                if ($section_id !== null)
                    $query->where('section_id',$section_id);
                return $query;
            })
            ->where(function ($query) use ($teacher_id) {
                if ($teacher_id !== null)
                    $query->where('teacher_id',$teacher_id);
                return $query;
            })
            ->groupBy([
                'processes.code', 
                'courses.name',
                'sections.code', 
                DB::raw('concat(teachers.lastname,", ",teachers.name)')
            ])
            ->orderByRaw(
                'processes.code ASC', 
                'courses.name ASC',
                'sections.code ASC', 
                DB::raw('concat(teachers.lastname,", ",teachers.name ASC)')
            )
            ->get();
        
        return view('enrollments.report', compact('items', 'process_id', 'course_id', 'section_id', 'teacher_id'));
    }
}
