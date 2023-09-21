@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Create UMKM
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="w-4/5 m-auto pt-20">
        <form
            action="/umkm"
            method="POST"
            enctype="multipart/form-data">
            @csrf

            <input
                type="text"
                name="title"
                placeholder="Judul..."
                class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

            <input
                type="text"
                name="phone"
                placeholder="Nomor WA"
                class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

            <textarea
                name="description"
                placeholder="Deskripsi..."
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none"
                id="deskripsi-text"></textarea>

            <div class="bg-grey-lighter pt-15">
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer rounded-3xl">
                    <span class="mt-2 text-base leading-normal">
                        Pilih Foto
                    </span>
                    <input
                        type="file"
                        name="image"
                        class="hidden">
                </label>
            </div>

            <button
                type="submit"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Submit
            </button>
        </form>
    </div>
@endsection


@section('scripts')
<script>
    ClassicEditor
        .create( document.querySelector( '#deskripsi-text' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
