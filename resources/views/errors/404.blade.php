@extends('layouts.app')

@section('content')

    <main>
        <h1 class="text-center m-5">Ops !! Questa pagina non è stata trovata ...</h1>
        <div class="uppercase d-flex justify-content-center ">
            <button type="button" name="button" class="btn btn-deliveroo">
                <a href=" {{ route("uiHome")}}">Homepage</a>
            </button>
        </div>

    </main>

@endsection
