<div>
    <div class="bg-white rounded-3xl w-full md:max-w-xs mt-5 shadow-lg">
        <div class="flex md:flex-col p-5 py-2 space-y-2 max-h-[200px] md:h-full overflow-y-auto space-x-2" >
            <div class="bg-white p-2 rounded-full text-center font-bold capitalize hover:cursor-pointer " wire:click="clear()">Categories</div>
            @foreach($this->category as $cat)
            <div wire:click="selectCategory({{ $cat->id }})" class="hover:cursor-pointer hover:bg-gray-100
                @if($this->selectedCategory == $cat->id)
                bg-gray-200
                @else  bg-white
                @endif
               shadow-lg p-2 rounded-full text-left pl-16 font-bold capitalize relative">
                <div class="absolute left-5 bottom-2">{!! $cat->icon !!}</div>
                {{$cat->name}}
                <div class="absolute right-5 bottom-2 hidden md:block"><i class="fa-solid fa-caret-right"></i></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
