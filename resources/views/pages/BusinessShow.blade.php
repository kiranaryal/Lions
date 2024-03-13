<x-app-layout>
    <x-slot name="header">
        <div class="flex">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Business') }}
        </h2>

        </div>
    </x-slot>
    @livewire('business.business-show-details')
</x-app-layout>
