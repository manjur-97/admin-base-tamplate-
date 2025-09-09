@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')

    <div class="flex flex-col gap-4">
        <div id="menus-content">
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Navigation Menu</h3>
                    <div id="menu-list" class="space-y-4">
                        @isset($menus)
                            @forelse($menus->where('parent_id', null) as $menu)
                                @include('tanent.pages.configuration.partials.menu-item', ['menu' => $menu])
                            @empty
                                <p class="text-gray-500 text-center py-4">No menu items yet. Add one below.</p>
                            @endforelse
                        @else
                            <p class="text-gray-500 text-center py-4">No menu items yet. Add one below.</p>
                        @endisset
                    </div>
                    <button id="addMenuButton"
                        class="w-full mt-4 p-3 border-2 border-dashed border-gray-300 rounded text-gray-500 hover:border-gray-400 hover:text-gray-600 transition-colors">
                        + Add Menu Item
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add/Edit Menu Modal -->
    <div id="addMenuModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Add New Menu Item</h3>
                <button id="closeMenuModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6">
                <form action="{{ route('backend.websitemenu.store') }}" method="POST" id="addMenuForm">
                    @csrf
                    <input type="hidden" name="website_id" value="{{ $website_id }}">
                    <input type="hidden" name="menu_id" id="menu_id" value="">
                    <input type="hidden" name="_method" id="form_method" value="POST">
                    <div class="space-y-8">
                        <!-- Name -->
                        <div class="relative">
                            <input type="text" name="name" id="menu_name"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " required />
                            <label for="menu_name"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Name</label>
                        </div>

                        <!-- Parent Menu -->
                        <div class="relative">
                            <select name="parent_id" id="parent_id"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                                <option value="">None</option>
                                @isset($menus)
                                    @foreach ($menus as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <label for="parent_id"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 start-1">Parent
                                Menu (Optional)</label>
                        </div>

                        <!-- Order -->
                        <div class="relative">
                            <input type="number" name="order" id="order" value="0"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                placeholder=" " />
                            <label for="order"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Order</label>
                        </div>

                        <!-- Status -->
                        <div class="relative">
                            <select name="status" id="status"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-indigo-600 peer">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            <label for="status"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-indigo-600 start-1">Status</label>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" id="cancelMenuModal"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">Cancel</button>
                        <button type="submit" id="submitMenuBtn"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">Create
                            Menu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
  @section('configuration_script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
      
            // Menu Modal Logic
            const addMenuButton = document.getElementById('addMenuButton');
            const addMenuModal = document.getElementById('addMenuModal');
            const closeMenuModal = document.getElementById('closeMenuModal');
            const cancelMenuModal = document.getElementById('cancelMenuModal');

            if (addMenuButton) {
                addMenuButton.addEventListener('click', () => {
                    openMenuModal('add');
                });
            }

            const closeTheMenuModal = () => {
                if (addMenuModal) {
                    addMenuModal.classList.add('hidden');
                    resetForm();
                }
            };

            if (closeMenuModal) closeMenuModal.addEventListener('click', closeTheMenuModal);
            if (cancelMenuModal) cancelMenuModal.addEventListener('click', closeTheMenuModal);

            // Function to open modal for add/edit
            window.openMenuModal = function(mode, menuData = null) {
                const modal = document.getElementById('addMenuModal');
                const modalTitle = document.getElementById('modalTitle');
                const submitBtn = document.getElementById('submitMenuBtn');
                const form = document.getElementById('addMenuForm');
                const formMethod = document.getElementById('form_method');
                const menuId = document.getElementById('menu_id');

                if (mode === 'edit' && menuData) {
                    // Edit mode
                    modalTitle.textContent = 'Edit Menu Item';
                    submitBtn.textContent = 'Update Menu';
                    formMethod.value = 'PUT';
                    menuId.value = menuData.id;
                    
                    // Set form values
                    document.getElementById('menu_name').value = menuData.name;
                    document.getElementById('parent_id').value = menuData.parent_id || '';
                    document.getElementById('order').value = menuData.order;
                    document.getElementById('status').value = menuData.status;
                    
                    // Update form action
                    form.action = "{{ route('backend.websitemenu.store') }}/" + menuData.id;
                } else {
                    // Add mode
                    modalTitle.textContent = 'Add New Menu Item';
                    submitBtn.textContent = 'Create Menu';
                    formMethod.value = 'POST';
                    menuId.value = '';
                    
                    // Reset form
                    resetForm();
                    
                    // Update form action
                    form.action = "{{ route('backend.websitemenu.store') }}";
                }

                modal.classList.remove('hidden');
            };

            // Function to reset form
            function resetForm() {
                const form = document.getElementById('addMenuForm');
                form.reset();
                document.getElementById('menu_id').value = '';
                document.getElementById('form_method').value = 'POST';
            }

            // Function to delete menu
            window.deleteMenu = function(menuId, menuName) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `Do you want to delete "${menuName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('backend.websitemenu.store') }}/" + menuId,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Menu deleted successfully!',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    background: '#10b981',
                                    color: '#ffffff'
                                });
                                
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(xhr) {
                                var errorMessage = 'Failed to delete menu. Please try again.';
                                
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                }
                                
                                Swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'error',
                                    title: errorMessage,
                                    showConfirmButton: false,
                                    timer: 4000,
                                    timerProgressBar: true,
                                    background: '#ef4444',
                                    color: '#ffffff'
                                });
                            }
                        });
                    }
                });
            };
        });

        $(document).ready(function() {
            $('#addMenuForm').on('submit', function(e) {
                e.preventDefault();
                
                var submitBtn = $('#submitMenuBtn');
                var originalText = submitBtn.text();
                var isEdit = $('#form_method').val() === 'PUT';
                
                // Show loading state
                submitBtn.prop('disabled', true).text(isEdit ? 'Updating...' : 'Creating...');
                
                $.ajax({
                    url: $(this).attr('action'),
                    method: isEdit ? 'PUT' : 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Reset form
                        $('#addMenuForm')[0].reset();
                        
                        // Close modal
                        $('#addMenuModal').addClass('hidden');
                        
                        // Show success message
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message || (isEdit ? 'Menu updated successfully!' : 'Menu created successfully!'),
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            background: '#10b981',
                            color: '#ffffff'
                        });
                        
                        // Optionally refresh the page or update menu list
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = 'Something went wrong. Please try again.';
                        var errorTitle = 'Error';
                        
                        // Handle different types of errors
                        if (xhr.status === 422) {
                            // Validation errors
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                var errorList = [];
                                
                                // Convert validation errors to readable format
                                Object.keys(errors).forEach(function(field) {
                                    var fieldName = field.charAt(0).toUpperCase() + field.slice(1).replace('_', ' ');
                                    errors[field].forEach(function(message) {
                                        errorList.push(fieldName + ': ' + message);
                                    });
                                });
                                
                                errorMessage = errorList.join('\n');
                                errorTitle = 'Validation Error';
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                                errorTitle = 'Validation Error';
                            }
                        } else if (xhr.status === 409) {
                            // Conflict - duplicate entry
                            errorMessage = xhr.responseJSON?.message || 'This menu name already exists.';
                            errorTitle = 'Duplicate Entry';
                        } else if (xhr.status === 500) {
                            // Server error
                            errorMessage = 'Server error occurred. Please try again later.';
                            errorTitle = 'Server Error';
                        } else if (xhr.status === 0 || xhr.statusText === 'timeout') {
                            // Network error
                            errorMessage = 'Network error. Please check your connection and try again.';
                            errorTitle = 'Network Error';
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            // Custom error message from server
                            errorMessage = xhr.responseJSON.message;
                            errorTitle = 'Error';
                        }
                        
                        // Show error message
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: errorMessage,
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            background: '#ef4444',
                            color: '#ffffff'
                        });
                        
                        // Highlight form fields with errors if validation errors
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            var errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(function(field) {
                                var fieldElement = $('[name="' + field + '"]');
                                if (fieldElement.length) {
                                    fieldElement.addClass('border-red-500');
                                    fieldElement.focus();
                                    
                                    // Remove error styling after 3 seconds
                                    setTimeout(function() {
                                        fieldElement.removeClass('border-red-500');
                                    }, 3000);
                                }
                            });
                        }
                    },
                    complete: function() {
                        // Reset button state
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            });
        });
    </script>
@endsection
