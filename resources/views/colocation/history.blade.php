<x-app-layout>
    <div class="w-full mx-auto px-4 lg:px-10 py-8 overflow-hidden">
        <div class="flex flex-wrap justify-between items-end gap-4 mb-8">
            <div class="flex flex-col gap-1">
                <h1 class="text-slate-900 text-4xl font-black leading-tight tracking-tight">Expenses Tracking</h1>
                <p class="text-slate-500 text-lg">Detailed history of shared household spending.</p>
            </div>
            <div class="bg-blue-50 px-5 py-3 rounded-xl flex items-center gap-3 border border-blue-100">
                <span class="text-slate-500 text-sm font-bold uppercase tracking-wider">Total this month:</span>
                <span class="text-blue-600 font-bold text-xl">$1,420.50</span>
            </div>
        </div>
        <div class="mb-6 border-b border-slate-200">
            <div class="flex gap-8">
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.index',['id'=>$colocation->id])}}">Members</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.expenses.index',['id'=>$colocation->id])}}">Expenses</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.categories.index',['id'=>$colocation->id])}}">Categories</a>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-lg">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">Reputation Score</p>
                </div>
                <div class="flex items-end gap-2">
                    <h3 class="text-2xl font-bold text-slate-900">98</h3>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-2.5 bg-blue-50 text-blue-600 rounded-lg">
                        <i class="fa-solid fa-money-bill-transfer"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">I'm Owed</p>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">$425.00</h3>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex items-center gap-4 mb-2">
                    <div class="p-2.5 bg-amber-50 text-amber-600 rounded-lg">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-wider">I Owe</p>
                </div>
                <h3 class="text-2xl font-bold text-slate-900">$120.30</h3>
            </div>
        </div>

        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap gap-3">
                <button class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-4 py-2 rounded-lg text-sm font-bold text-slate-600 hover:border-slate-300 transition-all">
                    <i class="fa-solid fa-calendar-days text-slate-400"></i>
                    <span>October 2023</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
                <button class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-4 py-2 rounded-lg text-sm font-bold text-slate-600 hover:border-slate-300 transition-all">
                    <span>Category</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
                <button class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-4 py-2 rounded-lg text-sm font-bold text-slate-600 hover:border-slate-300 transition-all">
                    <span>Paid By</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
            </div>

        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Paid By</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-900">Whole Foods Weekly Groceries</span>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">#EXP-8492</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider border border-blue-100">Food</span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm font-bold text-slate-900">$145.20</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzim6yyNPcXc9aFagyw2QUu7mgQIhsxGIUK8XKpQi9dXV-WA8MwrPeeevpNLs4GQN4XI9N8Rh-TgPYIdTMlG390KMkXO8_2W3LU6nuzi5MQWngSLA2d89od4GtsS8ylvg-ss5BwjjNvNrZhL5GSkFelSlICCg1ccRYNLn2988zFuE5hZywyQ2CCkhQThE64-7oUlHGjvHTndFH5O1SatZ0wB0p0-_k-FKHbVmbnHwRwMM1M8mswwMY4lIsRq-aXvkQlVVIVEBywSXZ" class="size-8 rounded-full ring-2 ring-slate-100" alt="Sarah J">
                                    <span class="text-sm font-medium text-slate-700">Sarah J.</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-sm text-slate-500">Oct 24, 2023</span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2 text-emerald-600 font-bold text-xs">
                                    <i class="fa-solid fa-circle text-[8px] animate-pulse"></i>
                                    Balanced
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.getElementById('addMember').addEventListener('click', toggleMemberModal)

        function toggleMemberModal() {

            document.getElementById('modal').classList.toggle('hidden')
        }
    </script>
    @endpush
</x-app-layout>