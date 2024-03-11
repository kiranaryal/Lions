@props(['submit'])

<div >
    <div class="mt-5 md:mt-0 ">

        <form wire:submit="{{ $submit }}">
            <div class="rounded-3xl px-4 py-5 bg-gray-50 dark:bg-gray-800 sm:p-6 shadow-lg {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class=" ">
                    {{ $form }}
                </div>



                @if (isset($actions))
                <div class="flex items-center justify-end ">
                    {{ $actions }}
                </div>
            @endif

            </div>


        </form>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-1">
    </div>
</div>
