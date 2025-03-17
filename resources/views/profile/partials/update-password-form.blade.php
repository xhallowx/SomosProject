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
                {{ __('Update your password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400" style="color: #D1D1D1;">
                {{ __('Be sure to use a long password for added security') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="update_password_current_password" style="color: #fff;" :value="__('Current password')" />
                <x-text-input id="update_password_current_password" style="color: #fff;" name="current_password" type="password" class="mt-1 block w-full inp" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" style="color: #fff;" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" style="color: #fff;" :value="__('New password')" />
                <x-text-input id="update_password_password" style="color: #fff;" name="password" type="password" class="mt-1 block w-full inp" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" style="color: #fff;" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" style="color: #fff;" :value="__('Confirm password')" />
                <x-text-input id="update_password_password_confirmation" style="color: #fff;" name="password_confirmation" type="password" class="mt-1 block w-full inp" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" style="color: #fff;" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button class="guardar" style="color: #333;">{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400" style="color: #35ca3e;"
                        >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </section>
</body>
</html>