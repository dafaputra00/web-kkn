@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Artikel & Post
        </h1>
    </div>
</div>

@if (session()->has('message'))
    <div class="w-4/5 m-auto mt-10 pl-2">
        <p class="bg-green-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl w-min">
            {{ session()->get('message') }}
        </p>
    </div>
@endif

@if (Auth::check())
    <div class="pt-15 w-4/5 m-auto">
        <a
            href="/blog/create"
            class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Buat Artikel
        </a>
    </div>
@endif

{{-- <p class="pt-10 w-4/5 m-auto">Cari Artikel :</p>
<form action="/blog/cari" method="GET" class="pt-5 w-4/5 m-auto">
	<input type="text" name="cari" placeholder="Judul Artikel .." value="{{ old('cari') }}">
	<input type="submit" value="CARI">
</form> --}}

<div class="pt-10 m-auto w-4/5 flex justify-end">
    <form action="{{ route('blog.index') }}" method="GET" role="search">
        <div class=" space-x-3">
            <input type="text" class="flex-auto border-2 border-blue-500" name="term" placeholder=" Cari Artikel" id="term">
            <span class="flex-auto">
                <button class="flex-auto w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" title="Search blog">
                    <span class="fas fa-search"></span>
                </button>
            </span>
            {{-- <a href="{{ route('blog.index') }}" class=" mt-1">
                <span class="">
                    <button class="flex-auto w-auto bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="button" title="Refresh page">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </span>
            </a> --}}
        </div>
    </form>
</div>

@foreach ($posts as $post)
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img
            class="object-contain h-full w-full"
            src="{{ asset('images/' . $post->image_path) }}"
            alt="">
        </div>
        <div>
            <h2 class="text-gray-700 font-bold text-5xl pb-4">
                {{ $post->title }}
            </h2>

            <span class="text-gray-500">
                By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
            </span>

            {{-- <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {{!! Str::limit($post->description, 100, '...')  !!}}
            </p> --}}

            <h3 class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                {!! Str::limit($post->description, 100, '...') !!}
            </h3>

            <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Baca Selanjutnya
            </a>

            @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                <span class="float-right">
                    <a
                        href="/blog/{{ $post->slug }}/edit"
                        class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                        Edit
                    </a>
                </span>

                <span class="float-right">
                     <form
                        action="/blog/{{ $post->slug }}"
                        method="POST">
                        @csrf
                        @method('delete')

                        <button
                            class="text-red-500 pr-3"
                            type="submit">
                            Hapus
                        </button>

                    </form>
                </span>
            @endif
        </div>
    </div>
@endforeach
<div class="w-4/5 m-auto">
    {{ $posts->links() }}
</div>

@endsection
