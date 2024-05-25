<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

//Route::get('/login',[AdminController::class,'login'])->name('login');
Route::get('/registers',[AdminController::class,'registers'])->name('registers');


// Route::get('employ',[EmployeeController::class,'index3']);
Route::get('/',[AdminController::class,'home'])->name('home');
Route::get('/about',[AdminController::class,'about'])->name('about');
Route::get('admin', function () {
    if (session()->has('username')) {
        return view('index');
    } else {
        return redirect('/login');
    }
});

//Route::get('admin',[AdminController::class,'index']);
Route::post('admin/login',[AdminController::class,'submit_login'])->name('register');;

Route::get('/login',function(){
    if(session()->has('username'))
    {
        return redirect('admin');
    }
    return view('/login');
});

Route::get('admin/logout',function(){
    if(session()->has('username'))
    {
        session()->pull('username');
    }
    return redirect('/');
});



// Department Resource
Route::get('depart/{id}/delete',[DepartmentController::class,'destroy']);
Route::resource('depart',DepartmentController::class);


//Route::resource('dashemploye',DashController::class);




// Employee Resource
Route::get('employee/{id}/delete',[EmployeeController::class,'destroy']);
Route::resource('employee',EmployeeController::class);
//Route::get('employ',[EmployeeController::class,'index2']);
// Route::get('/employeelogin',[EmployeeController::class,'login'])->name('login');
// Route::post('employee/login',[EmployeeController::class,'index3'])->name('index3');;




///admin register
//Route::get('/reigisters',[AdminController::class,'reigisters'])->name('reigisters');
Route::post('admin/registers',[AdminController::class, 'postRegisters'])->name('admin.registers');

///admin register

///admin register
Route::get('/contact',[AdminController::class,'contact'])->name('contact');
Route::get('/project',[AdminController::class,'project'])->name('project');
Route::get('/service',[AdminController::class,'service'])->name('service');
Route::get('/blog',[AdminController::class,'blog'])->name('blog');
