<?php
namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(User::class)
                    ->maxLength(255),
                TextInput::make('number')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(15)
                    ->minLength(10)
                    ->unique(User::class, 'number')
                    ->prefix('+62'),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('passwordConfirmation'),
                TextInput::make('passwordConfirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->required(),
            ]);
    }

    public function register(): ?User
    {
        $data = $this->form->getState();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign role customer
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $user->assignRole($customerRole);

        event(new Registered($user));

        return $user;
    }
}