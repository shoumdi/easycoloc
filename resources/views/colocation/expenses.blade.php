<x-app-layout>
    <div class="p-6 bg-neutral-50 min-h-screen">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div class="flex items-center gap-3">
                <h1 class="text-slate-900 text-3xl font-black">{{ $colocation->name }}</h1>
                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold uppercase">Active</span>
            </div>
            <div class="flex gap-3">
                <button class="rounded-xl h-11 px-5 bg-slate-200 text-slate-700 text-sm font-bold hover:bg-slate-300 transition-all">
                    Leave Coloc
                </button>
                <button onclick="toggleModal()" class="rounded-xl h-11 px-5 bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 shadow-md transition-all">
                    Add Expense
                </button>
            </div>
        </div>

        <div class="mb-6 border-b border-slate-200">
            <div class="flex gap-8">
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.index',['id'=>$colocation->id])}}">Members</a>
                <a class="border-b-2 border-blue-600 text-blue-600 pb-4 text-sm font-bold" href="{{route('app.colocations.expenses.index',['id'=>$colocation->id])}}">Expenses</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.categories.index',['id'=>$colocation->id])}}">Categories</a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-slate-900 text-xl font-bold">Expenses List</h3>
                    <p class="text-slate-500 text-sm">{{ count($depenses) }} active expenses</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Expense</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-right">Payer</th>
                            @if(auth()->user()->isOwner())
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($depenses as $depense)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-900">{{ $depense->titre }}</p>
                                <p class="text-xs text-slate-500">{{ $depense->created_at->format('d M, Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                    ${{$depense->montant }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="text-sm font-bold text-emerald-600">{{$depense->payer()->username}}</span>
                            </td>
                            @if(auth()->user()->isOwner())
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('app.colocations.expenses.destroy',['colocation'=>$colocation,'expense'=>$depense])}}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500">No expenses recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

         <div class="mt-4 bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-slate-900 text-xl font-bold">Debts List</h3>
                    <p class="text-slate-500 text-sm">{{ count($depenses) }} active expenses</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Expense</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Amount</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">owe(debtor)</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">owed to(creditor)</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($debts as $debt)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-slate-900">{{ $debt->id }}</p>
                                <p class="text-xs text-slate-500">{{ $debt->created_at->format('d M, Y') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                    ${{ $debt->amount }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-emerald-600">{{$debt->debitor->username}}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-emerald-600">{{$debt->creditor->username}}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(auth()->user()->id === $debt->debitor->id)
                                <form action="{{route('app.colocations.debts.update',['colocation'=>$colocation,'debt'=>$debt])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-400 hover:text-red-600">
                                        <i class="fa-solid fa-money-bill"></i>
                                        Pay
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500">No expenses recorded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

    <div id="modal" class="fixed inset-0 w-full bg-slate-900/50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-slate-800">Add New Expense</h3>
                <button onclick="toggleModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form class="p-6 space-y-4" action="{{route('app.colocations.expenses.store',['id'=>$colocation->id])}}" method="POST">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Expense Title</label>
                    <input name="titre" type="text" class="w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="e.g., Weekly Groceries" required />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Amount</label>
                        <input name="montant" type="number" step="0.01" class="w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0.00" required />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Date</label>
                        <input name="date" type="date" value="{{ date('Y-m-d') }}" class="w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 outline-none" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Category</label>
                    <select name="category_id" class="w-full rounded-lg border border-slate-300 py-2.5 px-4 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="" selected disabled hidden>Choose a category</option>
                        @foreach($colocation->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    @foreach($colocation->users as $member)
                    <label class="block p-4 border rounded-lg cursor-pointer
               has-[:checked]:bg-blue-100
               has-[:checked]:border-blue-500">
                        <input type="radio" name="payer" value="{{$member->id}}" class="sr-only" />
                        {{$member->username}}
                    </label>
                    @endforeach
                </div>

                <div class="pt-4 flex justify-end gap-3">
                    <button type="button" onclick="toggleModal()" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-100 rounded-lg">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm">Save Expense</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('modal');
            modal.classList.toggle('hidden');
        }
    </script>
    @push('scripts')
    <script>
        document.getElementById('addMember').addEventListener('click', toggleModal)

        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden')
        }
    </script>
    @endpush
</x-app-layout>