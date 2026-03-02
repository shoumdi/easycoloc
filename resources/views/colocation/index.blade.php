<x-app-layout>
    <div class="max-w-[1200px] mx-auto px-4 lg:px-10 py-8">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-10">
            <div class="flex flex-col gap-1">
                <h1 class="text-slate-900 text-4xl font-black tracking-tight">My Colocations</h1>
            </div>
            <button onclick="toggleModal()" class="flex items-center gap-2 rounded-xl h-12 px-6 bg-blue-600 text-white text-sm font-bold shadow-lg shadow-blue-200 transition-all hover:bg-blue-700 hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i>
                <span>Create New Coloc</span>
            </button>
        </div>

        @if(isset($colocations) && count($colocations))
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($colocations as $coloc)
            <div class="group relative bg-white border border-slate-200 rounded-2xl p-6 hover:border-blue-400 transition-all shadow-sm hover:shadow-xl hover:shadow-blue-500/5 cursor-pointer">
                <a href="{{route('app.colocations.show', ['id' => $coloc->id])}}" class="flex flex-col h-full">
                    <div class="flex justify-between items-start mb-6">
                        <div class="size-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                            <i class="fa-solid fa-house-chimney text-xl"></i>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-emerald-50 text-emerald-600 border border-emerald-100">Owner</span>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-1 group-hover:text-blue-600 transition-colors">{{$coloc->name}}</h3>
                    <p class="text-sm text-slate-500 mb-8 flex items-center gap-2">
                        <i class="fa-solid fa-users text-slate-400"></i>
                        {{count($coloc->users)}} active members
                    </p>

                    <div class="mt-auto pt-4 border-t border-slate-50 flex items-center justify-between">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Management</span>
                        <div class="flex items-center text-blue-600 font-bold text-sm">
                            View Details
                            <i class="fa-solid fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-20 bg-white border-2 border-dashed border-slate-200 rounded-3xl">
            <div class="size-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                <i class="fa-solid fa-house-medical text-3xl text-slate-300"></i>
            </div>
            <p class="text-slate-500 font-medium">No colocations found. Create your first one to get started!</p>
        </div>
        @endif
    </div>

    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 transition-all hidden">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
            <div class="px-8 pt-8 pb-4 flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">Start a Coloc</h3>
                    <p class="text-sm text-slate-500">Give your shared home a name to begin.</p>
                </div>
                <button onclick="toggleModal()" class="size-10 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form class="p-8" action="{{route('app.colocations.post')}}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 ml-1">Colocation Name</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <i class="fa-solid fa-signature"></i>
                            </span>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                placeholder="e.g., Sunny Side Apartment"
                                class="w-full pl-11 pr-4 py-3.5 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-600 outline-none transition-all placeholder:text-slate-300 text-slate-700"
                                required>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-col gap-3">
                    <button type="submit" class="w-full py-4 px-6 bg-blue-600 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 hover:shadow-blue-300 transition-all">
                        Create Colocation
                    </button>
                    <button type="button" onclick="toggleModal()" class="w-full py-3 px-6 text-slate-500 font-bold hover:text-slate-700 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('addColoc').addEventListener('click', toggleModal)

        function toggleModal() {
            document.getElementById('modal').classList.toggle('hidden');
        }
    </script>
    @endpush
</x-app-layout>