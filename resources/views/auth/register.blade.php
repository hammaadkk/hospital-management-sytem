<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <div class="registration-container">
  <div class="registration-title" align="center"><b>Welcome to our Registration Page</b></div>
  <br>
  <p><b>Please fill out the form below to create your account:</b></p>
  <br>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div>
                <x-label for="father_name" value="{{ __('father_name') }}" />
                <x-input id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name')" required autofocus autocomplete="father_name" />
            </div>

            <div>
    <x-label for="cnic_no" value="{{ __('CNIC Number') }}" />
    <input id="cnic_no" class="block mt-1 w-full" type="text" name="cnic_no" required autocomplete="cnic_no" />
</div>



            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div>
                <x-label for="phone" value="{{ __('phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            </div>

            <div>
                <x-label for="address" value="{{ __('address') }}" />
                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="off" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cnicInput = document.getElementById('cnic_no');

    cnicInput.addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

        if (value.length > 13) {
            value = value.substr(0, 13); // Limit to 13 characters
        }

        if (value.length >= 6 && value.charAt(5) !== '-') {
            value = value.substr(0, 5) + '-' + value.substr(5); // Add first dash
        }

        if (value.length >= 14 && value.charAt(13) !== '-') {
            value = value.substr(0, 13) + '-' + value.substr(13); // Add second dash
        }

        e.target.value = value;
    });
});
</script>
