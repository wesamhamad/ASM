<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Coordinator;
use App\Models\Dean;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:student,coordinator,dean'],
            'coordinator_id' => ['nullable', 'required_if:role,dean', 'exists:coordinators,coordinator_id'],
            'dean_id' => ['nullable', 'required_if:role,coordinator', 'exists:deans,dean_id'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        switch ($data['role']) {
            case 'student':
                Student::create([
                    'user_id' => $user->id,
                ]);
                break;

            case 'coordinator':
                Coordinator::create([
                    'user_id' => $user->id,
                    'dean_id' => $data['dean_id'],
                ]);
                break;

            case 'dean':
                Dean::create([
                    'user_id' => $user->id,
                    'coordinator_id' => $data['coordinator_id'],
                ]);
                break;
        }

        return $user;
    }

    public function showRegistrationForm()
    {
        $coordinators = Coordinator::with('user')->get();
        $deans = Dean::with('user')->get();
        return view('auth.register', compact('coordinators', 'deans'));
    }
}
