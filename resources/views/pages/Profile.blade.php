<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Profile') }}
        </h2>
    </x-slot>
    @livewire('profile-form')
    @livewire('profile-form-extra')
    @livewire('profile-form-details')


</x-app-layout>
