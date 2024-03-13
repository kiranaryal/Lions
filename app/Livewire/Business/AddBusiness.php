<?php

namespace App\Livewire\Business;

use App\Models\User;
use App\Models\BusinessProfile;

use Livewire\WithFileUploads;
use App\Models\ProfileExtra;

use LivewireUI\Modal\ModalComponent;
class AddBusiness extends ModalComponent
{
    use WithFileUploads;
    public $org_name;
    public $logo;
    public $photo;
    public $address;
    public $city;
    public $email;
    public $phone;
    public $website;
    public $facebook;
    public $instagram;
    public $linkedin;
    public $about;
    public $services;





    public int $user;
    public static function closeModalOnClickAway(): bool
{
    return false;
}

public function store()
{
        $data =  $this->validate([
            'org_name' => 'required',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'about' => 'nullable|string',
            'services' => 'nullable|string',

            'photo'=>'nullable|image',
            'logo'=>'nullable|image',
        ]);
        $business = BusinessProfile::create([
            'user_id'=>auth()->id(),
            'org_name' => $this->org_name,
            'address' => $this->address,
            'city' => $this->city,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'services' => $this->services,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'about' => $this->about,
        ]);
        if ($this->photo) {
            $business->updatePhoto($this->photo);
        }
        if ($this->logo) {
            $business->updateLogo($this->logo);
        }
        $this->closeModal();
        $this->js('window.location.reload()');


    }

    public function render()
    {
        return view('livewire.business.add-business');
    }
}
