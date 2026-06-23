<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::latest('created_at')->get();

        return view('admin.services.index', compact('services'));
    }


    public function create()
    {
        return view('admin.services.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'nullable|max:200',
            'icon'          => 'nullable',
            'order'         => 'required|integer|min:0',
        ]);

        $service = new Service();
        $service->title         = $request->title;
        $service->description   = $request->description;
        $service->icon          = $request->icon;
        $service->order = $request->order;
        $service->is_active = $request->boolean('is_active');
        $service->save();

        Toastr::success('message', 'Service created successfully.');
        return redirect()->route('admin.services.index');
    }


    public function edit(Service $service)
    {
        $service = Service::findOrFail($service->id);

        return view('admin.services.edit', compact('service'));
    }


    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title'         => 'required',
            'description'   => 'nullable|max:200',
            'icon'          => 'nullable',
            'order'         => 'required|integer|min:0',
        ]);

        $service = Service::findOrFail($service->id);
        $service->title         = $request->title;
        $service->description   = $request->description;
        $service->icon          = $request->icon;
        $service->order = $request->order;
        $service->is_active = $request->boolean('is_active');
        $service->save();

        Toastr::success('message', 'Service updated successfully.');
        return redirect()->route('admin.services.index');
    }


    public function destroy(Service $service)
    {
        $service = Service::findOrFail($service->id);
        $service->delete();

        Toastr::success('message', 'Service deleted successfully.');
        return back();
    }
}
