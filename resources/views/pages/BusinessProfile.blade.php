<x-app-layout>
    <div class="flex">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Your Business') }}
        </h2>
            <button class="ml-auto border border-gray-300 px-2 py-1 rounded-lg shadow bg-green-500/60 font-bold"
            onclick="Livewire.dispatch('openModal', { component: 'business.add-business' })">

                Add Business
            </button>
        </div>
    @livewire('business_profile')
</x-app-layout>
