@extends('layouts.app')
<head>
    <link href="{{ asset("css/bg.css") }}" rel="stylesheet">
</head>

@section('content')
    <div class="background-image grid grid-cols-1 m-auto">
        <div class="flex text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                <h1 class="sm:text-white text-5xl uppercase font-bold text-shadow-md pb-14">
                    KKN Kel 105 Tritih Wetan
                </h1>
                <a
                    href="/blog"
                    class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase rounded-3xl">
                    Read More
                </a>
            </div>
        </div>
    </div>

    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="https://cdn.pixabay.com/photo/2017/09/07/08/54/money-2724241_960_720.jpg" width="700" alt="">
        </div>

        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-3xl font-extrabold text-gray-600">
                Yuk, Cek UMKM Di Desa Tritih Wetan!
            </h2>

            <p class="py-8 text-gray-500 text-s">
                Siapa tahu ada yang cocok dengan kebutuhanmu.
            </p>

            <p class="font-extrabold text-gray-600 text-s pb-9">
                Bangkitkan UMKM, Bantu Pulihkan Ekonomi Indonesia! (≧∇≦)ﾉ
            </p>

            <a
                href="/umkm"
                class="uppercase bg-blue-500 text-gray-100 text-s font-extrabold py-3 px-8 rounded-3xl">
                Buka UMKM
            </a>
        </div>
    </div>

    <div class="text-center p-15 bg-black text-white">
        <h2 class="text-2xl pb-5 text-l">
            Lokasi KKN
        </h2>

        <span class="font-extrabold block text-4xl py-1">
            Desa Tritih Wetan,
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Kecamatan Jeruklegi,
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Kabupaten Cilacap,
        </span>
        <span class="font-extrabold block text-4xl py-1">
            Provinsi Jawa Tengah.
        </span>
    </div>

    <div class="text-center py-15">
        <span class="uppercase text-s text-gray-400">
            Artikel & Post
        </span>

        <h2 class="text-4xl font-bold py-10">
            Postingan Terbaru
        </h2>

        {{-- <p class="m-auto w-4/5 text-gray-500">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque exercitationem saepe enim veritatis, eos temporibus quaerat facere consectetur qui.
        </p> --}}
    </div>

    <div class="sm:grid grid-cols-2 w-4/5 m-auto">
        <div class="flex bg-yellow-700 text-gray-100 pt-10">
            <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block">
                <span class=" font-bold text-5xl pb-4">
                    {{ $terbaru->title }}
                </span>

                <h3 class="text-xl pt-8 pb-10 leading-8 font-light">
                    {!! Str::limit($terbaru->description, 100, '...') !!}
                </h3>

                <a
                    href="/blog/{{ $terbaru->slug }}"
                    class="uppercase bg-transparent border-2 border-gray-100 text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                    Buka Artikel
                </a>
            </div>
        </div>
        <div>
            <img src="{{ asset('images/' . $terbaru->image_path) }}" alt="">
        </div>
    </div>
@endsection
