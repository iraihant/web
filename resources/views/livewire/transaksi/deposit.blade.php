<?php

use App\Models\Service;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
new class extends Component
{
    public $services;
    public $selectedService = null;
    public $price = null;

    public $service;
    public $paymentMethod;

    protected $rules = [
        'selectedService' => 'required|exists:service,id',
        'paymentMethod' => 'required'
    ];

    public function mount(): void
    {
        $this->services = Service::where('status', 'active')->orderBy('service_name')->get();
    }

    public function updatedSelectedService($serviceId)
    {
        // Ketika service dipilih, ambil harga dari database
        $service = Service::find($serviceId);
        $this->price = $service ? $service->price : null;
    }


    public function SubmitTrans(){
        $this->validate();
        $Ser = Service::find($this->selectedService);

        $clo = now();
        $clo = str_replace('-',"",$clo);
        $clo2 =  explode(' ',$clo);
        $clo3 =  explode(':',$clo2[1]);
        $cloc = substr($clo2[0], 2);

        $characters = '23456';
        $token = '';

        for ($i = 0; $i < 2; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }

        $idtrans = 'TRX-IDCHK'.$cloc.$clo3[2].rand(11, 99).rand(11, 99);


        $transaksi = new Transaction;
        $transaksi->transactions_id = $idtrans;
        $transaksi->user_id = Auth::id();
        $transaksi->service_id = $Ser->id;
        $transaksi->payment_method = $this->paymentMethod;
        $transaksi->total_amount = (int)$Ser->price + (int)$token;
        $transaksi->save();

        $this->reset(['selectedService', 'paymentMethod', 'price']);

        $this->redirect(route('trans_payment', $transaksi->transactions_id), navigate: true);
    }


}
?>

<div class="flex flex-col lg:flex-row md:flex-row gap-4">
    <div class="w-full lg:w-2/4 md:w-2/4">
        <div class="card mt-4">
            <div class="p-6">
                <x-input-error :messages="$errors->all()" class="mt-2" />
                <h3 class="card-title">Deposit</h3>
                <div class="pt-5">
                    <span class="py-2 px-2 bg-info text-white rounded">
                        Your Credit : {{ Auth::user()->balance }}
                    </span>
                    <form wire:submit='SubmitTrans' class="mt-3">
                        <div class="mb-3">
                            <label for="service" class="mb-2">Service</label>
                            <select class="form-select" id="service" name="service" wire:model.change="selectedService" wire.model='service'>
                                <option value="" selected>-- SELECT SERVICE --</option>
                                @foreach ($services as $s)
                                    <option value="{{ $s->id }}">{{ $s->service_name }} Credit</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="mb-2">Price</label>
                            <span class="block text-lg px-5">Rp {{ number_format($price, 0, ',', '.') }}</span>

                        </div>
                        <div class="mb-3">
                            <label for="payment" class="col-md-3 col-form-label">Payment</label>
                            <div class="flex flex-col md:flex-row lg:flex-row mt-2">
                                <div>
                                    <input type="checkbox" class="hidden peer" id="pay" name="paymentMethod" wire:model='paymentMethod' value="1">
                                    <label for="pay" class="transition ease-in-out text-center text-gray-500 border border-gray-300 hover:bg-gray-300 rounded px-4 py-4 peer-checked:bg-blue-500 peer-checked:border-sky-400 peer-checked:text-white"><i class="ri-money-dollar-box-line mb-1 block text-lg "></i>
                                        QRIS</label>
                                </div>
                                {{-- <div class="w-1/6">
                                    <label class="block" for="payment1">
                                        <input type="radio" name="paymethod" class="hidden peer" value="1" id="payment1">
                                        <span class="card-radio py-3 text-center text-truncate text-uppercase peer-checked:border-[#1f58c7]">
                                            <i class="ri-money-dollar-box-line block mb-3"></i>
                                            QRIS
                                        </span>
                                    </label>
                                </div> --}}
                            </div>

                        </div>
                        <button type="submit" class="btn bg-primary text-white w-full" wire:loading.attr='disabled'>Deposit Now</button> <!-- end button -->
                    </form> <!-- end form -->
                </div>
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
