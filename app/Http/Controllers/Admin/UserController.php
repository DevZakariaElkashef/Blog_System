<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = User::all();
        return view('admin.users.view-users', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('owner');
        return view('admin.users.add-users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('owner');
        
        $request->validate([
            'user_name' => 'required|min:3',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|min:3|email',
            'role' => 'required|min:3',
            'password' => 'required|min:3',
        ]);

        

        $user = new User();
        $user->user_name = trim($request->user_name);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        return Response()->json(['message'=>'Added Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('owner');

        $row = User::findOrFail($id);
        return view('admin.users.edit-users', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('owner');

        $request->validate([
            'user_name' => 'required|min:3',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|min:3|email',
            'role' => 'required|min:3',
            'password' => 'nullable|min:3',
        ]);

        $user = User::findOrFail($request->id);
        
        if(empty($request->password)){
            $user->user_name = $request->user_name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
            return Response()->json(['message'=>'Updated Success']);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return Response()->json(['message'=>'Updated Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('owner');
        
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted Success', 'id' => $id]);
    }
}
