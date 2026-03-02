<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-[80vh] px-4">
        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
            <div class="h-48 w-full bg-slate-50 relative overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#3b82f6 1px, transparent 1px); background-size: 20px 20px;"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-blue-50/50 to-white"></div>

                <div class="relative flex flex-col items-center">
                    <div class="size-20 rounded-2xl bg-blue-600 shadow-lg shadow-blue-200 flex items-center justify-center text-white mb-4 rotate-3 group-hover:rotate-0 transition-transform">
                        <i class="fa-solid fa-house-chimney-user text-3xl"></i>
                    </div>
                    <span class="bg-blue-100 text-blue-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-[0.2em] border border-blue-200">
                        New Invitation
                    </span>
                </div>
            </div>

            <div class="p-8 lg:p-12 flex flex-col items-center text-center">
                <div class="mb-8">
                    <h1 class="text-3xl lg:text-4xl font-black text-slate-900 mb-4 tracking-tight">
                        Join {{$dto->coloc->name}}
                    </h1>
                    <p class="text-slate-500 text-lg max-w-md mx-auto leading-relaxed">
                        Your future roommates are waiting! Start managing shared expenses and building your financial reputation.
                    </p>
                </div>

                <div class="flex flex-col items-center gap-6 py-8 border-y border-slate-50 w-full mb-8">
                    <div class="flex items-center gap-5">
                        <div class="size-10 rounded-full bg-red-500 flex items-center justify-center text-neutral-900 text-xl font-bold shadow-lg shadow-slate-200">
                            AJ
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Invited by</p>
                            <p class="text-xl font-bold text-slate-900">{{$dto->owner->username}}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap justify-center items-center gap-6 mt-2">
                        <div class="flex items-center gap-2 text-slate-600">
                            <i class="fa-solid fa-users text-slate-300"></i>
                            <span class="text-sm font-bold">{{count($dto->coloc->users)}} Members</span>
                        </div>
                        <div class="size-1 bg-slate-200 rounded-full"></div>
                        <div class="flex items-center gap-2 text-slate-600">
                            <i class="fa-solid fa-receipt text-slate-300"></i>
                            <span class="text-sm font-bold">Expense Tracking</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center sm:flex-row gap-4 w-full max-w-md">
                    <form action="{{route('app.colocations.invitations.update')}}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="invitationDto" value="{{json_encode(['invitation'=>$dto->invit,'choice'=>'DECLINED'])}}">
                        <button class="flex-1 flex items-center justify-center rounded-2xl h-14 px-8 bg-slate-100 text-slate-600 text-lg font-bold transition-all hover:bg-slate-200 active:scale-[0.98]">
                            Decline
                        </button>
                    </form>
                    <form action="{{route('app.colocations.invitations.update')}}" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="invitationDto" value="{{json_encode(['invitation'=>$dto->invit,'choice'=>'ACCEPTED'])}}">
                        <button class="flex-1 flex items-center justify-center rounded-2xl h-14 px-8 bg-blue-600 text-white text-lg font-bold transition-all hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-200 active:scale-[0.98]">
                            Accept
                        </button>
                    </form>
                </div>


            </div>
        </div>

    </div>
</x-app-layout>