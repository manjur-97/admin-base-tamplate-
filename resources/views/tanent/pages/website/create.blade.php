@extends('tanent.layout')

@section('content')
<style>
    .animated-input {
        position: relative;
    }
    .animated-input input:focus, .animated-input textarea:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 2px #6366f1;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .animated-input label {
        transition: color 0.3s;
    }
    .animated-input input:focus + label,
    .animated-input textarea:focus + label {
        color: #6366f1;
    }
    .custom-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: none;
        background-color: #fff;
        border: 2px solid #d1d5db;
        border-radius: 0.375rem;
        padding-right: 2.5rem;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .custom-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px #6366f1;
        outline: none;
    }
    .select-arrow {
        pointer-events: none;
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6366f1;
        font-size: 1.25rem;
    }
</style>
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center text-indigo-700">Create Website</h2>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('tanent.website.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <input type="hidden" name="tanent_id" id="tanent_id" value="{{ $tanent->id }}">
        <div class="animated-input relative">
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id" id="category_id" class="custom-select mt-1 block w-full sm:text-sm pr-10" required>
                @foreach($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <span class="select-arrow"><svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/></svg></span>
            @error('category_id')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
            <input type="file" name="logo" id="logo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border-2 border-gray-300 rounded-md transition-all duration-300">
            @error('logo')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Enter website title" />
            @error('title')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="slug" class="block text-sm font-semibold text-gray-700 mb-1">Slug (unique)</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required disabled class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-gray-100 text-gray-400" placeholder="Auto-generated from title" />
            @error('slug')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3" required class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Enter website description">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Enter email address" />
            @error('email')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="mobile" class="block text-sm font-semibold text-gray-700 mb-1">Mobile</label>
            <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Enter mobile number" />
            @error('mobile')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Enter address" />
            @error('address')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="facebook" class="block text-sm font-semibold text-gray-700 mb-1">Facebook</label>
            <input type="text" name="facebook" id="facebook" value="{{ old('facebook') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Facebook profile/page URL" />
            @error('facebook')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="linkedin" class="block text-sm font-semibold text-gray-700 mb-1">LinkedIn</label>
            <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="LinkedIn profile/page URL" />
            @error('linkedin')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="youtube" class="block text-sm font-semibold text-gray-700 mb-1">YouTube</label>
            <input type="text" name="youtube" id="youtube" value="{{ old('youtube') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="YouTube channel/page URL" />
            @error('youtube')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="twitter" class="block text-sm font-semibold text-gray-700 mb-1">Twitter</label>
            <input type="text" name="twitter" id="twitter" value="{{ old('twitter') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Twitter profile/page URL" />
            @error('twitter')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="instagram" class="block text-sm font-semibold text-gray-700 mb-1">Instagram</label>
            <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="Instagram profile/page URL" />
            @error('instagram')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input">
            <label for="git" class="block text-sm font-semibold text-gray-700 mb-1">Git</label>
            <input type="text" name="git" id="git" value="{{ old('git') }}" class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all duration-300 px-3 py-2 bg-transparent" placeholder="GitHub/GitLab/Bitbucket URL" />
            @error('git')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="animated-input relative">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="custom-select mt-1 block w-full sm:text-sm pr-10">
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="deleted" {{ old('status') == 'deleted' ? 'selected' : '' }}>Deleted</option>
            </select>
            <span class="select-arrow"><svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/></svg></span>
            @error('status')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Create Website</button>
        </div>
    </form>
</div>
<script>
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^a-z0-9-]/g, '')     // Remove all non-alphanumeric except -
            .replace(/-+/g, '-')            // Replace multiple - with single -
            .replace(/^-+|-+$/g, '');       // Trim - from start/end
    }
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        titleInput.addEventListener('input', function() {
            slugInput.value = slugify(this.value);
        });
    });
</script>
@endsection
