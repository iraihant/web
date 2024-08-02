<?php
use Livewire\Volt\Component;

new class extends Component
{
    public $time;
    public $date;

    public function mount()
    {
        $this->updateTime();
        $this->updateDate();
    }

    public function updateTime()
    {
        $this->time = now()->toTimeString();
    }

    public function updateDate()
    {
        $this->date = now()->format('j F Y');
    }

    public function refreshTime()
    {
        $this->updateTime();
        $this->updateDate();
    }

}
?>

<div wire:poll.1s="refreshTime" class="mx-auto">
    <h1 class="text-5xl my-3 py-0.5 text-center">{{ $time }}</h1>
    <h1 class="text-lg my-3 py-0.5 text-center">{{ $date }}</h1>
</div>
