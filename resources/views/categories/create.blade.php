<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="mb-6">
                            <label class="block font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="mb-6">
                            <label class="block font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                        <div class="flex space-x-6"> <!-- Aumenté el espacio a 6 (1.5rem) -->
                            <button type="submit"
        style="background-color: #2563eb !important;"
        class="text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
    Save
</button>
                            </button>
                            <a href="{{ route('categories.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>