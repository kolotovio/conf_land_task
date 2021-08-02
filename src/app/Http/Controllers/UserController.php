<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserRegistedNotification;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        // dd($users);
        return view('userstable')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get only hardcoded data in Request
        $data = $request->only(['first_name', 'last_name', 'middle_name', 'email', 'phone', 'company', 'job_title']);

        // Make Validator Rules
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
        ]);

        // Return Validator Errors if are exists
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // 
        $faker = Factory::create();

        // Create New User (or registration for conference by the Test Task)
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company' => $data['company'],
            'job_title' => $data['job_title'],
            'uuid' => $faker->uuid()
        ]);

        // Make a Secret Link
        $secretLink = config('app.url') . '/' . $user->uuid;

        // Make SVG image with QRcoded Secret Link
        $qr = QrCode::size(200)->generate($secretLink);

        // Store SVG Image to local filesystem
        Storage::disk('public')->put('qrcodes/' . $user->uuid . '.svg', $qr);

        Notification::send($user, new UserRegistedNotification($user));
        // $user->notify(new UserRegistedNotification($user));

        // Return 200 success response after user was created
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User['uuid']
     * @return \Illuminate\Http\Response
     */
    public function show($uuid = null)
    {
        if ($uuid) {
            $user = User::where('uuid', $uuid)->first();
            if ($user) {
                return view('userpage')->with('user', $user);
            }
            abort(404);
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
