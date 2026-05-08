<x-web-layout>
    <x-slot name="title">{{ $post->title }}</x-slot>

    <div class="py-24 px-4 lg:px-10 max-w-4xl mx-auto container-1300">
        <nav class="text-sm breadcrumbs mb-12 opacity-50 font-medium">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li> 
                <li><a href="{{ route('blog.index') }}">Blog</a></li> 
                <li class="text-base-content">{{ $post->title }}</li>
            </ul>
        </nav>

        <article class="prose prose-lg lg:prose-xl max-w-none prose-headings:tracking-tighter prose-headings:font-bold prose-img:rounded-3xl prose-img:shadow-2xl">
            <header class="mb-16">
                <div class="badge badge-primary font-bold mb-4 px-4 py-3">{{ $post->category->name ?? 'Article' }}</div>
                <h1 class="text-5xl lg:text-7xl font-bold leading-[1.1] mb-8">{{ $post->title }}</h1>
                
                <div class="flex items-center gap-6 p-6 bg-base-200 rounded-3xl">
                    <div class="avatar">
                        <div class="w-16 rounded-2xl shadow-xl ring ring-primary ring-offset-base-100 ring-offset-4">
                            <img src="{{ asset('assets/images/avatar.png') }}" />
                        </div>
                    </div>
                    <div>
                        <div class="font-bold text-xl">Fabric Team</div>
                        <div class="text-base-content/50 font-medium">Published on {{ $post->created_at->format('F d, Y') }} &bull; 5 min read</div>
                    </div>
                </div>
            </header>

            <img src="{{ asset($post->featured_image ?? 'assets/images/blog_placeholder.png') }}" class="w-full h-[500px] object-cover rounded-[2.5rem] shadow-2xl mb-16" />

            <div class="text-base-content/80 leading-relaxed">
                {!! $post->content !!}
            </div>
        </article>

        <!-- Social Share -->
        <div class="mt-20 pt-10 border-t border-base-200 flex flex-col sm:flex-row items-center justify-between gap-6">
            <h4 class="text-xl font-bold italic">Share this <span class="text-primary">Article</span></h4>
            <div class="flex gap-4">
                <button class="btn btn-circle btn-primary btn-outline btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></button>
                <button class="btn btn-circle btn-secondary btn-outline btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></button>
            </div>
        </div>
    </div>
</x-web-layout>
