@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')
    <div class="flex flex-col gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 space-y-6">
                <div class="border-b border-gray-200 pb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Header Customization</h3>
                    <p class="text-sm text-gray-600 mt-1">Configure your website header settings and appearance</p>
                </div>

                <form id="headerConfigurationForm" class="space-y-6">
                    @csrf
                    
                    <!-- Topbar Settings -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Topbar Settings</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Enable Topbar</label>
                                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                    <input type="checkbox" name="topbar_enabled" id="topbar_enabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-transform duration-200 ease-in-out" checked>
                                    <label for="topbar_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="topbar_phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="topbar_phone" id="topbar_phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="+1 234 567 8900">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="topbar_email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="topbar_email" id="topbar_email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="info@example.com">
                            </div>
                        </div>
                    </div>

                    <!-- Header Behavior -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Header Behavior</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Sticky Header</label>
                                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                    <input type="checkbox" name="sticky_enabled" id="sticky_enabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-transform duration-200 ease-in-out" checked>
                                    <label for="sticky_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Search Bar</label>
                                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                    <input type="checkbox" name="search_enabled" id="search_enabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-transform duration-200 ease-in-out">
                                    <label for="search_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Call to Action Button -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Call to Action Button</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-medium text-gray-700">Enable CTA Button</label>
                                <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                    <input type="checkbox" name="cta_button_enabled" id="cta_button_enabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-transform duration-200 ease-in-out" checked>
                                    <label for="cta_button_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="cta_button_text" class="block text-sm font-medium text-gray-700">Button Text</label>
                                <input type="text" name="cta_button_text" id="cta_button_text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Get Started">
                            </div>
                            
                            <div class="space-y-2">
                                <label for="cta_button_url" class="block text-sm font-medium text-gray-700">Button URL</label>
                                <input type="url" name="cta_button_url" id="cta_button_url" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="https://example.com/contact">
                            </div>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Login Button</h4>
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-gray-700">Show Login Button</label>
                            <div class="relative inline-block w-12 mr-2 align-middle select-none">
                                <input type="checkbox" name="login_button_enabled" id="login_button_enabled" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-transform duration-200 ease-in-out" checked>
                                <label for="login_button_enabled" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Color Scheme -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-medium text-gray-800 mb-4">Color Scheme</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="primary_color" class="block text-sm font-medium text-gray-700">Primary Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" name="primary_color" id="primary_color" value="#2563eb" class="w-12 h-10 border border-gray-300 rounded-md cursor-pointer">
                                    <input type="text" value="#2563eb" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" readonly>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <label for="secondary_color" class="block text-sm font-medium text-gray-700">Secondary Color</label>
                                <div class="flex items-center space-x-2">
                                    <input type="color" name="secondary_color" id="secondary_color" value="#1d4ed8" class="w-12 h-10 border border-gray-300 rounded-md cursor-pointer">
                                    <input type="text" value="#1d4ed8" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                        <button type="button" id="previewBtn" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Preview
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('configuration_script')
<style>
    .toggle-checkbox:checked {
        transform: translateX(1.5rem);
        border-color: #3b82f6;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #3b82f6;
    }
    .toggle-label {
        transition: background-color 0.2s ease-in-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Color picker functionality
    const primaryColorPicker = document.getElementById('primary_color');
    const primaryColorText = primaryColorPicker.nextElementSibling;
    const secondaryColorPicker = document.getElementById('secondary_color');
    const secondaryColorText = secondaryColorPicker.nextElementSibling;

    primaryColorPicker.addEventListener('input', function() {
        primaryColorText.value = this.value;
    });

    secondaryColorPicker.addEventListener('input', function() {
        secondaryColorText.value = this.value;
    });

    // Form submission
    const form = document.getElementById('headerConfigurationForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Saving...';
        submitBtn.disabled = true;

        // Send AJAX request
        fetch('/api/header-configuration', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showNotification('Configuration saved successfully!', 'success');
            } else {
                showNotification('Error saving configuration', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error saving configuration', 'error');
        })
        .finally(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    });

    // Preview functionality
    document.getElementById('previewBtn').addEventListener('click', function() {
        // Get current form values and apply to preview
        const formData = new FormData(form);
        showNotification('Preview functionality coming soon!', 'info');
    });

    // Notification function
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-md shadow-lg z-50 ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Load existing configuration if available
    loadConfiguration();
});

function loadConfiguration() {
    fetch('/api/header-configuration')
        .then(response => response.json())
        .then(data => {
            if (data.config) {
                const config = data.config;
                
                // Populate form fields
                document.getElementById('topbar_enabled').checked = config.topbar_enabled;
                document.getElementById('topbar_phone').value = config.topbar_phone || '';
                document.getElementById('topbar_email').value = config.topbar_email || '';
                document.getElementById('sticky_enabled').checked = config.sticky_enabled;
                document.getElementById('search_enabled').checked = config.search_enabled;
                document.getElementById('cta_button_text').value = config.cta_button_text || '';
                document.getElementById('cta_button_url').value = config.cta_button_url || '';
                document.getElementById('cta_button_enabled').checked = config.cta_button_enabled;
                document.getElementById('login_button_enabled').checked = config.login_button_enabled;
                document.getElementById('primary_color').value = config.primary_color;
                document.getElementById('primary_color').nextElementSibling.value = config.primary_color;
                document.getElementById('secondary_color').value = config.secondary_color;
                document.getElementById('secondary_color').nextElementSibling.value = config.secondary_color;
            }
        })
        .catch(error => {
            console.error('Error loading configuration:', error);
        });
}
</script>
@endsection
