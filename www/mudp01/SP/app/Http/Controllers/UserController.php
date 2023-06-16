<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Google\Service\CloudSearch\Id;
use Google_Client;
use Google_Model;
use GuzzleHttp\Psr7\Header;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\Store;
use function PHPSTORM_META\type;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    private function emailValid($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    private function emailUsed($email)
    {
        $id = DB::table('user')->select('id')->where('email', '=', $email)->get();
        if (count($id) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function passwordValid($password)
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{8,16}$/';
        if (preg_match($pattern, $password)) {
            return true;
        } else {
            return false;
        }
    }

    private function passwordMatch($password1, $password2)
    {
        if (isset($password1) && isset($password2)) {
            if (strcmp($password1, $password2) === 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function insertNewUser($email, $firstName, $lastName, $hash)
    {
        DB::table('user')->insert([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'hash' => $hash,
            'role' => 'customer'
        ]);
    }

    private function hashPassword($password)
    {
        $algoritm = PASSWORD_ARGON2I;
        $hash = password_hash($password, $algoritm);
        return $hash;
    }

    public function registerUser(Request $request)
    {
        if (!is_null(request()->input('firstName')) && !is_null(request()->input('lastName'))) {
            if (!$this->emailUsed($request->input('email'))) {
                if ($this->emailValid($request->input('email'))) {
                    if ($this->passwordValid($request->input('password1'))) {
                        if ($this->passwordMatch(password1: $request->input('password1'), password2: $request->input('password2'))) {
                            try {
                                $this->insertNewUser(
                                    email: $request->input('email'),
                                    firstName: $request->input('firstName'),
                                    lastName: $request->input('lastName'),
                                    hash: $this->hashPassword($request->input('password1'))
                                );
                                session()->start();
                                session()->put('id', DB::table('user')->select('id')->where('email', '=', $request->input('email'))->get());
                                return redirect('/');
                            } catch (Exception $e) {
                                return view('register', ['Error' => 'inserting error']);
                            }
                        } {
                            return view('register', ['Error' => 'unmatching password']);
                        }
                    } else {
                        return view('register', ['Error' => 'invalid password']);
                    }
                } else {
                    return view('register', ['Error' => 'invalid email']);
                }
            } else {
                return view('register', ['Error' => 'used email']);
            }
        }else {
            return view('register', ['Error' => 'unfilled name']);
        }
    }

    private function insertNewTokenUser($id, $email, $firstName, $lastName)
    {
        DB::table('user')->insert([
            'sub' => "'" . $id . "'",
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'role' => 'customer'
        ]);
    }

    private function getUserId(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $hash = DB::table('user')->select('hash')->where([
            ['email', '=', $email]
        ])->get();
        if (count($hash) > 0) {
            $verify_hash = password_verify($password, $hash[0]->hash);
        } else {
            return false;
        }
        if ($verify_hash) {
            $id = DB::table('user')->select('id')->where([
                ['email', '=', $email]
            ])->get();
            return $id[0]->id;
        } else {
            return false;
        }
    }

    public function loginUser(Request $request)
    {
        $id_token = $request->input('token');
        if (isset($id_token)) {
            $client = new Google_Client(['client_id' => '710979517533-docr9ekb3jhfrntcus0n62okjrcvmlgm.apps.googleusercontent.com']);
            $payload = $client->verifyIdToken($id_token);
            if ($payload) {
                $id_db = DB::table('user')->select('id')->where('sub', '=', "'" . $payload['sub'] . "'")->get();
                $role = DB::table('user')->select('role')->where('sub', '=', "'" . $payload['sub'] . "'")->get();
                if (count($id_db) > 0) {
                    session()->start();
                    session()->put('id', $id_db[0]->id);
                    session()->put('role', $role[0]->role);
                    return redirect('/');
                } else {
                    $this->insertNewTokenUser(id: $payload['sub'], email: $payload['email'], firstName: $payload['given_name'], lastName: $payload['family_name']);
                    $id_db = DB::table('user')->select('id')->where('sub', '=', "'" . $payload['sub'] . "'")->get();
                    if (count($id_db) > 0) {
                        session()->start();
                        session()->put('id', $id_db[0]->id);
                        session()->put('role', $role[0]->role);
                        return redirect('/');
                    } else {
                        return view('login', ['Error' => 'OAuth error']);
                    }
                }
            } else {
                return view('login', ['Error' => 'OAuth error']);
            }
        } else {
            if (!is_null($request->input('password')) && !is_null($request->input('email'))) {
                $user_id = $this->getUserId($request);
                if ($user_id != false) {
                    $role = DB::table('user')->select('role')->where('id', '=', $user_id)->get();
                    session()->start();
                    session()->put('id', $user_id);
                    session()->put('role', $role[0]->role);
                    return redirect('/');
                } else {
                    return view('login', ['Error' => 'Wrong credentials']);
                }
            } else {
                return view('login', ['Error' => 'Missing input value']);
            }
        }
    }
}
