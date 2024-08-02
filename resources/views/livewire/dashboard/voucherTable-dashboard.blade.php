<?php

use Illuminate\Support\Facades\Auth;
use FrittenKeeZ\Vouchers\Models\Redeemer;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component
{

    use WithPagination;

    protected $listeners = ['voucherRedeem' => '$refresh'];
    #[On('voucherRedeem')]
    public function render() : mixed{
        $redem = Redeemer::where('redeemer_id', Auth::id())->orderBy('created_at', 'desc')->with('voucher')->paginate('10');
        return view('livewire.dashboard.voucherTable-dashboard',[
                'vouchers' => $redem,
        ]);
    }

}
?>

<div class="overflow-auto">
    <div class="min-w-full inline-block align-middle">
        <div class="overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Redeem Date</th>
                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Voucher Code</th>
                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Service</th>

                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($vouchers as $voc)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-200"> @php
                            $timestamp = strtotime($voc->created_at);
                            $date_formatted = date("D, d M Y", $timestamp);
                            @endphp
                    {{ $date_formatted }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">{{ $voc->voucher->code }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">{{ $voc->voucher->metadata['credits'] }} Credits</td>

                    </tr>
                    @endforeach



                </tbody>
            </table>
            <div class="mt-4">
                {{ $vouchers->links() }} <!-- Pagination links -->
            </div>
        </div>
    </div>
</div>
