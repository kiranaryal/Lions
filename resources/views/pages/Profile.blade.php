<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Profile') }}
        </h2>
    </x-slot>
@livewire('profile-form')

</x-app-layout>
