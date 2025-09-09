@extends('tanent.layout')

@section('content')
    <!-- SEO Meta Tags -->
  



    <!-- Responsive Menu Bar -->
    <nav class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow z-40 flex justify-around items-center py-2 sm:static sm:top-14 sm:w-auto sm:justify-start sm:gap-8 sm:border-t-0 sm:border-b sm:shadow-none sm:bg-transparent">
        <a href="{{ route('tanent.website.configuration', $website_id) }}" class="flex flex-col items-center text-xs text-gray-500 sm:flex-row sm:text-base sm:font-medium sm:text-gray-700 sm:hover:text-indigo-700">
            <svg class="w-6 h-6 mb-1 sm:mb-0 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Basic Configuration</span>
        </a>
        <a href="{{ route('tanent.website.header_config', $website_id) }}" class="flex flex-col items-center text-xs text-indigo-600 font-semibold sm:flex-row sm:text-base sm:font-medium sm:text-gray-700 sm:hover:text-indigo-700">
            <svg class="w-6 h-6 mb-1 sm:mb-0 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            <span>Header</span>
        </a>
        <a href="{{ route('tanent.website.footer_config', $website_id) }}" class="flex flex-col items-center text-xs text-gray-500 sm:flex-row sm:text-base sm:font-medium sm:text-gray-700 sm:hover:text-indigo-700">
            <svg class="w-6 h-6 mb-1 sm:mb-0 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span>Footer</span>
        </a>
        <a href="{{ route('tanent.website.menu_config', $website_id) }}" class="flex flex-col items-center text-xs text-gray-500 sm:flex-row sm:text-base sm:font-medium sm:text-gray-700 sm:hover:text-indigo-700">
            <svg class="w-6 h-6 mb-1 sm:mb-0 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Menu</span>
        </a>
        <a href="{{ route('tanent.website.pages_config', $website_id) }}" class="flex flex-col items-center text-xs text-gray-500 sm:flex-row sm:text-base sm:font-medium sm:text-gray-700 sm:hover:text-indigo-700">
            <svg class="w-6 h-6 mb-1 sm:mb-0 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Pages</span>
        </a>
        
    </nav>

    <!-- Main Content Area -->
    <main class="">
        <div class="">
            <div class="bg-white rounded-xl shadow p-2 sm:p-8 mt-2">
               @yield('ConfigurationContent')
            </div>
        </div>
    </main>

  
@endsection
