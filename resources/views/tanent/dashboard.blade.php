@extends('tanent.layout')

@section('content')
    <div class="bg-white border border-border rounded-2xl px-3 sm:px-8 py-5 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <p class="text-sm sm:text-base text-gray-700">Welcome to your <span class="font-bold text-indigo-700">Show My Pro</span> Dashboard!</p>
        </div>
        <a href="{{ route('tanent.website.create') }}"
           class="w-full sm:w-auto text-center bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow-sm transition font-semibold text-sm sm:text-base">
            Create New Website
        </a>
    </div>
    <div class="bg-white p-3 sm:p-6 rounded-2xl shadow-sm mb-6 sm:mb-10 border border-border mx-1 sm:mx-0">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 sm:gap-8">
            @forelse ($website as $item)
                <div class="bg-white rounded-2xl border border-border shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden flex flex-col group">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between p-4 sm:p-5 pb-0 gap-3 sm:gap-0">
                        <div class="flex items-center gap-3">
                            @if ($item->logo)
                                <img src="{{ asset('storage/' . $item->logo) }}" alt="Logo"
                                     class="h-12 w-12 sm:h-14 sm:w-14 rounded-full object-cover border border-gray-200 shadow-sm">
                            @else
                                <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-full bg-gray-100 flex items-center justify-center text-indigo-400 text-xl sm:text-2xl font-bold border border-gray-200 shadow-sm">
                                    <span>{{ strtoupper(substr($item->title, 0, 1)) }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="text-base sm:text-lg font-bold text-gray-900">{{ $item->title }}</div>
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200 mt-1">{{ ucfirst($item->status) }}</span>
                            </div>
                        </div>
                        <a target="_blank" href="{{ route( $item->slug ) }}"
                           class="mt-3 sm:mt-0 inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 sm:px-5 py-2 rounded-full shadow-sm transition font-semibold text-xs sm:text-sm w-full sm:w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            View Website
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-2 sm:gap-3 mt-3 sm:mt-4 px-4 sm:px-5 pb-4 sm:pb-5">
                        <a href="{{ route('tanent.website.edit', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-indigo-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5h2m-1 0v14m-7-7h14" />
                            </svg>Edit</a>
                        <a href="{{ route('tanent.website.destroy', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-red-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>Delete</a>
                        <a href="{{ route('tanent.website.settings', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-indigo-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>Settings</a>
                        <a href="{{ route('tanent.website.configuration', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-pink-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>Design</a>
                        <a href="{{ route('tanent.website.content', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-yellow-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9" />
                            </svg>Content</a>
                        <a href="{{ route('tanent.website.seo', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-purple-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 16h-1v-4h-1m4 0h-1v-4h-1" />
                            </svg>SEO</a>
                        <a href="{{ route('tanent.website.analytics', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-cyan-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18" />
                            </svg>Analytics</a>
                        <a href="{{ route('tanent.website.sitemap', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-gray-200 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>Sitemap</a>
                        <a href="{{ route('tanent.website.social', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-blue-50 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 8h2a2 2 0 012 2v8a2 2 0 01-2 2H7a2 2 0 01-2-2V10a2 2 0 012-2h2" />
                            </svg>Social</a>
                        <a href="{{ route('tanent.website.security', $item->id) }}"
                           class="action-btn bg-gray-100 hover:bg-red-100 text-gray-800 border border-gray-200 text-xs sm:text-base px-4 sm:px-5 py-2"><svg
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 11c0-1.104.896-2 2-2s2 .896 2 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>Security</a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-8 text-center text-gray-500">No websites found. Start by creating one!</div>
            @endforelse
        </div>
    </div>

    <style>
        .action-btn {
            @apply inline-flex items-center gap-2 rounded-full shadow-sm font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none;
        }
    </style>
@endsection
