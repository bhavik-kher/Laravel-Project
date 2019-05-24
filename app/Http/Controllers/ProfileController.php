<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Auth;
use App\User;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function edit(){
    	$user = Auth::user();
        $user->categoryArray = $user->categories()->pluck('id')->toArray();
        return view('profile.edit',compact('user'));
    }
    public function update(Request $request, User $user){
    	$this->validator($request->all())->validate();
        

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $categories = $request->categories;
            // dd($categories);
        $cat = $user->categories()->pluck('id')->toArray();
        
        if(count($categories)){
            foreach($categories as $id){
                $catExists = \DB::table('category_user')->where('user_id', '=', $user->id)->pluck('category_id')->toArray();
                if(!in_array($id, $catExists)){
                    $user->categories()->attach($id);
                }
            }
        }
        $user->save();
        return redirect()->back()->with('success','Profile Updated Successfully');
    }

    protected function validator(array $data)
    {
        return \Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|min:10|max:10'
        ]);
    }
}
