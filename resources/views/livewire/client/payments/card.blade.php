<div>
    @if($payment_method === 'credit')
        <livewire:client.payments.credit.form :reference="$reference"/>
    @endif

    @if($payment_method === 'pix')
        <livewire:client.payments.pix.form :reference="$reference"/>
    @endif
</div>
