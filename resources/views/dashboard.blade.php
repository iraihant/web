<x-app-layout>
    <x-title-menu :title="'Dashboard'" :subtitle="['Dashboard']"></x-title-menu>

    <div class="grid xl:grid-cols-2 lg:grid-cols-2 grid-cols-1 gap-6 mb-6">
        <div class="card">
            <div class="p-6">
                <h3 class="card-title">Time</h3>
                <div class="flex items-center">
                    <livewire:dashboard.time-dashboard />
                </div>
            </div>
            <!-- end p-6 -->
        </div>

        <div class="card">
            <div class="p-6">
                <h3 class="card-title">Redeem Voucher</h3>
                    <livewire:dashboard.voucherRedeem-dashboard />
            </div> <!-- end row-->
        </div> <!-- end p-6 -->
    </div> <!-- end card -->

    <div class="grid gap-6 mb-6">
        <div class="card">
            <div class="card-header flex justify-between items-center">
                <h4 class="card-title">History Vouchers</h4>
            </div>
            <div class="p-6">
                <livewire:dashboard.voucherTable-dashboard>
            </div>

        </div>
    </div>
</x-app-layout>
