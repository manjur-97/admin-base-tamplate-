@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')
    <div class="flex flex-col gap-4">

        <div id="" class="">
            <div class="space-y-6">
                <div class="rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Footer Templates</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach ($footers as $footer)
                            <div class="bg-white rounded-lg border hover:shadow-lg transition-shadow overflow-hidden">
                                <!-- Footer Info -->
                                <div class="p-4 border-b">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="selected_footer" id="footer_{{ $footer['id'] }}"
                                                value="{{ $footer['id'] }}"
                                                data-file-name="{{ $footer['file_name'] ?? '' }}"
                                                {{ $footer['is_active'] ? 'checked' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                            <label for="footer_{{ $footer['id'] }}"
                                                class="font-semibold text-gray-800 cursor-pointer">{{ $footer['name'] }}</label>
                                        </div>
                                        <span
                                            class="text-xs px-2 py-1 rounded {{ $footer['is_active'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $footer['is_active'] ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Footer Preview -->
                                <div class="footer-preview-container">
                                    <div class="footer-preview-content" id="footer_preview_{{ $footer['id'] }}">
                                        {!! $footer['content'] !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('configuration_script')
    <!-- SweetAlert2 CDN -->

    <script>
        $(function() {
            $('input[name="selected_footer"]').on('change', function() {
                var footerId = $(this).val();
                var footerContent = $('#footer_preview_' + footerId).html();
                var fileName = $(this).data('file-name');

                $.ajax({
                    url: "{{ route('cms.settings.save-footer') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        footer: footerContent,
                        file_name: fileName,
                        website_id: {{ $website_id }}
                    },
                    success: function(response) {
                        // Remove active from all
                        $('input[name="selected_footer"]').each(function() {
                            var card = $(this).closest('.bg-white');
                            card.find('.text-xs').removeClass(
                                'bg-green-100 text-green-800').addClass(
                                'bg-gray-100 text-gray-600').text('Inactive');
                        });
                        // Set active for selected
                        var card = $('input[name="selected_footer"]:checked').closest(
                            '.bg-white');
                        card.find('.text-xs').removeClass('bg-gray-100 text-gray-600').addClass(
                            'bg-green-100 text-green-800').text('Active');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Footer selected successfully!',
                            showConfirmButton: false,
                            timer: 1800,
                            timerProgressBar: true
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Something went wrong. Please try again.',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                });
            });
        });
    </script>
@endsection
