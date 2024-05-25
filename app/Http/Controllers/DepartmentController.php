<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{

    //show all //
    public function index()
    {
        $data=Department::orderBy('id','desc')->get();
        return view('department.index',['data'=>$data]);
    }

   // create department ///
    public function create()
    {
        return view('department.create');
    }

    //insert data //
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);
        $data=new Department();
        $data->title=$request->title;
        $data->save();
        return redirect('depart/create')->with('msg','Data has been submitted');
    }

    //show//
    public function show($id)
    {
        $data = Department::find($id);
        return view('department.show',['data'=> $data]);
    }

// edit//
    public function edit($id)
    {  $data = Department::find($id);
        return view('department.edit',['data'=> $data]);
    }

   //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required'
        ]);
        $data=Department::find($id);
        $data->title=$request->title;
        $data->save();
        return redirect('depart/'.$id.'/edit')->with('msg','Data has been Updated');
    }

  //delete//
    public function destroy($id)
    {
        Department::where('id',$id)->delete();
        return redirect('depart');
    }
}
