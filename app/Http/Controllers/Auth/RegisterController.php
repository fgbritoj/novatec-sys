<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\RegistrationConfirmation;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return Inertia::render('Auth/Register');
    }

    public function register(Request $request)
    {
        Log::info('Iniciando processo de registro', ['data' => $request->except(['password', 'password_confirmation'])]);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'
            ],
            'password_confirmation' => ['required'],
            'company_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\([0-9]{2}\)\s[0-9]{4,5}-[0-9]{4}$/'],
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.mixed' => 'A senha deve conter letras maiúsculas e minúsculas.',
            'password.numbers' => 'A senha deve conter números.',
            'password.symbols' => 'A senha deve conter caracteres especiais.',
            'password.uncompromised' => 'Esta senha já foi exposta em vazamentos de dados. Escolha outra senha.',
            'password.confirmed' => 'As senhas não correspondem.',
            'password_confirmation.required' => 'A confirmação de senha é obrigatória.',
            'company_name.required' => 'O nome da empresa é obrigatório.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.regex' => 'O telefone deve estar no formato (99) 99999-9999 ou (99) 9999-9999.',
        ]);

        if ($validator->fails()) {
            Log::warning('Validação falhou', ['errors' => $validator->errors()->toArray()]);
            return back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();
            Log::info('Iniciando transação do banco de dados');

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'role' => 'client',
            ];

            Log::info('Tentando criar usuário', ['data' => Arr::except($userData, ['password'])]);

            $user = User::create($userData);

            Log::info('Usuário criado com sucesso', ['user_id' => $user->id]);

            // Marca o e-mail como verificado automaticamente (temporário, apenas para desenvolvimento)
            $user->markEmailAsVerified();
            Log::info('E-mail marcado como verificado automaticamente');

            event(new Registered($user));
            Log::info('Evento Registered disparado');
            
            // Comentando temporariamente o envio de e-mail
            // Mail::to($user->email)->send(new RegistrationConfirmation($user));
            // Log::info('E-mail de confirmação enviado');

            DB::commit();
            Log::info('Transação do banco de dados confirmada');

            // Garante que nenhuma sessão está ativa
            if (Auth::check()) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }

            return Inertia::location(url()->previous() . '?success=true');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro ao registrar usuário', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors([
                'error' => 'Ocorreu um erro ao criar sua conta. Por favor, tente novamente.'
            ])->withInput();
        }
    }
} 