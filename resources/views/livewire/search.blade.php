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
        <div class="col-span-2  bg-white mt-5 rounded-3xl">
            <div class="m-5 bg-white shadow-lg rounded-xl">
                @if ($business)

                @if($this->searchResult['business'] )
                @foreach ($this->searchResult['business'] as $business)
                <div class="sm:flex p-5">
                    <div class="min-w-32  rounded-full flex  justify-center items-center">
                        @if ($business->getLogo() != '/storage/')
                        <img src="{{ $business->getLogo() }}" alt="" class="w-24 h-24 object-cover bg-gray-100 rounded-full">
                        @endif
                    </div>
                    <div class=" px-5 bg-gray-50 w-full rounded-l-xl">
                        <a href="{{route('business_show',$business->id)}}" class="font-bold text-xl py-2 text-center sm:text-left">{{ $business->org_name }}</a>
                        <p>{{ $business->email }}</p>
                        <p>{{ $business->address }}</p>
                        <p>{{ $business->phone }}</p>
                        <p>{{ $business->website }}</p>
                    </div>

                </div>
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
