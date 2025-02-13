<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/login.css')}}">
    <link rel="icon" href="{{asset('somos.ico')}}" type="image/x-icon">
</head>
<body>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container">
            <div class="login">
                <h2>Inicia Sesión</h2>
                <div class="input-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error id="alert" :messages="$errors->get('email')" class="mt-2 error" />
                </div>

                <div class="input-group">    
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />

                        <x-input-error id="alert" :messages="$errors->get('password')" class="mt-2 error" />
                    </div>
                </div>

                    <x-primary-button class="button">
                        {{ __('Iniciar Sesión') }}
                    </x-primary-button>
            </div>    
        </div>
    </form>
<script src="{{asset('build/assets/js/tasks/create.js')}}"></script>
</body>
</html>
    