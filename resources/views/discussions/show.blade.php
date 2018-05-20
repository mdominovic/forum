@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ $d->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
            <span>{{ $d->user->name }}, <b>{{ $d->created_at->diffForHumans() }}</b></span>
            <a href="{{ route('discussion', ['slug' => $d->slug ]) }}" class="btn btn-default pull-right">view</a>
        </div>

        <div class="panel-body">
            <h4 class="text-center">
                <b>{{ $d->title }}</b>
            </h4>
            <hr>
            <p class="text-center">
                {{ $d->content }}
            </p>
        </div>
        <div class="panel-footer">
            <p>
                {{ $d->replies->count() }} Replies
            </p>
        </div>
    </div>

    @foreach($d->replies as $r)
        <div class="panel panel-default">
            <div class="panel-heading">
                <img src="{{ $r->user->avatar }}" alt="" width="40px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{ $r->user->name }}, <b>{{ $r->created_at->diffForHumans() }}</b></span>
            </div>

            <div class="panel-body">
                <p class="text-center">
                    {{ $r->content }}
                </p>
            </div>
            <div class="panel-footer">
                <p>
                    LIKE
                </p>
            </div>
        </div>
    @endforeach
@endsection
