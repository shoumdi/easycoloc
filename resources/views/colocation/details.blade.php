<x-app-layout>
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-slate-900 text-3xl font-black">{{ $colocation->name }}</h1>
                    <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Active</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button class="min-w-[120px] rounded-xl h-11 px-5 bg-slate-200 text-slate-700 text-sm font-bold hover:bg-slate-300 transition-all">
                    Leave Coloc
                </button>
                @if(auth()->user()->isOwner())
                <button onclick="toggleMemberModal()" class="min-w-[120px] rounded-xl h-11 px-5 bg-blue-600 text-white text-sm font-bold hover:bg-blue-700 shadow-md transition-all">
                    Invite Member
                </button>
                @endif
            </div>
        </div>

        <div class="mb-6 border-b border-slate-200">
            <div class="flex gap-8">
                <a class="border-b-2 border-blue-600 text-blue-600 pb-4 text-sm font-bold" href="{{route('app.colocations.index',['id'=>$colocation->id])}}">Members</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.expenses.index',['id'=>$colocation->id])}}">Expenses</a>
                <a class="border-b-2 border-transparent text-slate-500 pb-4 text-sm font-bold hover:text-slate-700" href="{{route('app.colocations.categories.index',['id'=>$colocation->id])}}">Categories</a>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h3 class="text-slate-900 text-xl font-bold">Members List</h3>
                    <p class="text-slate-500 text-sm">{{ count($colocation->users) }} active roommates currently sharing expenses</p>
                </div>
                
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Reputation</th>
                            @if(auth()->user()->isOwner())
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($colocation->users as $user)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="size-9 rounded-full bg-blue-100 text-blue-600 font-bold grid place-items-center">
                                        {{ strtoupper(substr($user->username, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $user->username }}</p>
                                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md text-xs font-bold">
                                    {{ $user->memberType() }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1 text-sm font-bold text-slate-700">
                                    <span>{{$user->reputation}}</span>
                                    <span class="text-slate-400 font-medium">pts</span>
                                </div>
                            </td>
                            @if(auth()->user()->isOwner() && auth()->user()->id !== $user->id)
                            <td class="px-6 py-4 text-center">
                                <form method="post" action="{{route('app.colocations.members.destroy')}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-user-minus"></i></button>
                                    <input name="removeUserDto" type="hidden" value="{{json_encode($user)}}" class="text-slate-400 hover:text-red-500 transition-colors">
                                </form>

                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">No members found.</td>
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
                <h3 class="text-lg font-bold text-slate-800">Invite Roommate</h3>
                <button onclick="toggleMemberModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form class="p-6" action="{{route('member.invite')}}" method="POST">
                @csrf
                <input name="colocation" type="hidden" value="{{ json_encode($colocation) }}">

                <div class="mb-4">
                    <label for="email" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="roommate@example.com"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                        required>
                    <p class="mt-2 text-xs text-slate-400">We'll send an invitation link to join this colocation.</p>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button
                        type="button"
                        onclick="toggleMemberModal()"
                        class="px-5 py-2 text-sm font-bold text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 text-sm font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-sm transition-colors">
                        Send Invitation
                    </button>
                </div>
            </form>
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