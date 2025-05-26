<div class="p-4 w-full mx-auto bg-white rounded shadow">
    @if (!$showResult)
        <h2 class="text-xl font-bold mb-4">Soal {{ $currentIndex + 1 }}</h2>
        <p class="mb-4">{{ $currentQuestion->question_text }}</p>
        <div class="space-y-2" wire:loading.remove>
            <button wire:click="answer('a')" class="w-full bg-blue-100 p-2 rounded hover:bg-blue-200">{{ $currentQuestion->option_a }}</button>
            <button wire:click="answer('b')" class="w-full bg-blue-100 p-2 rounded hover:bg-blue-200">{{ $currentQuestion->option_b }}</button>
            <button wire:click="answer('c')" class="w-full bg-blue-100 p-2 rounded hover:bg-blue-200">{{ $currentQuestion->option_c }}</button>
            <button wire:click="answer('d')" class="w-full bg-blue-100 p-2 rounded hover:bg-blue-200">{{ $currentQuestion->option_d }}</button>
        </div>
        <div wire:loading wire:loading.class="!flex" class="flex flex-nowrap w-full gap-2" >
            
            <div class='loader' >
            </div>
            <div>
               loading...
            </div>
        </div>
        
    @else
        <h2 class="text-xl font-bold mb-4">Selesai!</h2>
        <p class="mb-2">Skor kamu: {{ $score }} / {{ $post[0]->games[0]->questions->count() }}</p>
        {{-- <button wire:click="restart" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Main Lagi</button> --}}
    @endif
</div>