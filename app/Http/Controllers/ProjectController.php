<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::orderBy('created_at', "DESC");
            return datatables()->of($projects)
            ->addColumn('start', function($project){
                return "<small>". tanggal($project->start, false) ."</small>";
            })
            ->addColumn('end', function($project){
                return "<small>". tanggal($project->end, false) ."</small>";
            })
            ->addColumn('leader', function($project){
                return '<div class="row no-gutters">
                                <div class="col-md-4 m-auto">
                                    <img src="'. asset($project->image) .'" alt="..." class="img-thumbnail rounded-circle" style="width: 60%;">
                                </div>
                                <div class="col-md-8">
                                    <small>'. $project->name .'</small>
                                    <small class="text-muted">'. $project->email .'</small>
                                </div>
                            </div>';
            })
            ->addColumn('progress', function($project){
                $color = "bg-success";
                if($project->progress < 100){
                    $color = "bg-primary";
                }
                if($project->progress < 40){
                    $color = "bg-info";
                }

                return '<div class="progress">
                <div class="progress-bar '. $color .'" role="progressbar" style="width: '. $project->progress .'%" aria-valuenow="'. $project->progress .'" aria-valuemin="0" aria-valuemax="100"></div>
              </div>';
            })
            ->addColumn('action', function ($project){
                return '<a href="'.route('project.edit', $project->id).'" class="btn btn-warning btn-sm">Edit</a>
                    <button type="button" onclick="Delete(`' . $project->id . '`)" class="btn btn-danger btn-sm">Delete</button>';
            })
            ->rawColumns(['progress', 'start', 'end', 'action', 'leader'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('monitoring.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Project";
        return view('monitoring.create', compact('title'));
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
            'name'      => 'required',
            'email'     => 'required|email',
            'image'     => 'required|image',
            'client'    => 'required',
            'leader'    => 'required',
            'start'     => 'required|date',
            'end'       => 'required|date',
            'progress'  => 'required|integer'
        ]);
        //upload image
        $img = "";
        if ($request->hasFile('image')) {
            $image = $request->image;
            $img = time() . $image->getClientOriginalName();
            $image->move('upload', $img);

            $img = "upload/" . $img;
        }

        $img = $img;

        $project = Project::create([
            'image'         => $img,
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'client'        => $request->input('client'),
            'leader'        => $request->input('leader'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'progress'      => $request->input('progress'),
        ]);
        if($project){
            return redirect()->route('project.index')->with('success','project created successfully');
        }else{
            return redirect()->route('project.index')->with('error','project created not successful');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title = "Update Project";
        return view('monitoring.edit', compact('title', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email',
            'image'     => 'image',
            'client'    => 'required',
            'leader'    => 'required',
            'start'     => 'required|date',
            'end'       => 'required|date',
            'progress'  => 'required|integer'
        ]);
        $project = Project::findOrFail($project->id);

        //upload image
        $img = $project->image;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $img = time() . $image->getClientOriginalName();
            $image->move('upload', $img);

            $img = "upload/" . $img;
        }

        $img = $img;

        $project->update([
            'image'         => $img,
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'client'        => $request->input('client'),
            'leader'        => $request->input('leader'),
            'start'         => $request->input('start'),
            'end'           => $request->input('end'),
            'progress'      => $request->input('progress'),
        ]);
        if($project){
            return redirect()->route('project.index')->with('success','project updated successfully');
        }else{
            return redirect()->route('project.index')->with('error','project updated not successful');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        if($project){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
