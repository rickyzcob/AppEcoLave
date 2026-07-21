<div>
    <div class="profile-card">

        <!-- Banner com avatar -->
        <div class="profile-banner">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar">
{{--                    <i class="fas fa-user"></i>--}}

                    @if (isset($profile_photo_path))
                        <img src="{{ $profile_photo_path->temporaryUrl() }}" class="rounded-full mx-auto d-block w-96">
                    @elseif(auth()->user()->profile_photo_path == null)
                        <img src="{{ url('admin/images/user-default.png') }}" class="rounded-full mx-auto d-block" alt="Sem Imagem" >
                    @else
                        <img src="{{ url('storage/'.auth()->user()->profile_photo_path) }}" class="rounded-full mx-auto d-block w-96" alt="Usuario" >
                    @endif

                </div>
            </div>
        </div>

        <div class="profile-body">

            <div class="profile-name">{{$response->profile['name']}}</div>

            <div class="profile-meta">{{$response->profile['email']}} · Cliente desde {{monthYear($response->profile['created_at'])}}</div>

            <form wire:submit="save">

                <div class="grid grid-cols-12 gap-4 items-start">
                    <div class="md:col-span-6 col-span-12 form-group">
                        <label class="form-label" for="foto_perfil">
                            <i class="fas fa-image"></i> Foto do Perfil
                        </label>
                        <input type="file" wire:model.live="profile_photo_path" class="form-control" accept="image/*">
                    </div>

                    <!-- Nome -->
                    <div class="md:col-span-6 col-span-12 form-group">
                        <label class="form-label" for="nome_completo">
                            <i class="fas fa-user"></i> Nome Completo
                        </label>
                        <input type="text" wire:model="state.name" class="form-control" value="Carlos Eduardo Silva">
                        @error('name')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-6 col-span-12 form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope"></i> E-mail
                        </label>
                        <input type="email" wire:model="state.email" class="form-control">
                        @error('email')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- CPF -->
                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="cpf">
                            <i class="fas fa-id-card"></i> CPF
                        </label>
                        <input type="text" x-mask="999.999.999-99" wire:model="state.taxpayer_registration" class="form-control" >
                        @error('taxpayer_registration')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="telefone">
                            <i class="fas fa-phone"></i> Telefone
                        </label>
                        <input type="tel" x-mask="(99) 9 9999-9999" wire:model="state.phone" class="form-control" >
                        @error('phone')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-2 col-span-12 form-group">
                        <label class="form-label" for="cep">
                            <i class="fas fa-map-marker-alt"></i> Cep
                        </label>
                        <input type="text" x-mask="99999-999" wire:model="state.zip_code" class="form-control" >
                        @error('zip_code')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-1 col-span-12 form-group pt-8">
                        <button wire:click.prevent="getAddress" class="btn btn-primary" style="flex:1;">
                            <i class="fas fa-magnifying-glass"></i>
                        </button>
                    </div>

                    <div class="md:col-span-5 col-span-12 form-group">
                        <label class="form-label" for="endereco">
                            <i class="fas fa-map-marker-alt"></i> Endereço
                        </label>
                        <input type="text" wire:model="state.address" class="form-control" value="Rua das Flores, 123, Apto 45">
                        @error('address')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-1 col-span-12 form-group">
                        <label class="form-label" for="numero">
                            <i class="fas fa-map-marker-alt"></i> Numero
                        </label>
                        <input type="text" wire:model="state.number" class="form-control" value="Rua das Flores, 123, Apto 45">
                        @error('number')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="complemento">
                            <i class="fas fa-map-marker-alt"></i> Complemento
                        </label>
                        <input type="text" wire:model="state.complement" class="form-control">
                        @error('complement')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="bairro">
                            <i class="fas fa-map-marker-alt"></i> Bairro
                        </label>
                        <input type="text" wire:model="state.neighborhood" class="form-control">
                        @error('neighborhood')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="cidade">
                            <i class="fas fa-city"></i> Cidade
                        </label>
                        <input type="text" wire:model="state.city" class="form-control" >
                        @error('city')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="md:col-span-3 col-span-12 form-group">
                        <label class="form-label" for="estado">
                            <i class="fas fa-city"></i> Estado
                        </label>
                        <input type="text" wire:model="state.uf" class="form-control" >
                        @error('uf')
                        <div class="form_error_message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-group-full">
                        <div class="profile-btn-row">
                            <button type="submit" class="btn btn-primary" style="flex:1;">
                                <i class="fas fa-save"></i> Salvar Alterações
                            </button>
                            <button type="button" wire:click="openCentralModal('client.my-profile.password.form', {'id': null})" class="btn btn-outline">
                                <i class="fas fa-key"></i> Alterar Senha
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
