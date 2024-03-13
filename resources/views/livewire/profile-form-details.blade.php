<div>

    @foreach ($profileExtra->groupBy('category') as $extra)
        <div class="uppercase font-bold text-center mt-10">
            {{ $extra[0]->category }}
        </div>
        <div class="col-span-12 md:grid md:grid-cols-6 mt-5  md:gap-6">

            <div class="mt-5 md:mt-0 md:col-span-1">
            </div>

            <div class="mt-5 md:mt-0 md:col-span-4 xl:col-span-4 xl:grid xl:grid-cols-12 gap-5 ">
                    @foreach ($extra as $a)

                    <div class="rounded bg-white flex xl:col-span-6 my-5">
                        <div class="h-24 w-24 rounded-full m-5">
                            @if($a->photo)
                            <img src="{{$a->getImage()}}" alt="" class="w-24 h-24 object-cover rounded-full">
                            @endif
                        </div>
                        <div class="pt-5 w-full ">
                            <div class=" py-2 font-bold text-lg">
                                {{ $a->org_name }}
                            </div>
                            <div class=" py-2">
                                {{ $a->position }}
                            </div>@if (auth()->id() == $id)
                            <div class="flex justify-end w-full pr-10">
                                <button class="my-2 text-center border bg-orange-500 text-white px-2 py-1 rounded justify-end"
                                wire:click="$dispatch('openModal', { component: 'profile.edit-details', arguments: { id: {{ $a->id }} }})">
                                edit
                            </button>
                            <!-- Delete Button -->
                                <button class="my-2 text-center border bg-red-500 text-white px-2 py-1 rounded justify-end"
                                wire:click="removeProfileExtra({{ $a->id }})">
                                delete
                            </button>
                        </div>
                        @endif
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
    @endforeach
</div>
