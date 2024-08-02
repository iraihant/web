<?php
use Illuminate\Support\Facades\Auth;
use FrittenKeeZ\Vouchers\Facades\Vouchers;
use FrittenKeeZ\Vouchers\Models\Voucher;
use FrittenKeeZ\Vouchers\Models\Redeemer;
use Livewire\Volt\Component;

new class extends Component
{
    public $voucher;

    protected $rules = [
        'voucher' => 'required',
    ];
    public function redeemVoucher(){
        $this->validate();
        $voc = Voucher::where('code', $this->voucher)->firstOrFail();
        try {
            Vouchers::redeem($this->voucher, Auth::user(), $voc->metadata);
            $user = Auth::user();
            $user->balance +=  $voc->metadata['credits'];
            $user->save();
            $this->dispatch('voucherRedeem');
            session()->flash('success', "Successfully redeem the voucher, ".$voc->metadata['credits']." credits are added to your balance!");
            $this->reset('voucher');
        } catch (\Exception $e) {
            session()->flash('error', "Failed to redeem the voucher, please check the voucher code again!");

        }

    }

}
?>

<div class="mt-5">
    @if(session('success'))
    <div class="bg-success/10 text-success   border border-success/20 text-sm rounded-md py-3 px-5" role="alert">
        <span class="font-bold">Success</span> - {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="bg-danger/10 text-danger border border-danger/20 text-sm rounded-md py-3 px-5" role="alert">
        <span class="font-bold">Error</span> - {{ session('error') }}
    </div>
    @endif
    <x-input-error :messages="$errors->all()" class="mt-2" />
    <form wire:submit='redeemVoucher' class="mt-2">
        <div class="flex flex-col">
            <div class="mb-5">
                <input type="text" class="form-input" placeholder="IDCHK-XXXX-XXXX-XXXX" wire:model='voucher'>
            </div>
            <div>
                <button type="submit" class="btn bg-primary text-white "wire:loading.attr='disabled'>Submit</button>
            </div>
        </div>
    </form>
</div>
