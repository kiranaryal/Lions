<div>
    <form wire:submit.prevent="search">
        <div class="grid grid-cols-12  gap-x-16 gap-y-5">
            <div class="col-span-8 md:col-span-8 max-w-xs md:max-w-full">
                <div class="rounded-3xl bg-white shadow-lg relative flex justify-between">
                    <div class="absolute left-5 bottom-2">
                        <i class="fa-solid fa-magnifying-glass"></i></div>
                    <input wire:model="searchQuery" type="text"
                        class="border-none rounded-3xl pl-16 text-sm md:text-xl md:w-[80%] truncate line-clamp-1"
                        placeholder="Search Profiles, Business">
                    <button type="submit"
                        class="  text-xl bg-blue-900 text-gray-100 px-3 rounded-full font-bold shadow-md ">Search</button>
                </div>
            </div>
            <div class=" col-span-6  md:col-span-4  flex rounded-full justify-center items-center shadow-lg @if($business || $profile)bg-blue-900 @else bg-white @endif  ">
                         <button wire:click="toggleBusiness"
                             class="text-xl  hover:bg-blue-900 py-3 hover:text-gray-100 px-3 rounded-full  font-bold w-full h-full @if($business) bg-blue-900 text-gray-100 @else bg-white @endif">Business</button>
                         <button wire:click="toggleProfile"
                             class="text-xl  hover:bg-blue-900 py-3 hover:text-gray-100 px-3 rounded-full font-bold w-full h-full @if($profile) bg-blue-900 text-gray-100  @else bg-white @endif">Profile</button>
            </div>
        </div>
    </form>
    <div class=" md:grid grid-cols-1 md:grid-cols-3 ">
        <div class="col-span-1 ">
            @livewire('category')

        </div>
        <div class="col-span-2   mt-5 ">
            <div class="m-5  shadow-lg bg-white rounded-3xl">
                @if ($business)
                @if ($this->searchResult['business'])
                @foreach ($this->searchResult['business'] as $key=> $busi)
                    <div class="sm:flex p-5 shadow-lg rounded-2xl">
                        <div class="min-w-32 rounded-full flex justify-center items-center">
                            @if ($busi->getLogo() != '/storage/')
                                <img src="{{ $busi->getLogo() }}" alt="" class="w-24 h-24 object-cover bg-gray-100 rounded-full">
                            @endif
                        </div>
                        <div class="px-5 w-full rounded-l-xl">
                            <a href="{{ route('business_show', $busi->id) }}" class="font-bold text-xl py-2 text-center sm:text-left">{{ $busi->org_name }}</a>
                            <p class="flex items-center"><i class="fa-solid fa-envelope pr-2"></i>{{ $busi->email }}</p>
                            <p class="flex items-center"><i class="fa-solid fa-house pr-2"></i>{{ $busi->address }}</p>
                            <p class="flex items-center"><i class="fa-solid fa-phone pr-2"></i>{{ $busi->phone }}</p>
                        </div>
                    </div>
                @endforeach
                    {{-- {{ $this->searchResult['business']->links() }} --}}
                @endif
                @endif


                @if ($profile)

                @if($this->searchResult['profile'] )
                @foreach ($this->searchResult['profile'] as $profile)
                @if($profile->full_name!=null && $profile->public_phone !=null && $profile->public_email !=null)
                <div class="sm:flex p-5 shadow-lg rounded-2xl ">
                    <div class="min-w-32  rounded-full flex  justify-center items-center ">
                        @if ($profile->getImage() != '/storage/')
                        <img src="{{ $profile->getImage() }}" alt="" class="w-24 h-24 object-cover rounded-full">
                        @endif
                    </div>
                    <div class=" px-5  w-full rounded-l-xl">
                        <a href="{{route('profile',$profile->id)}}" class="font-bold text-xl py-2 text-center sm:text-left">{{ $profile->full_name }}</a>
                        <p class="flex items-center "> <i class="fa-solid fa-envelope pr-2"></i> {{ $profile->public_email }}</p>
                        <p class="flex items-center "> <i class="fa-solid fa-house pr-2"></i> {{ $profile->address }}</p>
                        <p class="flex items-center "> <i class="fa-solid fa-phone pr-2"></i> {{ $profile->public_phone }}</p>
                    </div>

                </div>
                @endif
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
