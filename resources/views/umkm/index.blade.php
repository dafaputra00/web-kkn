@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            List UMKM Desa Tritih Wetan
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
            href="/umkm/create"
            class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
            Buat UMKM
        </a>
    </div>
@endif

<div class="pt-10 m-auto w-4/5 flex lg:justify-end justify-center">
    <form action="{{ route('umkm.index') }}" method="GET" role="search">
        <div class="space-x-2">
            <input type="text" class="flex-auto border-2 border-blue-500" name="term" placeholder=" Cari UMKM" id="term">

            <span class="flex-auto ">
                <button class="flex-auto w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" title="Cari atau Refresh UMKM">
                    <span class="fas fa-search"></span>
                </button>
            </span>
            {{-- <a href="{{ route('umkm.index') }}" class="">
                <span class="">
                    <button class="flex-auto w-auto bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" type="button" title="Refresh">
                        <span class="fas fa-sync-alt"></span>
                    </button>
                </span>
            </a> --}}
        </div>
    </form>
</div>

<div class="container my-12 mx-auto px-4 md:px-12">
    <div class="flex flex-wrap -mx-1 lg:-mx-4">
        @foreach ($umkms as $umkm)
        <!-- Column -->
        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3 gri">

            <!-- Article -->
            <article class="overflow-hidden rounded-lg shadow-lg">

                <a href="/umkm/{{ $umkm->slug }}">
                    <img alt="Gambar UMKM" class="block w-full sm:h-auto md:h-52 lg:h-60" src="{{ asset('images-umkm/' . $umkm->image_path) }}">
                </a>

                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <h1 class="text-lg">
                        <a class="no-underline hover:underline text-black" href="/umkm/{{ $umkm->slug }}">
                            {{ $umkm->title }}
                        </a>
                    </h1>
                    <p class="text-grey-darker text-sm">
                        {{ date('d/m/Y', strtotime($umkm->updated_at)) }}
                    </p>
                </header>

                <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                    <a class="flex items-center no-underline hover:underline text-black" href="https://wa.me/{{ $umkm->phone }}">
                        <img alt="Wa"
                        class="block rounded-full lg:h-10 max-w-2xl h-8"
                        src="https://cdn.pixabay.com/photo/2017/11/10/05/05/whatsapp-2935415_960_720.png">
                        {{-- <i class="fab fa-whatsap block rounded-full"></i> --}}
                        <p class="ml-2 text-sm">
                            Kontak WA
                            {{-- {{ $umkm->user->name }} --}}
                        </p>
                    </a>
                    <div class="float-left">
                        @if (isset(Auth::user()->id) && Auth::user()->id == $umkm->user_id)
                            <a class="no-underline text-gray-700 italic hover:text-gray-900" href="/umkm/{{ $umkm->slug }}/edit">
                                Edit
                            </a>
                            <form
                                action="/umkm/{{ $umkm->slug }}"
                                method="POST">
                                @csrf
                                @method('delete')

                                <button
                                    class="text-red-500 pr-3 pt-3"
                                    type="submit">
                                    Hapus
                                </button>

                            </form>
                        @endif
                    </div>
                </footer>

            </article>
            <!-- END Article -->

        </div>
        <!-- END Column -->
        @endforeach
    </div>
</div>


<div class="w-4/5 m-auto">
    {{ $umkms->links() }}
</div>

@endsection
