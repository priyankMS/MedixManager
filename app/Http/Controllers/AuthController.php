<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\FileUpload;
use Illuminate\Http\Request;
use App\Services\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    protected $fileUpload, $create;


    // Inject the FileUpload service via constructor
    public function __construct(FileUpload $fileUpload, UserData $create)
    {
        $this->fileUpload = $fileUpload;
        $this->create = $create;
    }

    public function registerView()
    {
        return view('auth.login');
    }

    public function register(UserRequest $request)
    {
        DB::beginTransaction();
        try {

            $validateData = $request->validated();
            $validateData['password'] = bcrypt($request->password);

            //file save
            if ($request->hasFile('profile_photo')) {
                $path = $this->fileUpload->upload($request->file('profile_photo'), 'profile_photos');
                $validateData['profile_photo'] = $path;
            }

            $this->create->create($validateData);
            DB::commit(); //commit everything is fine
            return redirect()->route('login')->with('success', 'Registration Successful');
        } catch (\Exception $e) {
            DB::rollback();  // Rollback the transaction if something goes wrong

            // Log the error message (optional, for debugging)
            Log::error('Registration Failed: ' . $e->getMessage());


            return back()->with('error', 'Registration Failed. Please try again.');
        }
    }

    public function index()
    {
        return view('auth.login'); // Render the login view
    }

    public function login(Request $request)
    {
        // Validate email and password input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        try {

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate(); // Prevent session fixation attacks
                toastr()->success('login successfully');
                return redirect()->route('dashboard')->with('success', 'Login Successful');
            } else {
                return back()->with('error', 'Invalid login details');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token
        toastr()->success('logout successfully');
        return redirect()->route('login')->with('success', 'Logout Successful');
    }
}
