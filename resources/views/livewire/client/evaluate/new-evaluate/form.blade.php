<div class="rating-card">
    @if($response->evaluate)
        <div style="font-size:14.5px; font-weight:700; color:var(--black); margin-bottom:5px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-pen" style="color:var(--green-primary);"></i>
            Nova Avaliação
        </div>
        <div style="font-size:12.5px; color:var(--text-muted);">
            {{$response->evaluate['service']['name']}} -
            {{$response->evaluate['washer']['name']}} -
            {{$response->evaluate['date_schedule']}}
        </div>


        <div style="text-align:center; margin-top:20px;">
            <div style="font-size:12.5px; color:var(--text-secondary); margin-bottom:2px;">Toque para avaliar</div>
            <div class="stars-interactive">
                <x-rating wire:model="state.rate" color="yellow" lg />
            </div>
        </div>

        <form wire:submit="save" style="margin-top:14px;">
            <div class="form-group">
                <label class="form-label" for="comentario">
                    <i class="fas fa-comment"></i> Comentário
                </label>
                <textarea wire:model="state.comment" class="form-control" rows="4" placeholder="Conte como foi sua experiência com o serviço..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-full" style="margin-top:14px;">
                <i class="fas fa-paper-plane"></i> Enviar Avaliação
            </button>
        </form>
    @else
        <div style="font-size:14.5px; font-weight:700; color:var(--black); margin-bottom:5px; display:flex; align-items:center; gap:8px;">
            <i class="fas fa-pen" style="color:var(--green-primary);"></i>
            Sem Avalaliações
        </div>
        <div style="font-size:12.5px; color:var(--text-muted);">
            Voce nao tem nenhuma avaliação no momento ! aguarde o proximo serviço ser finalizado para fazer uma nova avaliação. Estamos anciosos!
        </div>
    @endif
</div>
