<x-app-layout>
    <div class="max-w-[1200px] mx-auto px-4 lg:px-10 py-8">
        <div class="mb-8">
            <h1 class="text-slate-900 text-3xl font-black leading-tight tracking-tight">Global Admin Dashboard</h1>
            <p class="text-slate-500">Platform-wide overview and user governance.</p>
        </div>

        <div class="my-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="flex flex-col gap-2 rounded-2xl p-6 bg-white border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Users</p>
                    <div class="size-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fa-solid fa-users text-sm"></i>
                    </div>
                </div>
                <p class="text-slate-900 text-3xl font-black">{{$totalUsers}}</p>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl p-6 bg-white border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Colocations</p>
                    <div class="size-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fa-solid fa-house-chimney text-sm"></i>
                    </div>
                </div>
                <p class="text-slate-900 text-3xl font-black">{{$totalColocations}}</p>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl p-6 bg-white border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Total Spent</p>
                    <div class="size-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-file-invoice-dollar text-sm"></i>
                    </div>
                </div>
                <p class="text-slate-900 text-3xl font-black">{{$totalSpent}}</p>
            </div>

            <div class="flex flex-col gap-2 rounded-2xl p-6 bg-white border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Banned</p>
                    <div class="size-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center">
                        <i class="fa-solid fa-user-slash text-sm"></i>
                    </div>
                </div>
                <p class="text-slate-900 text-3xl font-black">{{$bannedUsers}}</p>
            </div>
        </div>

        <div class="flex flex-col gap-8 mt-10">
            <section class="flex flex-col gap-4">
                <div class="flex justify-between items-center px-1">
                    <h2 class="text-slate-900 text-xl font-bold leading-tight flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-blue-600"></i>
                        User Management
                    </h2>
                    <div class="flex gap-2">
                        <div class="relative">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" placeholder="Search users..." class="pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-200">
                                <th class="px-6 py-4 text-slate-500 text-[10px] font-bold uppercase tracking-widest">User ID</th>
                                <th class="px-6 py-4 text-slate-500 text-[10px] font-bold uppercase tracking-widest">Identify</th>
                                <th class="px-6 py-4 text-slate-500 text-[10px] font-bold uppercase tracking-widest">Email Address</th>
                                <th class="px-6 py-4 text-slate-500 text-[10px] font-bold uppercase tracking-widest text-right">Administrative Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if(isset($users) && count($users))
                            @foreach($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-xs font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded">#USR-{{$user->id}}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="size-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                            {{ strtoupper(substr($user->username, 0, 2)) }}
                                        </div>
                                        <span class="text-slate-900 font-bold text-sm">{{$user->username}}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-sm font-medium">{{$user->email}}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <form method="post" action="{{route('admin.users.update',['user'=>$user])}}">
                                        @csrf 
                                        @method('put')   
                                        @if($user->is_banned)
                                            <button class="px-4 py-2 rounded-lg text-emerald-600 bg-emerald-50 hover:bg-emerald-100 font-bold text-xs uppercase tracking-tight flex items-center gap-2 transition-colors">
                                                <i class="fa-solid fa-circle-check"></i> Unban
                                            </button>
                                            @else

                                            <button class="px-4 py-2 rounded-lg text-rose-600 bg-rose-50 hover:bg-rose-100 font-bold text-xs uppercase tracking-tight flex items-center gap-2 transition-colors">
                                                <i class="fa-solid fa-user-slash"></i> Ban
                                            </button>
                                            @endif
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center gap-2 text-slate-400">
                                        <i class="fa-solid fa-users-slash text-4xl mb-2"></i>
                                        <p class="font-bold">No users found in the database</p>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>