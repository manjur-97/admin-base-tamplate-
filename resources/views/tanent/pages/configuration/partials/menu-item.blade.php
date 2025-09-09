<div class="menu-item" data-menu-id="{{ $menu->id }}">
    <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-indigo-200 transition-all">
        <div class="flex items-center">
            <!-- Drag Handle -->
            <div class="drag-handle mr-2 cursor-grab text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                </svg>
            </div>
            
            @if($menu->children && $menu->children->isNotEmpty())
                <svg class="w-5 h-5 text-indigo-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 6h18M3 18h18"></path></svg>
            @else
                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16"></path></svg>
            @endif
            <span class="font-medium text-gray-700">{{ $menu->name }}</span>
            @if($menu->parent_id)
                <span class="ml-2 text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Child</span>
            @endif
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="openMenuModal('edit', {{ json_encode($menu) }})" class="text-xs px-2 py-1 text-blue-600 bg-blue-50 rounded hover:bg-blue-100 font-semibold transition-colors">Edit</button>
            <button onclick="deleteMenu({{ $menu->id }}, '{{ $menu->name }}')" class="text-xs px-2 py-1 text-red-600 bg-red-50 rounded hover:bg-red-100 font-semibold transition-colors">Delete</button>
        </div>
    </div>

    @if($menu->children && $menu->children->isNotEmpty())
        <div class="child-menu-list mt-2 pl-6 border-l-2 border-indigo-100 space-y-2">
            @foreach($menu->children->sortBy('order') as $child)
                @include('tanent.pages.configuration.partials.menu-item', ['menu' => $child])
            @endforeach
        </div>
    @endif
    
    <!-- Debug info (remove in production) -->
    {{-- @if(config('app.debug'))
        <div class="text-xs text-gray-400 mt-1 ml-4">
            ID: {{ $menu->id }} | Parent: {{ $menu->parent_id ?? 'None' }} | Children: {{ $menu->children ? $menu->children->count() : 0 }}
        </div>
    @endif --}}
</div> 