<a href="{{ route('laboratory.show', $diagram->id) }}" 
    class="p-4 bg-black/5 rounded-xl flex flex-col text-center min-h-[220px] hover:bg-black/10 transition-colors relative">
     
     <!-- Бейдж статуса в правом верхнем углу -->
     <div class="absolute top-2 right-2">
         @if($status === 'draft')
             <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Черновик</span>
         @elseif($status === 'review')
             <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">На проверке</span>
         @else
             <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Проверено</span>
         @endif
     </div>
 
     <!-- Тип диаграммы -->
     <div class="text-sm text-gray-500 mb-2">
         {{ match($type) {
             'type1' => 'Задание 1',
             'type2' => 'Задание 2',
             'type3' => 'Задание 3',
             default => $type
         } }}
     </div>
 
     <!-- Название -->
     <div class="py-2 font-bold text-lg">
         <h3>{{ Str::limit($title, 30) }}</h3>
     </div>
     
     <!-- Описание -->
     <p class="text-gray-600 text-sm flex-grow">
         {{ Str::limit($description, 80) }}
     </p>
 
     <!-- Комментарий администратора (если есть) -->
     @if($adminComment && $status === 'approved')
     <div class="mt-3 pt-2 border-t border-gray-200">
         <div class="text-xs text-gray-500 font-medium">Комментарий преподавателя:</div>
         <div class="text-xs text-gray-600 truncate" title="{{ $adminComment }}">
             {{ Str::limit($adminComment, 50) }}
         </div>
     </div>
     @endif
 </a>