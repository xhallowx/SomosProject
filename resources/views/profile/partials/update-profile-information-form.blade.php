<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('build/assets/css/perfil.css')}}">
</head>
<body>
    <section class="infoPerfil">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100" style="color: #fff;">
                {{ __('Profile information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400" style="color: #D1D1D1;">
                {{ __("Update your account information and email.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" style="color: #fff;" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full inp" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" style="color: #fff;" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full inp" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200" style="color: #35ca3e;">
                            {{ __('Your account has no been verified') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to resend the verification verification link.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="guardar">{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400" style="color: #35ca3e;"
                    >{{ __('Saved') }}</p>
                @endif
            </div>
        </form>
    </section>
</body>
</html>