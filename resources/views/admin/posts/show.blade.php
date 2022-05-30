@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- image --}}
                @if ($post->image)
                    <div class="col">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid">
                    </div>
                @endif

                <div class="col">
                    <h1>{{ $post->title }}</h1>
                    <b>{{ $post->user->name }}</b>
                    <small>Data pubblicazione: {{ date('d/m/Y' , strtotime($post->created_at)) }}</small>
                </div>


                {{-- if post updated --}}
                @if ($post->created_at != $post->updated_at)
                    <div class="col">
                        <small>Data ultima modifica: {{ date('d/m/Y' , strtotime($post->updated_at)) }}</small>
                    </div>
                @endif

                {{-- info user --}}
                @if ($post->user->infouser && $post->user->infouser->phone)
                    <div class="col">
                        <b>tel. {{ $post->user->infouser->phone }}</b>
                        <h4><span class="badge bg-primary">{{ $post->category->name }}</span></h4>
                    </div>
                @endif

                {{-- category --}}
                @if ($post->category)
                <div class="col">
                    <span class="badge bg-primary">{{ $post->category->name }}</span>
                </div>
                @endif

                {{-- tags --}}
                @if ($post->tags)
                    <div class="col">
                        @foreach ($post->tags as $tag)
                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="col">
                    <p>{{ $post->content }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
