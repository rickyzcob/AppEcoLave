<div>
    <x-card round="2xl">
        <form wire:submit="save" class="p-5">

            <div class="grid grid-cols-12 gap-4 ">
                <div class="md:col-span-12">
                    <input type="text" wire:model="state.name" placeholder="Nome completo" class="form_input @error('name') form_input--error @enderror"/>
                    @error('name')
                    <p class="form_error_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12">
                    <input type="text" x-mask="999.999.999-99" wire:model="state.taxpayer_registration" placeholder="CPF" class="form_input @error('taxpayer_registration') form_input--error @enderror">
                    @error('taxpayer_registration')
                    <p class="form_error_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12">
                    <input type="tel" x-mask="(99) 9 9999-9999" wire:model="state.phone" placeholder="Telefone / WhatsApp" class="form_input @error('phone') form_input--error @enderror">
                    @error('phone')
                    <p class="form_error_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12">
                    <input type="email" wire:model="state.email" placeholder="Seu e-mail" class="form_input @error('email') form_input--error @enderror">
                    @error('email')
                    <p class="form_error_message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <input type="password" wire:model="state.password" placeholder="Crie uma senha" class="form_input @error('password') form_input--error @enderror" >
                    @error('password')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-6 col-span-12">
                    <input type="password" wire:model="state.password_confirmation" placeholder="Confirme sua senha"  class="form_input @error('confirm_password') form_input--error @enderror">
                    @error('confirm_password')
                    <div class="form_error_message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-12">
                    <button type="submit" class="form_button">Criar minha conta</button>
                </div>
            </div>
        </form>
    </x-card>
</div>
