<div>

    <!-- Your form content -->
    <x-profile-extra-form submit="store">


        <x-slot name="form">
            <div class="flex justify-end">
                <div wire:click="closeModal" class="text-right font-bold hover:cursor-pointer "> X</div>
            </div>

            <div class="col-span-12 gap-10 ">


                <div class=" ">
                    <div class="flex justify-center items-center">


                        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 w-full z-100">
                            <!-- Profile Photo File Input -->
                            <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                                x-on:change="
                                                            photoName = $refs.photo.files[0].name;
                                                            const reader = new FileReader();
                                                            reader.onload = (e) => {
                                                                photoPreview = e.target.result;
                                                            };
                                                            reader.readAsDataURL($refs.photo.files[0]);
                                                    " />


                            <!-- Current Profile Photo -->
                            <div class="mt-2 flex justify-center" x-show="! photoPreview">
                                <img src="{{ $this->photo }}" alt=""
                                    class="rounded-full h-24 w-32 object-cover">
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2 flex justify-center" x-show="photoPreview" style="display: none;">
                                <span class="block rounded-full w-32 h-24 bg-cover bg-no-repeat bg-center"
                                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <div class="flex justify-center">

                                <x-secondary-button class="mt-2 me-2" type="button"
                                x-on:click.prevent="$refs.photo.click()">
                                {{ __('New Logo') }}
                            </x-secondary-button>
                        </div>

                            <x-input-error for="photo" class="mt-2" />
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl my-5 shadow-lg">
                        <input id="org_name" type="text"
                            class="w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                            wire:model.defer="org_name" required autocomplete="org_name"
                            placeholder="Name Of Institution" />
                        <x-input-error for="org_name" class="mt-2" />
                    </div>
                    <div class="bg-white rounded-3xl my-5 shadow-lg">
                        <input id="position" type="text"
                            class=" w-full
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                            wire:model.defer="position" required autocomplete="position" placeholder="Description"
                            />
                        <x-input-error for="position" class="mt-2" />

                    </div>
                    <div class="bg-white rounded-3xl my-5 shadow-lg">
                        <select id="category"
                            class=" w-full px-3 bg-white text-center font-bold
                                                        border-none rounded-3xl
                                                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                            wire:model.defer="category" required>
                            <option value="" selected required class="text-gray-300">Select
                                Education/ Experience</option>
                            <option value="education">Education</option>
                            <option value="experience">Experience</option>
                            <option value="skill">Skills</option>
                            <option value="certification">Certifications</option>



                        </select>
                        <x-input-error for="category" class="mt-2" />
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
