<x-app-layout>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-slate-900 text-3xl font-black">Sunny Side Apartment</h1>
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Active</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="min-w-[120px] rounded-xl h-11 px-5 bg-slate-200 text-slate-700 text-sm font-bold hover:bg-slate-300 transition-all">
                    Leave Coloc
                </button>
                <button onclick="toggleModal()" class="min-w-[120px] rounded-xl h-11 px-5 bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 shadow-md transition-all">
                    Add Category
                </button>
            </div>
        </div>

        <div class="mb-6 border-b border-slate-200">
            <div class="flex gap-8">
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{ route('app.colocations.index',['id'=>$colocation->id]) }}">Members</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{ route('app.colocations.expenses.index',['id'=>$colocation->id]) }}">Expenses</a>
                <a class="border-b-2 border-blue-600 text-blue-600 pb-4 text-sm font-bold" href="{{ route('app.colocations.categories.index',['id'=>$colocation->id]) }}">Categories</a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-slate-900 text-xl font-bold">Categories</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Expenses Active</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($categories as $category)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-bold text-slate-900">{{ $category->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $category->description }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $category->activeDepenses() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="#" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-400 italic">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 w-full bg-slate-900/50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Create New Category</h3>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form class="p-6" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Category Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g., Groceries, Utilities"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        placeholder="What is this category for?"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none"
                        required></textarea>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="toggleModal()"
                        class="px-5 py-2 text-sm font-bold text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('addCategory').addEventListener('click', toggleModal)

        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>