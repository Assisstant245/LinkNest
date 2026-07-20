<x-layouts.app title="Profile">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 sm:py-10 space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Profile</h1>

        <div class="p-4 sm:p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl">
            <livewire:profile.update-profile-information-form />
        </div>

        <div class="p-4 sm:p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl">
            <livewire:profile.update-password-form />
        </div>

        <div class="p-4 sm:p-6 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl">
            <livewire:profile.delete-user-form />
        </div>
    </div>
</x-layouts.app>
