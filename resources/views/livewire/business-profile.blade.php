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
                    class=" bg-green-600/80 rounded-full px-3 text-gray-100 font-bold shadow-md shadow-green-900">
                        edit
                        </button>
                        <button   wire:click="removeBusiness({{ $business->id }})"
                        class=" bg-red-600/80 rounded-full px-3 text-gray-100 font-bold shadow-md shadow-red-900">
                            Delete
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

</div>
