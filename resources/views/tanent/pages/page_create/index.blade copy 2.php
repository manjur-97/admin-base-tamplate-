@extends('tanent.layout')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-2 sm:px-4">
        <div class="bg-white shadow-xl rounded-2xl p-4 sm:p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 sm:mb-8 text-center">Create New Page</h2>
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('tanent.website.page_store') }}" id="pageForm" class="space-y-6 sm:space-y-8">
                @csrf
                @if (isset($page))
                    @method('PUT')
                @endif
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6">
                    <input type="hidden" name="website_id" value="{{$website_id}}">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Page Name</label>
                        <input id="name" name="name" type="text"
                            class="peer w-full px-4 py-2 border-2 border-gray-200 rounded-lg bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 outline-none placeholder-transparent"
                            value="{{ old('name', $page->name ?? '') }}" placeholder="Name">
                        <span class="block h-0.5 w-0 bg-blue-500 peer-focus:w-full transition-all duration-300"></span>
                        @if($errors->has('name'))
                            <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="menu_id" class="block text-sm font-semibold text-gray-700 mb-1">Page Connected with (Menu or other  Button)</label>
                        <select id="menu_id" name="menu_id"
                            class="peer w-full px-4 py-2 border-2 border-gray-200 rounded-lg bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 outline-none">
                            <option value="">--Select Menu--</option>
                            <option value="no_menu">--Not Attached With Menu--</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" @if (old('menu_id', $page->menu_id ?? '') == $menu->id) selected @endif>
                                    {{ $menu->name }}</option>
                            @endforeach
                        </select>
                        <span class="block h-0.5 w-0 bg-blue-500 peer-focus:w-full transition-all duration-300"></span>
                        @if($errors->has('menu_id'))
                            <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('menu_id') }}</span>
                        @endif
                    </div>
                    <div>
                        <label for="slug" class="block text-sm font-semibold text-gray-700 mb-1">Slug</label>
                        <input id="slug" name="slug" type="text" readonly
                            class="peer w-full px-4 py-2 border-2 border-gray-200 rounded-lg bg-gray-100 focus:bg-gray-100 focus:border-gray-300 focus:ring-2 focus:ring-gray-200 transition-all duration-300 outline-none placeholder-transparent cursor-not-allowed"
                            value="{{ old('slug', $page->slug ?? '') }}" placeholder="Slug">
                        <span class="block h-0.5 w-0 bg-gray-400 peer-focus:w-full transition-all duration-300"></span>
                        @if($errors->has('slug'))
                            <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mt-2">
                    <button type="button" class="w-full sm:w-auto px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition-all duration-200 focus:ring-2 focus:ring-blue-300 focus:outline-none" id="openModalBtn">
                        + Page Design
                    </button>
                </div>

                <div class="mt-6" id="selectedComponentsSection" style="display:none;">
                    <h3 class="text-md font-semibold mb-2">Selected Components</h3>
                    @if($errors->has('components'))
                        <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('components') }}</span>
                    @endif
                    @if($errors->has('components.*.name'))
                        <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('components.*.name') }}</span>
                    @endif
                    @if($errors->has('components.*.position'))
                        <span class="text-xs text-red-600 mt-2 block">{{ $errors->first('components.*.position') }}</span>
                    @endif
                    <ul class="space-y-2" id="selectedComponentsList">
                        <!-- Dynamically filled -->
                    </ul>
                </div>

                <input type="hidden" name="components" id="componentsInput">

                <div class="mt-8 flex flex-col sm:flex-row justify-end gap-2">
                    <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        {{ isset($page) ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
            <!-- Modal (outside the form, only for selecting components) -->
            <div id="componentModal"
                class="fixed top-0 left-0 w-full h-full z-50 bg-black bg-opacity-50 hidden" style="margin: 0">
                <div class="bg-white w-full h-full flex flex-col max-w-full max-h-full sm:max-w-3xl sm:max-h-[90vh] sm:mx-auto sm:my-8 rounded-none sm:rounded-2xl overflow-hidden">
                    <div class="flex justify-between items-center px-4 sm:px-6 p-2 border-b bg-gray-50">
                        <h2 class="text-lg font-semibold ">Select Components</h2>
                        <button type="button" class="text-white bg-red-400 rounded-full p-1 hover:bg-red-500 text-2xl font-bold" id="closeModalBtn">&times;</button>
                    </div>
                    <div class="flex-1 overflow-y-auto p-2 sm:p-6">
                        <div class="border-b mb-4">
                            <nav class="flex flex-wrap space-x-2 sm:space-x-4" aria-label="Tabs">
                                @foreach ($groupedComponentFiles as $group => $files)
                                    <button type="button"
                                        class="tab-btn px-2 py-2 text-xs sm:px-3 sm:py-2 sm:text-sm font-medium rounded-t focus:outline-none {{ $loop->first ? 'bg-blue-100 text-blue-700 active' : 'text-gray-500 hover:text-blue-700' }}"
                                        data-group="{{ $group }}">{{ $group ?: 'Root' }}</button>
                                @endforeach
                            </nav>
                        </div>
                        <div>
                            @foreach ($groupedComponentFiles as $group => $files)
                                <div class="tab-content-group {{ $loop->first ? '' : 'hidden' }}"
                                    data-group="{{ $group }}">
                                    <div class="flex flex-col space-y-4">
                                        @foreach ($files as $file)
                                            <div class="border rounded p-2 sm:p-4 bg-gray-50">
                                                <label class="flex items-center space-x-2 cursor-pointer mb-2">
                                                    <input type="checkbox"
                                                        class="component-checkbox form-checkbox text-blue-600"
                                                        value="{{ $file['name'] }}">
                                                    <span>{{ $file['name'] }}</span>
                                                </label>
                                                <div class="bg-gray-100 rounded p-2 text-xs">{!! $file['content'] !!}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 p-4 sm:p-6 border-t bg-gray-50">
                        <button type="button" class="w-full sm:w-auto px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                            id="closeModalBtn2">Close</button>
                        <button type="button" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                            id="addComponentsBtn">Select Components for your page</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Modal open/close
            $('#openModalBtn').on('click', function() {
                $('#componentModal').removeClass('hidden');
            });
            $('#closeModalBtn, #closeModalBtn2').on('click', function() {
                $('#componentModal').addClass('hidden');
            });

            // Tab switching
            $('.tab-btn').on('click', function() {
                var group = $(this).data('group');
                $('.tab-btn').removeClass('bg-blue-100 text-blue-700 active').addClass('text-gray-500');
                $(this).addClass('bg-blue-100 text-blue-700 active').removeClass('text-gray-500');
                $('.tab-content-group').addClass('hidden');
                $('.tab-content-group[data-group="' + group + '"]').removeClass('hidden');
            });

            // Component selection
            var selectedComponents = [];
            var componentPositions = [];

            function updateSelectedComponentsUI() {
                var $list = $('#selectedComponentsList');
                $list.empty();
                if (componentPositions.length === 0) {
                    $('#selectedComponentsSection').hide();
                    return;
                }
                $('#selectedComponentsSection').show();
                componentPositions.forEach(function(component, idx) {
                    var disabledUp = idx === 0 ? 'disabled' : '';
                    var disabledDown = idx === componentPositions.length - 1 ? 'disabled' : '';
                    $list.append(`
                    <li class="flex flex-col sm:flex-row items-center justify-between bg-white rounded shadow p-2 gap-2 sm:gap-0">
                        <span>${component.name}</span>
                        <div class="flex space-x-1 mt-2 sm:mt-0">
                            <button type="button" class="move-up px-2 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300" data-idx="${idx}" ${disabledUp}>↑</button>
                            <button type="button" class="move-down px-2 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300" data-idx="${idx}" ${disabledDown}>↓</button>
                            <button type="button" class="remove-component px-2 py-1 text-xs bg-red-200 text-red-700 rounded hover:bg-red-300" data-name="${component.name}">Remove</button>
                        </div>
                    </li>
                `);
                });
                $('#componentsInput').val(JSON.stringify(componentPositions));
            }

            // Add selected components from modal
            $('#addComponentsBtn').on('click', function() {
                $('.component-checkbox:checked').each(function() {
                    var name = $(this).val();
                    if (!selectedComponents.includes(name)) {
                        selectedComponents.push(name);
                        componentPositions.push({
                            name: name,
                            position: componentPositions.length + 1
                        });
                    }
                });
                // Remove unchecked
                $('.component-checkbox').each(function() {
                    var name = $(this).val();
                    if (!$(this).is(':checked')) {
                        var idx = selectedComponents.indexOf(name);
                        if (idx !== -1) {
                            selectedComponents.splice(idx, 1);
                            componentPositions = componentPositions.filter(c => c.name !== name);
                        }
                    }
                });
                // Reorder positions
                componentPositions = componentPositions.map(function(c, i) {
                    return {
                        ...c,
                        position: i + 1
                    };
                });
                updateSelectedComponentsUI();
                $('#componentModal').addClass('hidden');
            });

            // Remove component
            $('#selectedComponentsList').on('click', '.remove-component', function() {
                var name = $(this).data('name');
                var idx = selectedComponents.indexOf(name);
                if (idx !== -1) {
                    selectedComponents.splice(idx, 1);
                    componentPositions = componentPositions.filter(c => c.name !== name);
                    // Uncheck in modal
                    $('.component-checkbox[value="' + name + '"]').prop('checked', false);
                    // Reorder positions
                    componentPositions = componentPositions.map(function(c, i) {
                        return {
                            ...c,
                            position: i + 1
                        };
                    });
                    updateSelectedComponentsUI();
                }
            });

            // Move up/down
            $('#selectedComponentsList').on('click', '.move-up, .move-down', function() {
                var idx = parseInt($(this).data('idx'));
                var to = $(this).hasClass('move-up') ? idx - 1 : idx + 1;
                if (to < 0 || to >= componentPositions.length) return;
                var moved = componentPositions.splice(idx, 1)[0];
                componentPositions.splice(to, 0, moved);
                // Reorder positions
                componentPositions = componentPositions.map(function(c, i) {
                    return {
                        ...c,
                        position: i + 1
                    };
                });
                updateSelectedComponentsUI();
            });

            // Slug auto-generation
            $('#name').on('input', function() {
                var text = $(this).val();
                var slug = text.toLowerCase()
                    .replace(/\s+/g, '_')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '_')
                    .replace(/^\-+/, '')
                    .replace(/\-+$/, '');
                $('#slug').val(slug);
            });

            // On form submit, update hidden input and allow normal submission
            // $('#pageForm').on('submit', function(e) {
            //     $('#componentsInput').val(JSON.stringify(componentPositions));
            //     // Do not prevent default, allow form to submit
            // });
        });
    </script>
@endsection
