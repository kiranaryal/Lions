<div>

    @foreach ($profileExtra->groupBy('category') as $extra)
        <div class="uppercase font-bold  text-xl text-center ">
            {{ $extra[0]->category }}
        </div>
        <div class="col-span-12 mt-2  md:gap-6">


            <div class="mt-2 md:mt-0  gap-5 ">
                @foreach ($extra as $a)
                    <div class="rounded-3xl bg-white flex justify-between my-2 shadow-lg ">
                        <div class=" rounded-full mx-2 p-2">
                            @if ($a->photo)
                                <img src="{{ $a->getImage() }}" alt="" class="w-20 h-16   object-cover rounded-full">
                            @endif
                        </div>
                        <div class="py-2 w-full ">
                            <div class=" capitalize font-bold text-xl">
                                {{ $a->org_name }}
                            </div>
                            <div class=" capitalize font-bold text-lg">
                                {{ $a->position }}
                            </div>
                        </div>
                        @if (auth()->id() == $id)
                            <div class="flex flex-col">
                                <button
                                    class=" text-center border-none bg-transparent text-green-500 px-2  rounded justify-end"
                                    wire:click="$dispatch('openModal', { component: 'profile.edit-details', arguments: { id: {{ $a->id }} }})">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <!-- Delete Button -->
                                <button
                                    class=" text-center border-none bg-transparent text-red-500 p-2  rounded justify-end"
                                    wire:click="removeProfileExtra({{ $a->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
