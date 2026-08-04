<div>
    <x-loading loading="save" />

    <div class="section-header">
        <div>
            <div class="section-title">
                <i class="fas fa-calendar-plus"></i>
                Pagamento via Pix
            </div>
            <div class="section-subtitle">Faça o pagamento lendo o QR-Code abaixo ou siga as instruções</div>
        </div>
    </div>

    @if(isset($response->qrcode['status']) && $response->qrcode['status'] === 'error')

        <x-alert color="orange" title="Erro!">
            <p>{{$response->qrcode['message']}}</p>
            <p>Por Favor atualize seus dados e tente novamente !</p>
            <x-slot:footer>
                <div class="flex justify-end">
                    <x-button href="{{route('client.my-profile')}}" text="Meu-Perfil" color="white" />
                </div>
            </x-slot:footer>
        </x-alert>

    @else
        <div class="grid grid-cols-12 gap-4" wire:poll >
            <div class="md:col-span-8 col-span-12">
                <div class="form-card ">
                    @if($response->order['status'] === 'waiting')
                        <div class="flex flex-col items-center justify-center w-full">

                            {{--                    @dd( $response->qrcode);--}}
                            <div>
                                <img src="data:image/png;base64, {{ $response->qrcode['encodedImage']  }}" alt="QrCode" class="w-96">
                            </div>

                            <div class="">
                                <x-clipboard label="Chave" hint="Clique para copiar o codigo pix" text="{{$response->qrcode['payload']}}" />
                            </div>


                            <div>
                                <div class="py-5">
                                    <p class="text-sm">{{$response->qrcode['description'] }}</p>
                                </div>
                            </div>

                            <div>
                                <div class="px-2">
                                    <h1 class="text-base">Instruções de pagamento com ID:</h1>
                                    <p class="text-sm">1. Copie o ID da transação</p>
                                    <p class="text-sm">2. Use o ID para identificar seu pagamento PIX no aplicativo do seu banco</p>
                                    <p class="text-sm">3. Assim que o pagamento for identificado você receberá um e-email !</p>
                                    <p class="text-sm">4. Valido até : {{formatDateAndTime($response->qrcode['expirationDate']) }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center w-full gap-5 p-8">
{{--                            <div>--}}
{{--                                <div class="py-5">--}}

                                    <h1 class="text-xl font-bold">Obrigado!</h1>
                                    <span class="text-8xl">
                                        😊
                                        {{--                    <span class="vehicle-image-badge">Principal</span>--}}
                                    </span>
                                    <p class="text-sm">Pagamento Recebido com sucesso, aguarde a confirmação do profissional !</p>
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-4 col-span-12">
                <div class="vehicle-card">
                    <div class="vehicle-image">
                        🚗
                        {{--                    <span class="vehicle-image-badge">Principal</span>--}}
                    </div>
                    <div class="flex flex-col items-center justify-center py-4">
                        <div class="vehicle-brand">{{$response->order['vehicle']['brand']}}</div>
                        <div class="vehicle-model">{{$response->order['vehicle']['name']}}</div>
                        <div class="vehicle-plate">{{$response->order['vehicle']['plate']}}</div>

                        <div class="section-title">
                            <h1> {{$response->order['service']['name']}} </h1>
                        </div>
                        <div class="section-title">
                            <h1 class="text-cyan-700"> {{formatMoney($response->order['service']['price'])}} </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
