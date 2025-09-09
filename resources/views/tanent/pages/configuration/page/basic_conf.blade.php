@extends('tanent.pages.configuration.index')

@section('ConfigurationContent')
<form method="POST" action="" enctype="multipart/form-data" class="">
    @csrf
    @if(isset($website))
        @method('PUT')
    @endif
    <!-- Basic Information Section -->
    <div class="bg-white bg-opacity-80 rounded-xl shadow p-2 sm:p-4 mb-2 sm:mb-3">
        <div class="flex items-center mb-2 sm:mb-3">
            <svg class="w-5 h-5 text-indigo-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <h2 class="text-sm sm:text-base font-semibold text-gray-800">Basic Information</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
            <div>
                <label for="title" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Website Name</label>
                <input type="text" name="title" id="title" value="{{ old('title', $website->title ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="slug" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $website->slug ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div class="sm:col-span-2">
                <label for="description" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Description</label>
                <textarea name="description" id="description" rows="2" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">{{ old('description', $website->description ?? '') }}</textarea>
            </div>
            <div>
                <label for="email" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $website->email ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="mobile" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Mobile</label>
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile', $website->mobile ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div class="sm:col-span-2">
                <label for="address" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $website->address ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div class="sm:col-span-2">
                <label for="logo" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Logo</label>
                <input type="file" name="logo" id="logo" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-200 focus:bg-white transition-all file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                @if(isset($website) && $website->logo)
                    <img src="{{ asset('storage/' . $website->logo) }}" alt="Logo" class="mt-1 h-10 rounded border border-gray-200 shadow">
                @endif
            </div>
        </div>
    </div>
    <!-- SEO Information Section -->
    <div class="bg-white bg-opacity-80 rounded-xl shadow p-2 sm:p-4 mb-2 sm:mb-3">
        <div class="flex items-center mb-2 sm:mb-3">
            <svg class="w-5 h-5 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            <h2 class="text-sm sm:text-base font-semibold text-gray-800">SEO Information</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
            <div>
                <label for="meta_title" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $website->meta_title ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="meta_keywords" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $website->meta_keywords ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div class="sm:col-span-2">
                <label for="meta_description" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-green-500 focus:ring-1 focus:ring-green-200 focus:bg-white transition-all placeholder-gray-400">{{ old('meta_description', $website->meta_description ?? '') }}</textarea>
            </div>
        </div>
    </div>
    <!-- Social Links Section -->
    <div class="bg-white bg-opacity-80 rounded-xl shadow p-2 sm:p-4 mb-2 sm:mb-3">
        <div class="flex items-center mb-2 sm:mb-3">
            <svg class="w-5 h-5 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2a2 2 0 012 2v16a2 2 0 01-2 2H6a2 2 0 01-2-2V4a2 2 0 012-2h12zm-2 7h-4m0 0V5m0 4v4m0 0h4" /></svg>
            <h2 class="text-sm sm:text-base font-semibold text-gray-800">Social Links</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-4">
            <div>
                <label for="facebook" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Facebook</label>
                <input type="text" name="facebook" id="facebook" value="{{ old('facebook', $website->facebook ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="linkedin" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">LinkedIn</label>
                <input type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', $website->linkedin ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="youtube" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">YouTube</label>
                <input type="text" name="youtube" id="youtube" value="{{ old('youtube', $website->youtube ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="twitter" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Twitter</label>
                <input type="text" name="twitter" id="twitter" value="{{ old('twitter', $website->twitter ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="instagram" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Instagram</label>
                <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $website->instagram ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
            <div>
                <label for="git" class="block text-xs sm:text-sm font-semibold text-gray-700 mb-0.5">Git</label>
                <input type="text" name="git" id="git" value="{{ old('git', $website->git ?? '') }}" class="mt-0.5 block w-full rounded-lg border border-gray-200 bg-gray-50 px-2 py-1 text-sm text-gray-800 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-200 focus:bg-white transition-all placeholder-gray-400">
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 text-sm bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-bold rounded-lg shadow hover:from-indigo-600 hover:to-blue-600 transition-all">Save</button>
    </div>
</form>
@endsection