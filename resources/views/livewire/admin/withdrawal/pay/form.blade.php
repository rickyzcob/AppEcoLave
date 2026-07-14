<div>

    <div class="flex items-center flex-wrap gap-3 justify-between p-4">
        <div class="font-bold text-gray-600">
            <h2 class="text-lg font-medium">Dados de Pagamento</h2>
        </div>
    </div>

    <form wire:submit="update">

        <div class="grid grid-cols-12 gap-4 p-5 items-end">

            <div class="md:col-span-6 col-span-12 input-group">
                <label>Numero Comprovante</label>
                <input type="text" wire:model="state.proof_number">
                @error('proof_number')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-6 col-span-12 input-group">
                <label>Status</label>
                <select wire:model="state.status">
                    <option value="">Escolha</option>
                    <option value="paid">Pago</option>
                    <option value="error">Erro</option>
                </select>
                @error('status')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 input-group">
                <label>Anexo</label>
                <input type="file" wire:model="file_path">
                @error('file_path')
                <p class="text-red-700 text-sm">{{ $message }}</p>
                @enderror
            </div>



            <div class=" col-span-12 input-group">
                <label>Observações</label>
                <textarea type="file" wire:model="state.observations"></textarea>
                @error('name')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 ">
                <button class="btn" type="submit">Salvar Alterações</button>
            </div>
        </div>
    </form>
</div>
