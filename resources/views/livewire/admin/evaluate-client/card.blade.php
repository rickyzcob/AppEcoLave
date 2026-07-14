<div>
    <div class="panel">
        <div class="panel-head">
            <h2>Avaliar cliente</h2>
        </div>

        <form class="form-grid">
            <div class="input-group full">
                <label>Cliente</label>
                <select>
                    <option>Marcos Silva</option>
                    <option>Ana Paula</option>
                    <option>Rafael Costa</option>
                </select>
            </div>

            <div class="input-group full">
                <label>Avaliação por estrelas</label>
                <div class="rating">★★★★★</div>
            </div>

            <div class="input-group full">
                <label>Comentário descritivo</label>
                <textarea placeholder="Escreva sua avaliação sobre o cliente"></textarea>
            </div>

            <button type="button" class="btn full" onclick="toast('Avaliação enviada')">Enviar avaliação</button>
        </form>
    </div>
</div>
