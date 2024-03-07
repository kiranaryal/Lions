<div>
    <x-profile-form  submit="store" >


        <x-slot name="form">
            <div class="col-span-12 md:grid md:grid-cols-12 gap-10 ">

                <div class="col-span-6 flex items-center justify-center bg-gray-200 rounded-3xl shadow-lg">
                    {{-- <img src="{{ asset('images/team-01.png') }}" alt="" class="mx-auto object-cover h-96"> --}}
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
                            <img src="{{ $this->photo }}" class="mx-auto object-cover h-96 object-cover">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview" style="display: none;">
                            <span class="block mx-auto h-96 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        <x-input-error for="photo" class="mt-2" />

                        @if(auth()->id() == $id)
                        <div class=" ">
                            <x-secondary-button class="mt-2 me-2 text-center mx-10" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-secondary-button>
                        </div>

                        @endif
                    </div>

                </div>
                    <div class="col-span-6 ">
                        <div class="bg-white rounded-3xl m-5 shadow-lg">
                            <div class="col-span-12 ">
                                <input id="full_name" type="text"
                                    class="
                         my-1 block w-full px-3 bg-white text-center font-bold
                        border-none rounded-3xl
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                        "
                                    wire:model.defer="full_name" required autocomplete="full_name"
                                    placeholder="Full Name" @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="full_name" class="mt-2" />
                            </div>
                            <div class="col-span-12 ">
                                <input id="position" type="text"
                                    class="my-1 block w-full px-3  bg-white text-center font-bold
                        border-none rounded-3xl
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="position" required autocomplete="position"
                                    placeholder="Position"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="position" class="mt-2" />
                            </div>

                        </div>
                        <div class="bg-white rounded-3xl m-5 shadow-lg">

                            <div class="col-span-12 flex items-center px-2 ">
                                <x-label for="home_club" value="{{ __('Home Club :') }}"
                                    class="text-lg font-bold text-gray-400  whitespace-nowrap" />
                                <input id="home_club" type="text"
                                    class="my-1 py-1 bg-white  font-bold
                    border-none rounded-lg w-full flex-shrink shrink
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="home_club" required autocomplete="home_club"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="home_club" class="mt-2" />
                            </div>
                            <div class="col-span-12 flex items-center px-2 ">
                                <x-label for="public_email" value="{{ __('Public Email :') }}"
                                    class="text-lg font-bold text-gray-400  whitespace-nowrap " />

                                <input id="public_email" type="email"
                                    class="   my-1 block  px-3 py-1 bg-white  font-bold
                    border-none rounded-lg w-full
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="public_email" required autocomplete="public_email"  @if(auth()->id() != $id) disabled @endif />
                                <x-input-error for="public_email" class="mt-2" />
                            </div>
                            <div class="col-span-12 flex items-center px-2 ">
                                <x-label for="public_phone" value="{{ __('Public Phone :') }}"
                                    class="text-lg font-bold text-gray-400  whitespace-nowrap " />

                                <input id="public_phone" type="text"
                                    class="   my-1 block  px-3 py-1 bg-white  font-bold
                    border-none rounded-lg w-full
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="public_phone" required autocomplete="public_phone"  @if(auth()->id() != $id) disabled @endif/>
                                <x-input-error for="public_phone" class="mt-2" />
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl grid grid-cols-4 m-5 shadow-xl">
                            <div class="col-span-1 flex items-center justify-center">
                                <img src="{{ asset('images/nepal.png') }}" alt="" class=" mx-auto p-4">
                            </div>
                            <div class="col-span-3">
                                <div class="col-span-12 ">
                                    <input id="address" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white  font-bold
                    border-none rounded-lg
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                        wire:model.defer="address" required autocomplete="address"
                                        placeholder="Address"  @if(auth()->id() != $id) disabled @endif />
                                    <x-input-error for="address" class="mt-2" />
                                </div>
                                <div class="col-span-12 ">
                                    <input id="city" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white  font-bold
                    border-none rounded-lg
                    focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                    focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                        wire:model.defer="city" required autocomplete="city" placeholder="City"  @if(auth()->id() != $id) disabled @endif/>
                                    <x-input-error for="city" class="mt-2" />
                                </div>
                                <div class="col-span-12 ">
                                    <input id="nationality" type="text"
                                        class="   my-1 block w-full px-3 py-1 bg-white  font-bold
                        border-none rounded-lg
                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                        wire:model.defer="nationality" required autocomplete="nationality"
                                        placeholder="Nationality"  @if(auth()->id() != $id) disabled @endif />
                                    <x-input-error for="nationality" class="mt-2" />
                                </div>
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
    </x-profile-form>
</div>
