<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\DepartmentCreateRequest;
use App\Http\Requests\Department\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $deps = Department::paginate();

        return inertia('Admin/Department/Index',[
            'page_departments' => $deps
        ]);
    }

    public function create()
    {
        return inertia('Admin/Department/Create');
    }

    public function store(DepartmentCreateRequest $request)
    {

        $dep = Department::create($request->validated());

        flash('Yeni departman oluşturuldu.')->success();
        return redirect()->route('admin.department.edit',$dep);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dep = Department::findOrFail($id);

        return inertia('Admin/Department/Edit',[
            'page_department' => $dep
        ]);
    }

    public function update(DepartmentUpdateRequest $request, $id)
    {
        $dep = Department::findOrFail($id);
        $dep->update($request->validated());

        flash('Departman bilgisi güncellendi.')->success();
        return back();
    }

    public function destroy($id)
    {
        $dep = Department::findOrFail($id);

        if($dep->tickets()->count() > 0){

            flash('Departman kayıtlı destek bildirimleri mevcut, silinemez.')->error()->important();
            return back();
        }else{
            $dep->delete();
            return redirect()->route('admin.department.index');
        }

    }
}
