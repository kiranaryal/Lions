<div>
    <div class="max-w-7xl rounded-3xl bg-sky-100 min-h-screen">
        <div class="text-center mt-5 text-xl font-bold pt-5"> News Feed</div>
        @foreach ($this->news as $new)
            <div class="m-5 p-5 bg-white rounded-3xl shadow-lg flex flex-col">
                <div class="flex items-center ">
                    <img src="{{$new->getImage()}}" alt="" class="h-16 w-16 rounded-full object-cover ">
                    <div class="pl-5">
                        <p class="font-bold text-lg">{{$new->writer}}</p>
                        <p class="text-sm">{{$new->date}}</p>
                    </div>
                </div>
                <div class="p-5 pt-0">
                    <p class="text-center font-bold text-lg">{{$new->title}}</p>
                    <p class="text-justify">{!!$new->content!!}</p>
                </div>
            </div>
        @endforeach
    </div>

</div>
