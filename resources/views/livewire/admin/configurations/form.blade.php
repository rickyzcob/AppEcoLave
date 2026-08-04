<div>


                <form wire:submit="update" >
                    <div class="panel-head"><h2>Configurações Gerais</h2><button class="btn" onclick="toast('Configurações salvas')">Salvar alterações</button></div>

                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 input-group">
                            <label>Nome</label>
                            <input wire:model="state.name">
                            @error('name')
                            <p class="form_error_message">{{ $message }}</p>
                            @enderror
                        </div>



                        <div class="md:col-span-6 col-span-12 input-group">
                            <label>Horário inicial</label>
                            <input type="time" wire:model="state.start_time">
                            @error('start_time')
                            <p class="form_error_message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 input-group">
                            <label>Horário final</label>
                            <input type="time" wire:model="state.end_time">
                            @error('end_time')
                            <p class="form_error_message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-12 input-group">
                            <label>Descrição</label>
                            <textarea type="time" wire:model="state.description"></textarea>
                            @error('description')
                            <p class="form_error_message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 input-group">

                            <label>Logo</label>
                            <div class="profile-avatar-wrap">
                                <div class="profile-avatar">
                                    @if (isset($logo))
                                        <img src="{{ $logo->temporaryUrl() }}" class="rounded-full mx-auto d-block w-96">
                                    @elseif(isset($state['logo']) && $state['logo'] !== null)
                                        <img src="{{ url('storage/'.$state['logo']) }}" class="rounded-full mx-auto d-block w-96" alt="Usuario" >
                                    @endif
                                </div>
                            </div>

                            <input type="file" wire:model="logo">
                            @error('logo')
                            <p class="form_error_message">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-6 col-span-12 input-group">

                        </div>


                    </div>

                    {{--        <div class="input-group">--}}
            {{--            <label>Cupom promocional</label>--}}
            {{--            <input value="ECO10">--}}
            {{--        </div>--}}

            {{--        <div class="input-group">--}}
            {{--            <label>Banner ativo</label>--}}
            {{--            <select>--}}
            {{--                <option>Banner ecológico ativo</option>--}}
            {{--                <option>Banner promocional</option>--}}
            {{--            </select>--}}
            {{--        </div>--}}
                </form>

</div>
