<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MembersController extends Controller
{
    public function index()
    {
        $members = \App\Member::get();
        if( $members == null){
            $members = '00000';
        }
        return view('members.index',compact('members'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {   
        // dd($request->file);
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = Str::random().filter_var($file->getClientOriginalName(), FILTER_SANITIZE_URL);

            $members = \App\Member::create([ #   1 
                'name'=>$request->name,
                'comments'=>$request->comments,
                'filename' => $filename,
            ]);

            // $file->move(attachments_path(), $filename);
            $file->move(attachments_path2(), $filename);
        }

        return response()->json($members,201);
    }

    public function show(\App\Member $member)
    {
    }

    public function edit(Request $request, $id)
    {
        $members = \App\Member::where('id',$id)->first();
        
        return response()->json($members,201);
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'name2' => 'require',
            'comments2' => 'required', 
        ]);
        \App\Member::where('id',$id)->update([
            'name'=>$request->name2,
            'comments'=>$request->comments2,
        ]);

        $members = \App\Member::where('id',$id)->first();

        return response()->json($members,201);
    }

    public function destroy(\App\Member $member)
    {
        $member->delete();
    
        return response()->json([],204);
    }
}
