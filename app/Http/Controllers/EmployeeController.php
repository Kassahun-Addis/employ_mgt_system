<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
class EmployeeController extends Controller
{


    //show all data//
    public function index()
    {
        $data=Employee::orderBy('id','asc')->get();
        return view('Employee.index',['data'=>$data]);
    }


    //create employee//
    public function create()
    {
     $data = Department::orderBy('id', 'asc')->get();
        return view('employee.create',['departments'=>$data]);
    }

    //insert data//
    public function store(Request $request)
    {
         $requestData = $request->validate([
                'full_name'=>'required',
                'photo'=>'required',
                'address'=>'required',
                'mobile'=>'required',
                'status'=>'required',
            ]);
            $photo = $request->file('photo');
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo->move($destinationPath, $fileName);

            $data=new Employee();
            $data->department_id=$request->depart;
            $data->full_name=$request->full_name;
            $data->photo=    $fileName;
            $data->address=$request->address;
            $data->mobile=$request->mobile;
            $data->status=$request->status;
            $data->save();

            return redirect('employee/create')->with('msg','Data has been submitted');
    }


  //show data//
    public function show(string $id)
     {
        $data = Employee::find($id);
        return view('employee.show',['data'=> $data]);
     }


   //edit data//
    public function edit(string $id)
    {
        $departs=Department::orderBy('id','desc')->get();
        $data=Employee::find($id);
        return view('employee.edit',['departs'=>$departs,'data'=>$data]);
    }


   //update data//
    public function update(Request $request, string $id)
    {
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $destinationPath = public_path('/images');
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $photo->move($destinationPath, $fileName);
        }
        else
        {
            $fileName=$request->prev_photo;
        }
        $data =Employee::find($id);
        $data->department_id=$request->depart;
        $data->full_name=$request->full_name;
        $data->photo= $fileName;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status;
        $data->save();

        return redirect('employee/'.$id.'/edit')->with('msg','Data has been Updated');
    }


    // delete
    public function destroy(string $id)
    {
        Employee::where('id',$id)->delete();
        return redirect('employee');
    }




}
