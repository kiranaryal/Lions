<div>
    <div class="bg-sky-100 rounded-3xl shadow-xl shadow-blue-100 max-w-7xl " >
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5 sm:m-5 p-5">
            <div class="col-span-1 lg:col-span-5 bg-gray-50 rounded-xl p-5 shadow-lg  ">
                <div class="flex items-center">
                    <div class="flex items-center justify-center">
                        <img src="{{$this->business->getLogo()}}" alt="" class="h-16 w-16 rounded-full object-cover object-center">
                    </div>
                    <div class="flex flex-row justify-between w-full">
                        <div class="text-center px-5 font-bold text-lg sm:text-xl lg:text-2xl">{{$this->business->org_name}}</div>
                        <div>
                            <button
                            wire:click="$dispatch('openModal', { component: 'business.edit-business', arguments: { id: {{ $this->business->id }} }})"
                            class=" text-green-600/80 ">
                            <i class="fa-regular fa-pen-to-square fa-2xl"></i>
                        </button>
                    </div>
                    </div>
                </div>
                <div class="flex flex-col items-start justify-start text-lg font-bold pt-5">
                    <p> {{$this->business->address}}</p>
                    <p>E: {{$this->business->email}}</p>
                    <p>T: {{$this->business->phone}}</p>
                </div>

                <div class="mt-10 flex justify-between ">
                    <a href="{{$this->business->website}}" class="underline text-sm truncate"
                         target="_blank" rel="noopener noreferrer"> {{$this->business->website}}</a>
                         <div class="flex lg:space-x-5 space-x-1 flex-row shrink">
                        <a href="{{$this->business->facebook}}"target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-facebook fa-2xl" style="color: #4267B2;"></i>
                        </a>
                        <a href="{{$this->business->facebook}}"target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-instagram fa-2xl" style="color: #5851DB;"></i>
                        </a>  <a href="{{$this->business->facebook}}"target="_blank" rel="noopener noreferrer">
                            <i class="fa-brands fa-linkedin fa-2xl" style="color: #0a66c2;"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-span-1 lg:col-span-7">
                @if($this->business->getPhoto() != '/storage/' && $this->business->getPhoto() != null)
                <img src="{{$this->business->getPhoto() }}" class="rounded-xl w-full h-72 object-cover">
                @endif
            </div>
        </div>

        <div class=" bg-gray-50 rounded-xl m-5 p-5 shadow-lg ">
            <p class="font-bold text-center text-xl"> About</p>
            <p class="text-justify">{{$this->business->about}}</p>
         </div>
         <div class="grid grid-cols-1 sm:grid-cols-2">

             <div class=" col-span-1 bg-gray-50 rounded-xl m-5 p-5 shadow-lg ">
                 <p class="font-bold text-center text-xl"> Services</p>

                 <p class="text-justify">{{$this->business->services}}</p>

                </div>

                <div class=" col-span-1 bg-gray-50 rounded-xl m-5 p-5 shadow-lg ">
                    <p class="font-bold text-center text-xl"> Business Category</p>

                    @foreach($this->business->categories as $cate)
                    <div class=" flex items-center space-x-2">

                        <i class="fa-solid fa-circle-dot fa-sm "></i>
                        <div>{{ $cate->name }}</div>

                        </div>
                        @endforeach

                   </div>

        </div>


    </div>

</div>
