<div>
    @if($payment_method === 'credit')
        <livewire:client.payments.credit.form/>
    @endif

    @if($payment_method === 'pix')
        <livewire:client.payments.credit.form/>
    @endif
</div>
