@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')
    <div class="flex flex-col gap-4">

        <div id="" class="">
            <div class="space-y-6">
                <div class="rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Header Templates</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach ($headers as $header)
                            <div class="bg-white rounded-lg border hover:shadow-lg transition-shadow overflow-hidden">
                                <!-- Header Info -->
                                <div class="p-4 border-b">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="selected_header" id="header_{{ $header['id'] }}"
                                                value="{{ $header['id'] }}"
                                                data-file-name="{{ $header['file_name'] ?? '' }}"
                                                {{ $header['is_active'] ? 'checked' : '' }}
                                                class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                            <label for="header_{{ $header['id'] }}"
                                                class="font-semibold text-gray-800 cursor-pointer">{{ $header['name'] }}</label>
                                        </div>
                                        <span
                                            class="text-xs px-2 py-1 rounded {{ $header['is_active'] ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $header['is_active'] ? 'Active' : 'Inactive' }}
                                        </span>
                                        <a href="{{route('tanent.website.header_customization', $website_id )}}">
                                            <span class="btn btn-sm px-2 py-1 rounded  bg-blue-600 text-blue-100">
                                                Customization
                                            </span></a>
                                    </div>
                                </div>

                                <!-- Header Preview -->
                                <div class="header-preview-container">
                                    <div class="header-preview-content" id="header_preview_{{ $header['id'] }}">
                                        {!! $header['content'] !!}
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
            $('input[name="selected_header"]').on('change', function() {
                var headerId = $(this).val();
                var headerContent = $('#header_preview_' + headerId).html();
                var fileName = $(this).data('file-name');

                $.ajax({
                    url: "{{ route('cms.settings.save-header') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        header: headerContent,
                        file_name: fileName,
                        website_id: {{ $website_id }}
                    },
                    success: function(response) {
                        // Remove active from all
                        $('input[name="selected_header"]').each(function() {
                            var card = $(this).closest('.bg-white');
                            card.find('.text-xs').removeClass(
                                'bg-green-100 text-green-800').addClass(
                                'bg-gray-100 text-gray-600').text('Inactive');
                        });
                        // Set active for selected
                        var card = $('input[name="selected_header"]:checked').closest(
                            '.bg-white');
                        card.find('.text-xs').removeClass('bg-gray-100 text-gray-600').addClass(
                            'bg-green-100 text-green-800').text('Active');
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Header selected successfully!',
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
