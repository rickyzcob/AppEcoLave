<div>
    <div class="panel">
        <div class="panel-head">
            <h2>Avaliar cliente</h2>
        </div>

        <form wire:submit="save" class="form-grid">
            <div class="input-group full">
                <label>Cliente</label>
                <select wire:model="state.client_id">
                    <option value="">Escolha</option>
                    @foreach($response->clients as $itemClient )
                        <option value="{{$itemClient['id']}}">{{$itemClient['name']}}</option>
                    @endforeach
                </select>
                @error('client_id')
                <p class="form_error_message">{{ $message }}</p>
                @enderror
            </div>

            <div class="input-group full">
                <label>Avaliação por estrelas</label>
                <x-rating wire:model="state.rate" color="yellow" lg />
            </div>

            <div class="input-group full">
                <label>Comentário descritivo</label>
                <textarea wire:model="state.comment" placeholder="Escreva sua avaliação sobre o cliente"></textarea>
            </div>

            <button type="submit" class="btn full">Enviar avaliação</button>
        </form>
    </div>
</div>
