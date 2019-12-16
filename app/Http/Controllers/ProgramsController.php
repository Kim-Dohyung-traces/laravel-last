<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', ]]);
    }

    public function index()
    {
        $program = new \App\program;
        $programs = $program->latest()->paginate(5);
        return view('programs.index',compact('program','programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([],201);
    }
    public function store(\App\Http\Requests\ProgramsRequest $request)
    {
        $program = $request->user()->programs()->create($request->all());
        if (!$program) {
            flash()->error('글 작성 실패');
            return back()->withInput();
        }
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $program->program_attachments()->create([
                    'program_id'=> $program->id,
                    'filename' => $filename,
                    'bytes' => $file->getSize(),
                    'mime' => $file->getClientMimeType()
                ]);
                $file->move(program_attachments_path(), $filename);
            }
        }
        return response()->json([],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $program = \App\Program::find($id);

        return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Program $program)
    {
        $this->authorize('edit', $program);

        return response()->json([], 204);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\ProgramsRequest $request, \App\Program $program)
    {
        \Log::info($request->all());
        $this->authorize('update', $program);
        $program->update($request->all());
        //store메서드에도 있음
        flash()->success('수정하신 내용을 저장했습니다.');

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file) {
                $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);
                $program->program_attachments()->update([
                    'program_id'=> $program->id,
                    'filename' => $filename,
                    'bytes' => $file->getSize(),
                    'mime' => $file->getClientMimeType()
                ]);
                $file->move(program_attachments_path(), $filename);
            }
        }
        return response()->json([], 204);
    }
    public function destroy(\App\Program $program)
    {   
        $this->authorize('delete', $program);
        $program->delete();
        return response()->json([], 204);
        return $program;
    }
}
