<div class="relative">
    @if(auth()->id() == $id)

    <button class="absolute right-0 top-[-20px] border border-gray-300 px-2 py-1 rounded-lg shadow bg-green-500/60 font-bold"
    onclick="Livewire.dispatch('openModal', { component: 'profile.add-details', arguments: { user: {{ auth()->user()->id }} }})">
        Add Details
    </button>
    @endif
    <x-profile-form  submit="store" >

        <x-slot name="form">
            <div class="col-span-12 xl:grid xl:grid-cols-12 gap-10 ">

                <div class="col-span-6 flex items-center justify-center relative">
                    <div x-data="{ photoName: null, photoPreview: null }" class="">
                        <!-- Profile Photo File Input -->
                        <input type="file" id="photo" class="hidden"  x-ref="photo"  wire:model.live="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                        <!-- Current Profile Photo -->
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $this->photo =='/storage/' ? $this->profile->user->profile_photo_url: $this->photo }}" class="mx-auto object-cover h-96 rounded-3xl shadow-lg ">
                        </div>
                        <x-input-error for="photo" class="mt-2 " />

                        @if(auth()->id() == $id)
                            <div class="absolute top-10 right-2 bg-opaque hover:cursor-pointer	 bg-blur" type="button" x-on:click.prevent="$refs.photo.click()">
                                <i class="fa-solid fa-photo-film fa-2xl" style="color:red"></i>
                            </div>

                        @endif
                    </div>

                </div>
                    <div class="col-span-6 ">
                        <div class="bg-white rounded-3xl m-5 shadow-lg">
                            <div class="col-span-12  flex items-center px-3">
                                <i class="fa-solid fa-user"></i>
                                <input id="full_name" type="text"
                                    class="
                         mb-1 block w-full px-3 bg-white text-center font-bold text-xl
                        border-none rounded-3xl
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                        "
                                    wire:model.defer="full_name" required autocomplete="full_name"
                                    placeholder="Full Name" @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="full_name" class="mt-2" />
                            </div>
                            <div class="col-span-12 flex items-center  ">
                                <input id="position" type="text"
                                    class=" block w-full px-3  bg-white text-center
                        border-none rounded-3xl font-bold
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="position" required autocomplete="position"
                                    placeholder="Position"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="position" class="mt-2" />
                            </div>

                        </div>
                        <div class="bg-white rounded-3xl m-5 shadow-lg">

                            <div class="col-span-12 flex items-center px-2 flex px-3 ">
                                <i class="fa-solid fa-house-flag"></i>
                                <input id="home_club" type="text"
                                    class="my-1 py-1 bg-white  font-bold
                                            border-none rounded-lg w-full flex-shrink shrink
                                            focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                            focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                            placeholder="Home Club"
                                    wire:model.defer="home_club" required autocomplete="home_club"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="home_club" class="mt-2" />
                            </div>
                            <div class="col-span-12 flex items-center px-2 flex items-center px-3">

                                <i class="fa-solid fa-at"></i>
                                <input id="public_email" type="email"
                                    class="   my-1 block  px-3 py-1 bg-white  font-bold
                    border-none rounded-lg w-full
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                    placeholder="Email"
                                    wire:model.defer="public_email" required autocomplete="public_email"  @if(auth()->id() != $id) disabled @endif />
                                <x-input-error for="public_email" class="mt-2" />
                            </div>
                            <div class="col-span-12 flex items-center px-2 flex px-3 items-center">
                                <i class="fa-solid fa-phone-volume"></i>

                                <input id="public_phone" type="text"
                                    class="   my-1 block  px-3 py-1 bg-white  font-bold
                    border-none rounded-lg w-full
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                    placeholder="Phone"
                                    wire:model.defer="public_phone" required autocomplete="public_phone"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="public_phone" class="mt-2" />
                            </div>
                        </div>

                        <div class=" rounded-3xl m-5 shadow-lg m-5 bg-white py-3">
                                <div class="col-span-12  flex items-center px-3">
                                    <i class="fa-solid fa-address-book"></i>

                                    <input id="address" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white
                    border-none rounded-lg capitalize font-bold
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                        wire:model.defer="address" required autocomplete="address"
                                        placeholder="Address"  @if(auth()->id() != $id) disabled @endif />
                                    <x-input-error for="address" class="mt-2" />
                                </div>
                                <div class="col-span-12 flex items-center px-3">
                                    <i class="fa-solid fa-city"></i>

                                    <input id="city" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white
                    border-none rounded-lg capitalize font-bold
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                        wire:model.defer="city" required autocomplete="city" placeholder="City"  @if(auth()->id() != $id) disabled @endif/>
                                    <x-input-error for="city" class="mt-2" />
                                </div>
                                <div class="col-span-12 flex items-center px-3">
                                    <i class="fa-solid fa-flag"></i>
                                    <input id="nationality" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white
                        border-none rounded-lg font-bold
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300 capitalize"
                                        wire:model.defer="nationality" required autocomplete="nationality"
                                        placeholder="Nationality"  @if(auth()->id() != $id) disabled @endif />
                                    <x-input-error for="nationality" class="mt-2" />
                                </div>
                        </div>

                    </div>
                    <div class="col-span-12 ">
                        <x-label for="about" class=" text-center text-xl" value="{{ __('About') }}" />
                        <textarea id="about" type="textarea" class=" w-full  border border-gray-300 rounded-lg text-center"
                            wire:model.defer="about" required autocomplete="about" placeholder="......"  @if(auth()->id() != $id) disabled @endif></textarea>
                        <x-input-error for="about" class="mt-2" />
                    </div>
                </div>



        </x-slot>
            @if(auth()->id() == $id)
            <x-slot name="actions">
                <x-action-message on="store">
                    {{ __('Profile information saved.') }}
                </x-action-message>

                <x-button>
                    {{ __('Save') }}
                </x-button>
            </x-slot>
            @endif
            <x-slot name="details">
                @livewire('profile-form-details')
            </x-slot>





    </x-profile-form>

</div>
