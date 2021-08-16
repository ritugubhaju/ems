<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Exam\ExamRequest;
use App\Models\Exam\Exam;
use App\Modules\Service\Exam\ExamService;
use Illuminate\Support\Str;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $exam;

    function __construct(Exam $exam)
    {
        $this->exam = $exam;
    }
    public function index()
    {
        $exam = $this->exam->paginate();

        return view('backend.exam.index', compact('exam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
       // dd($request->all());
        if($exam = $this->exam->create($request->data())) {
           
            return redirect()->route('exam.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
      
        return view('backend.exam.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
       
        if ($exam->update($request->data())) {
            $exam->fill([
                'slug' => $request->title,
            ])->save();
            
        }
        return redirect()->route('exam.index')->withSuccess(trans('exam has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = $this->exam->find($id);
        $exam->delete();
        return redirect()->route('exam.index')->withSuccess(trans('exam has been deleted'));
    }   

   
}
