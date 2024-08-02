<?php
use App\Models\Service;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public $serviceItem;
    public $price;
    protected $rules = [
        'serviceItem' => 'required|numeric',
        'price' => 'required|numeric'
    ];
    public function submitService(){
        $this->validate();
        $serv = new Service();
        $serv->service_name = $this->serviceItem;
        $serv->price = $this->price;
        $serv->status = 'inactive';
        $serv->save();
        session()->flash('success', "Service Berhasil Di Buat, SIlahkan Aktifkan terlebih dahulu untuk di gunakan!");

        $this->reset(['serviceItem', 'price']);
    }

    public function ChangeService($data){
        $ser = Service::find($data);
        if($ser->status == "active"){
            $ser->status = "inactive";
            $ser->save();
            session()->flash('success', "Service Berhasil Di Nonaktifkan");
        }else{
            $ser->status = "active";
            $ser->save();
        session()->flash('success', "Service Berhasil Di Aktifkan");
        }


    }

    public function render(): mixed{
        $service = Service::orderBy('service_name', 'asc')->paginate(10);
        return view('livewire.admin.service-admin', [
            'service' => $service,
        ]);
    }


}
?>

<div class="flex flex-col gap-4">
    <div class="w-full lg:w-2/4 md:w-2/4">
        @if(session('success'))
        <div class="bg-success/10 text-success   border border-success/20 text-sm rounded-md py-3 px-5" role="alert">
            <span class="font-bold">Success</span> - {{ session('success') }}
        </div>
        @endif
        <x-input-error :messages="$errors->all()" class="mt-2" />

        <div class="card mt-4">
            <div class="p-6">
                <h3 class="card-title"> Create Service</h3>
                <div class="pt-5">
                    <form wire:submit='submitService'>
                        <div class="mb-3">
                            <label for="qty" class="mb-2">Service</label>
                            <input type="number" class="form-input" id="qty" wire:model='serviceItem'>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="mb-2">Price</label>
                            <input type="number" class="form-input" id="qty" wire:model='price'>
                        </div>
                        <button type="submit" class="btn bg-primary text-white" wire:loading.attr='disabled'>Submit</button> <!-- end button -->
                    </form> <!-- end form -->
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header flex justify-between items-center">
                <h4 class="card-title">Service List</h4>
            </div>
            <div class="p-6">
                <div class="overflow-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Service</th>
                                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Price</th>
                                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Status</th>
                                        <th scope="col" class="px-4 py-4 text-start text-sm font-medium text-gray-500">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                    @foreach ($service as $ser)

                                        <tr class="{{ ($ser->status == 'inactive') ? 'bg-danger/50 text-danger' : 'bg-success/50' }}">
                                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-500 dark:text-gray-200">{{$ser->service_name}}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-200">{{ $ser->price }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-sm uppercase {{ ($ser->status == 'inactive') ? ' text-danger' : 'text-success' }}">{{ $ser->status }}</td>
                                            <td class="px-4 py-4 whitespace-nowrap text-smdark:text-gray-200">
                                                <button  type="button" wire:click='ChangeService({{ $ser->id }})' class="btn {{ ($ser->status == "active") ?"bg-danger" : "bg-success"}} text-white rounded-full">

                                                    {{ ($ser->status == "active") ? "Deactivated" : "Activated" }}</button>

                                            </td>
                                        </tr>

                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
