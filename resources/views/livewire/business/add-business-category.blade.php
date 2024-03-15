<div>

    <!-- Your form content -->
    <x-profile-extra-form submit="store">


        <x-slot name="form">
            <div class="flex justify-end">
                <div wire:click="closeModal" class="text-right font-bold hover:cursor-pointer "> X</div>
            </div>
                <div class=" ">
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
                        </select>
                        <x-input-error for="category" class="mt-2" />
                    </div>

                </div>

        </x-slot>
            <x-slot name="actions">


                <x-button>
                    {{ __('Save') }}
                </x-button>

            </x-slot>

    </x-profile-extra-form>



</div>

