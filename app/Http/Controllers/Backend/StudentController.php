<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentRequest;
use App\Modules\Service\Student\StudentService;
use App\Models\Student\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    protected $student;

    function __construct(StudentService $student , User $user)
    {
        $this->student = $student;
        $this->user = $user;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.student.form');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function getAllData()
    {
        // dd($this->student);
        return $this->student->getAllData();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
       // dd($request->all());
        $inputs=[
            'name' => $request->get('name'),
            'email'   => $request->get('email'),
            'password'   => Hash::make($request->get('password')),

        ];
        if($student = $this->user->create($inputs)) {
            $studentData = [];
            $studentData['user_id'] = $student->id;
            $studentData['class'] = $request->class;
            $studentData['gender'] = $request->gender;
            $studentData['phone'] = $request->phone;
            $studentData['parent_name'] = $request->parent_name;
            $studentData['parent_num'] = $request->parent_num;
            $data['row'] = Student::create($studentData);
            if($request->hasFile('image')) {
                $this->uploadFile($request, $student);
            }
            return redirect()->route('studentform');

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
    public function edit($id)
    {
        //
        $student = $this->student->find($id);
        return view('student.edit',compact('student'));
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
        //
        if($this->student->update($id,$request->all()))
        {
            if ($request->hasFile('image')) {
                $student = $this->student->find($id);
                $this->uploadFile($request, $student);
            }
            return redirect()->route('student.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if($this->student->delete($id)) {
            return redirect()->route('student.index');
        }
    }

    function uploadFile(Request $request, $student)
    {
        $file = $request->file('image');
        $fileName = $this->student->uploadFile($file);
        if (!empty($student->image))
            $this->student->__deleteImages($student);


        $data['image'] = $fileName;
        $this->student->updateImage($student->id, $data);

    }
}
