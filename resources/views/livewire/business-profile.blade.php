<div>
    <div class="m-5 bg-white shadow-lg rounded-xl">
        @foreach ($this->businessProfile as $business)
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
                <div class="py-5 sm:py-0 px-5 bg-gray-50 text-center rounded-r-xl flex justify-end sm:flex-col sm:justify-around">
                    @if ($this->id = auth()->id())
                    <button
                     wire:click="$dispatch('openModal', { component: 'business.edit-business', arguments: { id: {{ $business->id }} }})"
                    class="bg-transparent text-green-600/80  px-3 font-bold">
                    <i class="fa-regular fa-pen-to-square fa-2xl"></i>
                </button>
                        <button   wire:click="removeBusiness({{ $business->id }})"
                        class="bg-transparent text-red-600/80  px-3 font-bold">
                        <i class="fa-solid fa-trash fa-2xl"></i>
                    </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

</div>
