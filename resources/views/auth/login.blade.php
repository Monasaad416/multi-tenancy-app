<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('البريد الإلكتروني')" class="float-right my-8"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <x-input-label for="password" :value="__('كلمة السر')" class="float-right my-8"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mt-8 float-right">
            <label for="remember_me" class="inline-flex items-center ">
                <span class="ml-2 text-sm text-gray-600">{{ __('ذكرني بكلمة السر') }}</span>
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            </label>
        </div>
        <br>

        <div class="mt-8">

            <x-primary-button class="float-left mr-4">
                {{ __('تسجيل الدخول') }}
            </x-primary-button>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 float-right" href="{{ route('password.request') }}">
                    {{ __('هل نسيت كلمة المرور ؟') }}
                </a>
            @endif

        </div>
{{-- 
        <div class="flex items-center justify-end mt-6 float-right ">


            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-3" href="{{ route('register') }}">
                {{ __('تسجيل حساب جديد ') }}
            </a>

            {{ __('لا تملك حساب؟') }}
        </div> --}}
    </form>
</x-guest-layout>
