<?php

namespace App\Modules\Service\student;

use App\Models\Student\Student;
use App\Modules\Service\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StudentService extends Service
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;

    }


    /*For DataTable*/
    public function getAllData()

    {
        $query = $this->student->whereIsDeleted('no');
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('visibility',function(Student $student) {
                if($student->visibility == 'visible'){
                    return '<span class="badge badge-info">Visible</span>';
                } else {
                    return '<span class="badge badge-danger">In-Visible</span>';
                }
            })
            ->editColumn('availability',function(Student $student) {
                if($student->availability == 'available'){
                    return '<span class="badge badge-info">Available</span>';
                } else {
                    return '<span class="badge badge-danger">Un-Available</span>';
                }
            })
            ->editColumn('status',function(Student $student) {
                if($student->status == 'active'){
                    return '<span class="badge badge-info">Active</span>';
                } else {
                    return '<span class="badge badge-danger">In-Active</span>';
                }
            })
            ->editColumn('image',function(Student $student) {
                if(isset($student->image_path)){
                    return '<a href="http://127.0.0.1:8000/'.($student->image_path).'" data-lightbox="http://127.0.0.1:8000/'.($student->image_path).'"> <img src="http://127.0.0.1:8000/'.($student->image_path).'" class="studentple-image" width="70px" height="70px" style="border-radius:50%">';
                } else {
                    ;
                }
            })
            ->editcolumn('actions',function(Student $student) {
                $editRoute =  route('student.edit',$student->id);
                $deleteRoute =  route('student.destroy',$student->id);
                return getTableHtml($student,'actions',$editRoute,$deleteRoute);
                return getTableHtml($student,'image');
            })->rawColumns(['visibility','availability','status','image'])->make(true);
    }

    public function create(array $data)
    {
        try {
           
            $data['created_by']= Auth::user()->id;
            //dd($data);
            $student = $this->student->create($data);
            return $student;

        } catch (Exception $e) {
            return null;
        }
    }


    /**
     * Paginate all User
     *
     * @param array $filter
     * @return Collection
     */
    public function paginate(array $filter = [])
    {
        $filter['limit'] = 25;

        return $this->student->orderBy('id','DESC')->whereIsDeleted('no')->paginate($filter['limit']);
    }

    /**
     * Get all User
     *
     * @return Collection
     */
    public function all()
    {
        return $this->student->whereIsDeleted('no')->all();
    }

    /**
     * Get all users with supervisor type
     *
     * @return Collection
     */


    public function find($studentId)
    {
        try {
            return $this->student->whereIsDeleted('no')->find($studentId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($studentId, array $data)
    {
        try {

            $data['visibility'] = (isset($data['visibility']) ?  $data['visibility'] : '')=='on' ? 'visible' : 'invisible';
            $data['status'] = (isset($data['status']) ?  $data['status'] : '')=='on' ? 'active' : 'in_active';
            $data['availability'] = (isset($data['availability']) ?  $data['availability'] : '')=='on' ? 'available' : 'not_available';
            $data['has_substudent'] = (isset($data['has_substudent']) ?  $data['has_substudent'] : '')=='on' ? 'yes' : 'no';
            $data['last_updated_by']= Auth::user()->id;
            $student= $this->student->find($studentId);

            $student = $student->update($data);
            //$this->logger->info(' created successfully', $data);

            return $student;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    /**
     * Delete a User
     *
     * @param Id
     * @return bool
     */
    public function delete($studentId)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $student = $this->student->find($studentId);
            $data['is_deleted']='yes';
            return $student = $student->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * write brief description
     * @param $name
     * @return mixed
     */
    public function getByName($name){
        return $this->student->whereIsDeleted('no')->whereName($name);
    }

    public function getBySlug($slug){
        return $this->student->whereIsDeleted('no')->whereSlug($slug)->first();
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/student';
            return $fileName = $this->uploadFromAjax($file);
        }
    }

    public function __deleteImages($subCat)
    {
        try {
            if (is_file($subCat->image_path))
                unlink($subCat->image_path);

            if (is_file($subCat->thumbnail_path))
                unlink($subCat->thumbnail_path);
        } catch (\Exception $e) {

        }
    }

    public function updateImage($studentId, array $data)
    {
        try {
            $student = $this->student->find($studentId);
            $student = $student->update($data);

            return $student;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }
}
