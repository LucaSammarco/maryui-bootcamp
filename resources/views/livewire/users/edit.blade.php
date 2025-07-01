<?php

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;
use App\Models\Country;
use Livewire\WithFileUploads;
use App\Models\Language;
use Livewire\Attributes\Rule;



new class extends Component {


    use Toast, WithFileUploads;

    public User $user;

    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('sometimes')]
    public ?int $country_id = null;

    #[Rule('nullable|image|max:1024')]
    public $photo;

    #[Rule('sometimes')]
    public ?string $bio = null;

    public array $my_languages = [];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->fill($user);
        $this->my_languages = $user->languages->pluck('id')->all();
    }

   public function save(): void
{
    // Validate
    $data = $this->validate();

    // Update
    $this->user->update($data);

    // Upload file and save the avatar `url` on User model
    if ($this->photo) {
        $url = $this->photo->store('users', 'public');
        $this->user->update(['avatar' => "/storage/$url"]);
    }


    // You can toast and redirect to any route
    $this->success('User updated with success.', redirectTo: '/users');
}

    public function with(): array
    {
        return [
            'countries' => Country::all(),
            'languages' => Language::all(),
        ];
    }
};
?>


<div>
    <x-header title="Update {{ $user->name }}" separator />

    <x-form wire:submit="save">
        {{--  Basic section  --}}
        <div class="lg:grid grid-cols-5">
            <div class="col-span-2">
                <x-header title="Basic" subtitle="Basic info from user" size="text-lg" />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-file label="Avatar" wire:model="photo" accept="image/png, image/jpeg" crop-after-change>
                    <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-36 rounded-lg" />
                </x-file>
                <x-input label="Name" wire:model="name" />
                <x-input label="Email" wire:model="email" />
                <x-select label="Country" wire:model="country_id" :options="$countries" placeholder="---" />
            </div>
        </div>

        {{--  Details section  --}}
        <hr class="my-5 border-base-300" />
        <div class="lg:grid grid-cols-5">
            <div class="col-span-2">
                <x-header title="Details" subtitle="More about the user" size="text-lg" />
            </div>
            <div class="col-span-3 grid gap-3">
                <x-input label="Bio" wire:model="bio" />
                <x-select label="Languages" wire:model="my_languages" :options="$languages" multiple placeholder="---" />
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" link="/users" />
            {{-- The important thing here is `type="submit"` --}}
            {{-- The spinner property is nice! --}}
            <x-button label="Save" icon="o-paper-airplane" spinner="save" type="submit" class="btn-primary" />
        </x-slot:actions>
    </x-form>
</div>
