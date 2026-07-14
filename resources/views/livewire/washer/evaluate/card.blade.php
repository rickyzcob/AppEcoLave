<div>
    <div class="panel">
        <div class="panel-head">
            <h2>Avaliações recebidas</h2>
        </div>

        <div class="list">
            @foreach($response->evaluates as $itemEvaluate)
{{--                @dd($itemEvaluate);--}}
                <div class="bg-blue-50 p-3 rounded-md">
                    <div class="flex flex-col gap-1">
                        <strong> {{$itemEvaluate['user']['name'] ?? ''}}</strong>
                        <span class="text-xs text-gray-500"> {{$itemEvaluate['comment']}}</span>
                    </div>

                    <div class="percent">
                    @for ($i = 1; $i <= $itemEvaluate['rate']; $i++)
                        ★
                    @endfor
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
