@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')
    <div class="space-y-6">
        <div class="bg-gray-50 p-6 rounded-lg">
            <h3 class="text-xl font-semibold mb-4 text-gray-800">Website Pages</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($pages as $page)
                    <div class="bg-white p-4 rounded border hover:shadow-md transition-shadow">
                        <h4 class="font-semibold text-gray-800">{{ $page->title ?? $page->name ?? 'Untitled Page' }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $page->description ?? 'No description available.' }}</p>
                        <div class="flex gap-2 mt-3">
                            <a href="{{route('tanent.website.page_edit', $page->id)}}" class="text-blue-600 hover:text-blue-800 text-sm">Edit Page</a>
                            <a href="#" class="text-red-600 hover:text-red-800 text-sm">Delete</a>
                            <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Preview</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-400 py-8">
                        No pages found. Please add a new page.
                    </div>
                @endforelse
            </div>
        </div>
        <div class="flex justify-center mt-8">
            <a href="{{ route('tanent.website.page_create', $website_id) }}">
                <div class="bg-white p-4 rounded border-2 border-dashed border-gray-300 hover:border-gray-400 transition-colors w-80 text-center">
                    <h4 class="font-semibold text-gray-500">+ Add New Page</h4>
                    <p class="text-sm text-gray-400 mt-1">Create Page</p>
                </div>
            </a>
        </div>
    </div>
@endsection
