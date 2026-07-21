    <div class="rating-card">
        <div style="font-size:14.5px; font-weight:700; color:var(--black); margin-bottom:18px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-chart-bar" style="color:var(--green-primary);"></i>
            Sua Reputação
        </div>
        <div class="rating-stats">
            <div style="text-align:center;">
                <div class="rating-big-number">{{roundDecimal($response->totals['average'])}}</div>
                <div class="rating-big-stars">★★★★★</div>
                <div class="rating-big-count">{{$response->totals['total']}} avaliaçõe(s)</div>
            </div>
            <div class="rating-bars">
            @foreach($response->reputations as $rate => $itemReputation)

                <div class="rating-bar-row">
                    <span class="rating-bar-label">{{$rate}} ★</span>
                    <div class="rating-bar-track"><div class="rating-bar-fill" style="width:{{$itemReputation}}%;"></div></div>
                    <span class="rating-bar-pct">{{$itemReputation}}%</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>


