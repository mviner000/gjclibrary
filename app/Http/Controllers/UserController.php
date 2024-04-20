<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Str;
 
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
 
        // Return Json Response
        return response()->json([
            'results' => $users
        ], 200);
    }
 
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:superadmin,admin,student,teacher,staff',
        ]);

        // Generate UUID
        $validatedData['id'] = Str::uuid();

        // Create the user
        $user = User::create([
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Return a JSON response
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

 
    public function show($id)
    {
        // User Detail 
        $users = User::find($id);
        if (!$users) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }
 
        // Return Json Response
        return response()->json([
            'users' => $users
        ], 200);
    }
 
    public function update(UserStoreRequest $request, $id)
    {
        try {
            // Find User
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User Not Found.'
                ], 404);
            }

            // Update User
            $user->name = $request->name;
            $user->email = $request->email;

            // Save changes
            $user->save();

            // Return Json Response
            return response()->json([
                'message' => "User with ID $id successfully updated."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

 
    public function destroy($id)
    {
        // Detail 
        $users = User::find($id);
        if (!$users) {
            return response()->json([
                'message' => 'User Not Found.'
            ], 404);
        }
 
        // Delete User
        $users->delete();
 
        // Return Json Response
        return response()->json([
            'message' => "User successfully deleted."
        ], 200);
    }
}