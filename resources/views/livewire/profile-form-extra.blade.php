<div x-data="{ open: @entangle('showForm') }">
    <!-- Trigger button -->
    @if (auth()->id() == $id)

    <div class="flex justify-center mt-5">
        <button @click="open = true" class="my-2 text-center border bg-white  px-2 py-1 rounded">
            Add Details
        </button>
    </div>
    @endif

    <!-- Modal overlay -->
    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 ">
        <!-- Modal content -->
        <div x-show="open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="bg-white rounded-3xl m-5 shadow-lg p-8 max-w-sm md:max-w-xl ">
            <!-- Close button -->
            <button @click="open = false" class="absolute top-0 right-0 mt-4 mr-4 cursor-pointer">
                &times;
            </button>

            <!-- Your form content -->
            <x-profile-extra-form submit="store">


                <x-slot name="form">
                    <div class="flex justify-end">
                        <div wire:click="closeModal" class="text-right font-bold hover:cursor-pointer "> X</div>
                    </div>

                    <div class="col-span-12 gap-10 ">


                        <div class=" ">
                            <div class="flex justify-center items-center">


                                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 w-full">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" id="photo" class="hidden" wire:model.live="photo"
                                        x-ref="photo"
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

                                    <x-secondary-button class="mt-2 me-2" type="button"
                                        x-on:click.prevent="$refs.photo.click()">
                                        {{ __('New Logo') }}
                                    </x-secondary-button>

                                    @if ($this->photo)
                                        <x-secondary-button type="button" class="mt-2" wire:click="deletePhoto">
                                            {{ __('Remove Logo') }}
                                        </x-secondary-button>
                                    @endif

                                    <x-input-error for="photo" class="mt-2" />
                                </div>
                            </div>
                            <div class="bg-white rounded-3xl my-5 shadow-lg">
                                <input id="org_name" type="text"
                                    class="
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                    wire:model.defer="org_name" required autocomplete="org_name"
                                    placeholder="Name Of Institution"
                                    @if (auth()->id() != $id) disabled @endif />
                                <x-input-error for="org_name" class="mt-2" />
                            </div>
                            <div class="bg-white rounded-3xl my-5 shadow-lg">
                                <input id="position" type="text"
                                    class="
                                  px-3 bg-white text-center font-bold
                                border-none rounded-3xl
                                focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                focus:invalid:border-pink-300 focus:invalid:ring-pink-300
                                "
                                    wire:model.defer="position" required autocomplete="position"
                                    placeholder="Description" @if (auth()->id() != $id) disabled @endif />
                                <x-input-error for="position" class="mt-2" />

                            </div>
                            <div class="bg-white rounded-3xl my-5 shadow-lg">
                                <select id="category"
                                    class=" px-3 bg-white text-center font-bold
                                                        border-none rounded-3xl
                                                        focus:outline-none focus:border-pink-300 focus:ring-1 focus:ring-pink-300
                                                        focus:invalid:border-pink-300 focus:invalid:ring-pink-300"
                                    wire:model.defer="category" @if (auth()->id() != $id) disabled @endif
                                    required>
                                    <option value="" selected required class="text-gray-300">Select
                                        Education/ Experience</option>
                                    <option value="education">Education</option>
                                    <option value="experience">Experience</option>
                                </select>
                                <x-input-error for="category" class="mt-2" />
                            </div>

                        </div>
                    </div>
                    <div>
                        <div wire:click="closeModal">close</div>
                    </div>

                </x-slot>
                @if (auth()->id() == $id)
                    <x-slot name="actions">
                        <x-action-message on="store">
                            {{ __('Profile information saved.') }}
                        </x-action-message>

                        <x-button>
                            {{ __('Save') }}
                        </x-button>

                    </x-slot>

                @endif

            </x-profile-extra-form>
        </div>
    </div>
</div>
