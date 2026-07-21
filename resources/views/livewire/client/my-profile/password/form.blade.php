<div>
    <form wire:submit="save">
        <div class="grid md:grid-cols-12 gap-4 items-end p-4">

            <div class="md:col-span-12">
                <x-password wire:model="state.current_password" label="Senha Atual *"  />
                @error('current_password')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="md:col-span-12">
                {{--                <x-password wire:model="state.password" label="Nova Senha *"  />--}}
                <x-password label="Nova Senha *" wire:model.live="state.password" generator :rules="['min:8', 'symbols:!@#', 'numbers', 'mixed']" />
                {{--                @error('password')--}}
                {{--                <div class="text-red-800 text-xs p-1">{{ $message }}</div>--}}
                {{--                @enderror--}}
            </div>

            <div class="md:col-span-12">
                <x-password wire:model="state.password_confirmation" label="Confirmar Nova Senha *"  />
                @error('password_confirmation')
                <div class="text-red-800 text-xs p-1">{{ $message }}</div>
                @enderror
            </div>


            <div class="md:col-span-12">
                <div class="form-group form-group-full">
                    <div class="profile-btn-row">
                        <button type="submit" class="btn btn-primary" style="flex:1;">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
