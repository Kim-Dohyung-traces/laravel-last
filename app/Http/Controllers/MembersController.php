<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = \App\Members::get();
        return view('members.index',compact('members'));
    }
    
    public function ajaxIndex(Request $request, $id){

        // print($id);
        $members = \App\Members::where('id',$id)->first();
        // $members = \App\Members::get();
        
        return response()->json($members,201);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = new \App\Members;

        return view('members.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->file);
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);

            $members = \App\Members::create([ #   1 
                'name'=>$request->name,
                'comments'=>$request->comments,
                'filename' => $filename,
            ]);

            $file->move(attachments_path(), $filename);
            }

        return response()->json($members,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Members $member)
    {
        print("여기는 쇼");
        return view("members.show",compact("member"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Members $member)
    {
        return view('members.edit',compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // \App\Http\Requests\MembersRequest $request, \App\Members $member
    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'name2' => 'require',
            'comments2' => 'required', 
        ]);
        \App\Members::where('id',$id)->update([
            'name'=>$request->name2,
            'comments'=>$request->comments2,
        ]);

        $members = \App\Members::where('id',$id)->first();

        return response()->json($members,201);
        // return response()->json([],204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Members $member)
    {
        // print("haha");
        // $board = \App\Board::Class;
        // $idd = $board->find($id);
        $member->delete();
    
        return response()->json([],204);
    }
}
