<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\State;
use App\Models\City; 
use Illuminate\Support\Facades\storage;

class RegistrationController extends Controller
{
    public function create()
    {
        $states = State::all();
        return view('auth.registration', compact('states'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|alpha_num',
            'last_name' => 'required|alpha_num',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'password_confirmation' => 'required|same:password',
            'contact_number' => 'required|numeric|digits:10',
            'postcode' => 'required|alpha_num|max:6',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'gender' => 'required|in:male,female,other',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'in:reading,sports,traveling,music',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $imagePath = null;
        // if ($request->hasFile('image')) {
        //     $extension = $request->file('image')->getClientOriginalExtension();
        //     // $directory = public_path("users/{$user->id}");
        //     $directory = public_path("users");
        //     if (!File::exists($directory)) {
        //         File::makeDirectory($directory, 0755, true);
        //     }
        //     $imageName = "{$request->first_name}.{$extension}"; 
        //     $request->file('image')->move($directory, $imageName);
        //     $imagePath = "users/{$imageName}";
        // }

        if ($request->file('image')) {
            // Delete old file
            // if (Storage::disk('public')->exists(str_replace('storage/', '', $user->image))) {
            //     Storage::disk('public')->delete(str_replace('storage/', '', $user->image));
            // }
            $file = $request->file('image');
    
            // Rename file with timestamp
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
    
            // Store in storage/app/public/uploads
            $file->storeAs('uploads', $fileName, 'public');
            $imagePath = 'storage/uploads/' . $fileName;
        }

        // Generate a verification token
        $verificationToken = Str::random(40); // You can change the length
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'postcode' => $request->postcode,
            'city_id' => $request->city,
            'state_id' => $request->state,
            'gender' => $request->gender,
            'hobbies' => isset( $request->hobbies) ? json_encode( $request->hobbies) : null,
            'image'=> $imagePath,
            'verification_token' => $verificationToken,
        ]);

        //verification link
        $verificationLink = route('verify', ['token' => $verificationToken]);

        return redirect()->route('login.create')->with('success', 'Registration successful! Please verify your account by clicking the link: ' . $verificationLink);
    }

    public function getCitiesByState($id){
        $cities = City::where('state_id', $id)->get();
        return response()->json($cities);
    }

    public function verify($token)
    {
        // Find the user by the token
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login.create')->with('error', 'Invalid verification token.');
        }

        // Mark the user as verified
        $user->verified = true;
        $user->verification_token = null; // Remove the token after verification
        $user->save();

        return redirect()->route('login.create')->with('success', 'Your account has been verified!');
    }

}
