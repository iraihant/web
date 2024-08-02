<?php

use App\Models\Service;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
new class extends Component
{
    public $trx_id;
    public function mount()
    {
        // Mengambil trx_id dari request
        $this->trx_id = request()->route('trx_id');
        $transaksiCheck = Transaction::where('transactions_id', $this->trx_id)->exists();
        if(!$transaksiCheck){
            abort(404);
        }
    }
}
?>

<div class="flex flex-col lg:flex-row md:flex-row gap-4">
    <div class="w-full lg:w-2/4 md:w-2/4">
        <div class="card mt-4">
            <div class="p-6">
{{ $trx_id }}
            </div>
        </div>
    </div>
    <div class="w-full lg:w-2/4 md:w-2/4">
        <div class="card mt-4">
            <div class="p-6">
                <h3 class="card-title"></h3>
                <h4 class="text-center text-muted text-bold text-uppercase text-lg mb-2"> How to Top Up Credits ?</h4>
                <ol class="list-decimal list-inside" role="list">
                    <li>Choose credit amount.</li>
                    <li>Select the payment method (QRIS).</li>
                    <li>Click "Deposit Now."</li>
                    <li>Review the displayed transaction details.</li>
                    <li>Scan the QRIS and enter the correct amount.</li>
                    <li>Upload the payment proof.</li>
                    <li>Confirm the transaction.</li>
                    <li>Check the credit balance to ensure a successful top-up.</li>
                    <li>Save the transaction proof as a reference.</li>
                </ol>
            </div>
        </div>
    </div>
</div>
