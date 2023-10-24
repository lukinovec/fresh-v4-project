<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Events\TestingEvent;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use App\Models\ResourceSyncing\CentralUser;

class Home extends Component
{
    use WithFileUploads;

    #[Rule('image')]
    public $photo;

    public $text = '';
    public $modelText = '';

    public int|null $userId = null;
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function getListeners()
    {
        if (tenant()) {
            $tenantPrefix = tenant()->getTenantKey() . '.';
        } else {
            $tenantPrefix = '';
        }

        $userId = $this->userId;

        return [
            "echo-private:{$tenantPrefix}users.$userId,TestingEvent" => 'updateText',
        ];
    }

    public function mount()
    {
        $user = null;
        auth()->login($user ??= User::first());

        $this->userId = $user?->id;


        $this->text = tenant()?->name ?? 'No name';
    }

    public function updateText()
    {
        $this->text = tenant()?->name ?? 'No name';
    }

    public function dispatchEvent()
    {
        broadcast(new TestingEvent($this->user, tenant()));
    }

    public function centralResource(): CentralUser|null
    {
        return CentralUser::firstWhere('global_id', 'acme') ?? CentralUser::create([
            'global_id' => 'acme',
            'name' => 'John Doe',
            'email' => 'john@localhost',
            'password' => 'secret',
            'role' => 'superadmin', // Unsynced
        ]);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
