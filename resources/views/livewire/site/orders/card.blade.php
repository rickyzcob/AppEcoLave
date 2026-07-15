<div>
    <div class="cards-order min-h-screen">
        @forelse($response->orders as $itemOrder)
            <div class="card-order">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="md:col-span-4 col-span-12">
                        <div class="flex items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" height="65px" viewBox="0 -960 960 960" width="65px" fill="#CCCCCC"><path d="M441.5-786.5Q424-804 424-828q0-19 13.5-39.5T483-920q32 32 45.5 52.5T542-828q0 24-17.5 41.5T483-769q-24 0-41.5-17.5Zm-211 0Q213-804 213-828q0-19 13.5-39.5T272-920q32 32 45.5 52.5T331-828q0 24-17.5 41.5T272-769q-24 0-41.5-17.5Zm420 0Q633-804 633-828q0-19 13.5-39.5T692-920q32 32 45.5 52.5T751-828q0 24-17.5 41.5T692-769q-24 0-41.5-17.5ZM200-124v54q0 13-8.5 21.5T170-40h-20q-13 0-21.5-8.5T120-70v-324l85-256q3-14 15.5-22t27.5-8h464q15 0 27.5 8t15.5 22l85 256v324q0 13-8.5 21.5T810-40h-21q-13 0-21.5-8.5T759-70v-54H200Zm3-330h554l-55-166H258l-55 166Zm-23 60v210-210Zm106 160q23 0 38.5-15.5T340-288q0-23-15.5-39.5T286-344q-23 0-39.5 16.5T230-288q0 23 16.5 38.5T286-234Zm389 0q23 0 39.5-15.5T731-288q0-23-16.5-39.5T675-344q-23 0-38.5 16.5T621-288q0 23 15.5 38.5T675-234Zm-495 50h600v-210H180v210Z"/></svg>
                            </div>
                            <div class="ml-2">
                                <h2 class="font-bold">{{$itemOrder['service']['name']}}</h2>
                                <p class="">{{$itemOrder['vehicle']}} - {{$itemOrder['vehicle_plate']}}</p>
                                <x-badge  text="{{$itemOrder['statusLabel']}}"  color="{{$itemOrder['statusColor']}}" xs/>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-5 col-span-12">
                        <div class="flex justify-start">
                            <div class="ml-2 text-center md:text-left">
                                <p class="">{{$itemOrder['service']['description']}}</p>
                                <p class="">{{$itemOrder['street']}}, {{$itemOrder['number']}} - {{$itemOrder['neighborhood']}} - {{$itemOrder['city']}} - {{$itemOrder['uf']}}
                                </p>
{{--                                <h3 class="font-bold">{{$itemOrder['vehicle']}}</h3>--}}


                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 col-span-12">
                        <div class="flex flex-col justify-end">
                            <div class="text-right">
                                <span class="preco text-md">{{formatMoney($itemOrder['service']['price'])}}</span>

                            </div>

                            <div class="text-right mt-0">


                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1 col-span-12">
                        <div class="flex flex-row justify-end">
                            <div class="p-3">
                                @if($itemOrder['status'] === 'waiting')
                                   <button class="cursor-pointer rounded-full bg-red-100 p-3 w-12 h-12" wire:click="confirmDelete({ 'id' : {{$itemOrder['id']}} })">
                                       <span class="material-symbols-outlined text-8xl text-red-600">delete</span>
                                   </button>
                                @endif

                                @if($itemOrder['status'] === 'service_finish' && $itemOrder['rate'] === null )
                                    <button class="cursor-pointer rounded-full bg-blue-100 p-3 w-12 h-12" wire:click="openCentralModal('site.orders.evaluate.form', {'id': {{$itemOrder['id']}} })">
                                        <span class="material-symbols-outlined text-8xl text-blue-600">star_rate</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @empty

            <div class="card-order">
                <div class="flex flex-col items-center justify-center gap-4">
                <h3>Sem pedidos</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#CCCCCC"><path d="M200-204v54q0 12.75-8.62 21.37Q182.75-120 170-120h-20q-12.75 0-21.37-8.63Q120-137.25 120-150v-324l85-256q5-14 16.5-22t26.5-8h464q15 0 26.5 8t16.5 22l85 256v324q0 12.75-8.62 21.37Q822.75-120 810-120h-21q-13 0-21-8.63-8-8.62-8-21.37v-54H200Zm3-330h554l-55-166H258l-55 166Zm-23 60v210-210Zm105.76 160q23.24 0 38.74-15.75Q340-345.5 340-368q0-23.33-15.75-39.67Q308.5-424 286-424q-23.33 0-39.67 16.26Q230-391.47 230-368.24q0 23.24 16.26 38.74 16.27 15.5 39.5 15.5ZM675-314q23.33 0 39.67-15.75Q731-345.5 731-368q0-23.33-16.26-39.67Q698.47-424 675.24-424q-23.24 0-38.74 16.26-15.5 16.27-15.5 39.5 0 23.24 15.75 38.74Q652.5-314 675-314Zm-495 50h600v-210H180v210Z"/></svg>           <p>Clique abaixo e venha conheçer nossos serviços de qualidade !</p>
                    <a href="{{route('schedule')}}" class="btn">Agendar Lavagem</a>
                </div>
            </div>

        @endforelse

    </div>

    <div class="mt-5">
        {{ $response->orders->links() }}

    </div>

</div>
