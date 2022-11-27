@extends('layout')

@section('content')
@include('partial._hero')
@include('partial._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@unless (count($listings) == 0)
@foreach ($listings as $item)
<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{$item->logo? asset('storage/'.$item->logo) : asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$item->id}}">{{$item->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$item->company}}</div>
            <ul class="flex">
                @php
                    $tags_arr = explode(',',$item->tags);   
                @endphp
                @foreach($tags_arr as $tag)
                <li
                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                >
                    <a href="/?tag={{$tag}}">{{$tag}}</a>
                </li>
                @endforeach
            </ul>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$item->location}}
            </div>
        </div>
    </div>
</div>
@endforeach
    
@else
    <h3>No record found!</h3>
@endunless
</div>
<div class="mt-6 p-4">
    {{ $listings->links() }}
</div>
@endsection