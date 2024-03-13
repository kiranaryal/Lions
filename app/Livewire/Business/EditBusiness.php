<?php

namespace App\Livewire\Business;

use App\Models\User;
use App\Models\BusinessProfile;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Models\Category;

class EditBusiness extends ModalComponent
{
        use WithFileUploads;
        public $org_name;
        public $logo;
        public $oldphoto;
        public $oldlogo;
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
        public $business;
        public $selectedCategories;
        public $services;


        public int $id;
        public $category;
        public $businessCategory;

        public static function modalMaxWidth(): string
        {
            return '7xl';
        }
        public function mount(){

        $this->category = Category::get()->all();

        $this->business =$business = BusinessProfile::find($this->id);
        $this->org_name =$business->org_name  ;
        $this->logo=$business->logo;
        $this->oldlogo=$business->getLogo();

        $this->photo=$business->photo;
        $this->oldphoto=$business->getPhoto();

        $this->address= $business->address;
        $this->city = $business-> city;
        $this->email =$business->email;
        $this->phone =$business->phone;
        $this->website =$business->website;
        $this->facebook =$business->facebook;
        $this->services =$business->services;

        $this->instagram =$business->instagram;
        $this->linkedin =$business->linkedin;
        $this->about =$business->about;
        $this->businessCategory =$business->categories;

    }

    public function update()
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
                'photo'=>'nullable',
                'logo'=>'nullable',
            ]);
            $this->business->Update([
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
            if ($this->logo!= '/storage/' && $this->logo!=$this->business->logo) {
                $this->business->updateLogo($this->logo);
            }
            if ($this->photo!= '/storage/' && $this->photo!=$this->business->photo) {
                $this->business->updatePhoto($this->photo);
            }
            if($this->selectedCategories){
                $this->business->categories()->syncWithoutDetaching($this->selectedCategories);

            }

            $this->closeModal();
            $this->js('window.location.reload()');
        }
        public function delete($id){
            $this->business->categories()->detach($id);
            $this->render();
            $this->js('window.location.reload()');


        }
        public static function closeModalOnClickAway(): bool
        {
            return false;
        }


    public function render()
    {
        return view('livewire.business.edit-business');
    }
}
