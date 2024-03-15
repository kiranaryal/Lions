@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-10 h-full md:gap-6']) }}>


    <div class="mt-5 md:mt-0 md:col-span-7">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 bg-sky-100  dark:bg-gray-800 sm:p-6 shadow-lg rounded-3xl {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-12 gap-6 ">
                    {{ $form }}
                </div>
                @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 dark:bg-gray-800 text-end sm:px-6 ">
                    {{ $actions }}
                </div>
                 @endif
            </div>
        </form>
    </div>
    @if (isset($details))
    <div class="mt-5 md:mt-0 md:col-span-3">
        {{ $details }}
    </div>
    @endif

</div>
