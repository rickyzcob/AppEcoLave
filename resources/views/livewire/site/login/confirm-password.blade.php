{{--<div class="flex flex-col gap-6">--}}

{{--    <x-loading loading="confirmPassword" />--}}

{{--    <x-auth-header--}}
{{--        :title="__('Confirm password')"--}}
{{--        :description="__('This is a secure area of the application. Please confirm your password before continuing.')"--}}
{{--    />--}}

{{--    <!-- Session Status -->--}}
{{--    @if (session('success'))--}}
{{--        <div class="bg-green-100 text-green-800 px-4 py-2 rounded">--}}
{{--            {{ session('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <form wire:submit="confirmPassword" class="flex flex-col gap-6">--}}
{{--        <!-- Password -->--}}
{{--        <flux:input--}}
{{--            wire:model="password"--}}
{{--            :label="__('Password')"--}}
{{--            type="password"--}}
{{--            required--}}
{{--            autocomplete="new-password"--}}
{{--            :placeholder="__('Password')"--}}
{{--            viewable--}}
{{--        />--}}

{{--        <x-button variant="primary" type="submit" class="w-full">{{ __('Confirm') }}</x-button>--}}
{{--    </form>--}}
{{--</div>--}}

<div>
    <form wire:submit="confirmPassword" class="p-5">

        <div class="grid grid-cols-12 gap-4 ">

            <div class="col-span-12">
                <input type="password" wire:model="password" placeholder="Crie uma nova senha" class="form_input @error('password') form_input--error @enderror" >
                @error('password')
                <div class="form_error_message">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-span-12">
                <button type="submit" class="form_button">Alterar Senha</button>
            </div>
        </div>
    </form>
</div>
