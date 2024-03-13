<div>

    <!-- Your form content -->
    <x-profile-extra-form submit="store">


        <x-slot name="form">
            <div class="flex justify-end">
                <div wire:click="closeModal" class="text-right font-bold hover:cursor-pointer "> X</div>
            </div>

            <div class="col-span-12 gap-10 ">


                <div class=" ">
                    <div class="flex flex-col justify-center items-center">
                        <div class="grid grid-cols-12">


                            <div x-data="{ logoName: null, logoPreview: null }" class="col-span-6 ">
                                <!-- Profile logo File Input -->
                                <input type="file" id="logo" class="hidden" wire:model.live="logo"
                                    x-ref="logo"
                                    x-on:change="                logoName = $refs.logo.files[0].name;
                                                            const reader = new FileReader();
                                                            reader.onload = (e) => {
                                                                logoPreview = e.target.result;
                                                            };
                                                            reader.readAsDataURL($refs.logo.files[0]);
                                                    " />


                                <!-- Current  logo -->
                                <div class="mt-2 flex justify-center" x-show="! logoPreview">
                                    <img src="{{ $this->logo }}" alt=""
                                        class="rounded-full h-24 w-32 object-cover">
                                </div>

                                <!-- New  logo Preview -->
                                <div class="mt-2 flex justify-center" x-show="logoPreview" style="display: none;">
                                    <span class="block rounded-full w-32 h-24 bg-cover bg-no-repeat bg-center"
                                        x-bind:style="'background-image: url(\'' + logoPreview + '\');'">
                                    </span>
                                </div>

                                <div class="flex justify-center">

                                    <x-secondary-button class="mt-2 me-2" type="button"
                                        x-on:click.prevent="$refs.logo.click()">
                                        {{ __('New Logo') }}
                                    </x-secondary-button>
                                </div>

                            </div>
                            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ">
                                <!-- Profile Photo File Input -->
                                <input type="file" id="photo" class="hidden" wire:model.live="photo"
                                    x-ref="photo"
                                    x-on:change="                photoName = $refs.photo.files[0].name;
                                                        const reader = new FileReader();
                                                        reader.onload = (e) => {
                                                            photoPreview = e.target.result;
                                                        };
                                                        reader.readAsDataURL($refs.photo.files[0]);
                                                " />


                                <!-- Current  Photo -->
                                <div class="mt-2 flex justify-center" x-show="! photoPreview">
                                    <img src="{{ $this->photo }}" alt=""
                                        class="rounded-full h-24 w-32 object-cover">
                                </div>

                                <!-- New  Photo Preview -->
                                <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">
                                    <span class="block rounded-full w-32 h-24 bg-cover bg-no-repeat bg-center"
                                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>

                                <div class="flex justify-center">

                                    <x-secondary-button class="mt-2 me-2" type="button"
                                        x-on:click.prevent="$refs.photo.click()">
                                        {{ __('New Photo') }}
                                    </x-secondary-button>
                                </div>
                                <x-input-error for="photo" class="mt-2" />
                            </div>

                        </div>
                        <div class="w-full bg-white rounded-3xl my-5 shadow-lg">
                            <input id="org_name" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="org_name" required autocomplete="org_name"
                                placeholder="Name Of Organization" />
                            <x-input-error for="org_name" class="mt-2" />
                        </div>
                    <div class="grid grid-cols-2 gap-5 ">

                        <div class=" col-span-1 bg-white rounded-3xl  shadow-lg">
                            <input id="address" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="address"  autocomplete="address"
                                placeholder="Address" />
                            <x-input-error for="address" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl  shadow-lg">
                            <input id="city" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="city"  autocomplete="city"
                                placeholder="City" />
                            <x-input-error for="city" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl shadow-lg">
                            <input id="email" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="email"  autocomplete="email"
                                placeholder="Email" />
                            <x-input-error for="email" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl shadow-lg">
                            <input id="phone" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="phone"  autocomplete="phone"
                                placeholder="Phone" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl  shadow-lg">
                            <input id="website" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="website"  autocomplete="website"
                                placeholder="Website link" />
                            <x-input-error for="website" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl  shadow-lg">
                            <input id="facebook" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="facebook"  autocomplete="facebook"
                                placeholder="Facebook Link" />
                            <x-input-error for="facebook" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl shadow-lg">
                            <input id="instagram" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="instagram"  autocomplete="instagram"
                                placeholder="Instagram Link" />
                            <x-input-error for="instagram" class="mt-2" />
                        </div>
                        <div class="col-span-1 bg-white rounded-3xl  shadow-lg">
                            <input id="linkedin" type="text"
                                class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                wire:model.defer="linkedin"  autocomplete="linkedin"
                                placeholder="Linked Link" />
                            <x-input-error for="linkedin" class="mt-2" />
                        </div>
                    </div>

                        <div class="col-span-12 w-full ">
                            <x-label for="about" class=" text-center text-xl" value="{{ __('About') }}" />
                            <textarea id="about" type="textarea" class=" w-full  border border-gray-300 rounded-lg text-center"
                                wire:model.defer="about"  autocomplete="about" placeholder="......"></textarea>
                            <x-input-error for="about" class="mt-2" />
                        </div>
                        <div class="col-span-12 w-full ">
                            <x-label for="services" class=" text-center text-xl" value="{{ __('Services') }}" />
                            <textarea id="services" type="textarea" class=" w-full  border border-gray-300 rounded-lg text-center"
                                wire:model.defer="services"  autocomplete="services" placeholder="......"></textarea>
                            <x-input-error for="services" class="mt-2" />
                        </div>


                    </div>


                </div>


        </x-slot>
        <x-slot name="actions">
            <x-action-message on="store">
                {{ __('Profile information saved.') }}
            </x-action-message>

            <x-button>
                {{ __('Save') }}
            </x-button>

        </x-slot>

    </x-profile-extra-form>



</div>
