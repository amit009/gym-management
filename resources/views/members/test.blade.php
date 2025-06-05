
<x-app-layout>
<h1>Helo Bro</h1>

@foreach ($collection->chunk(3) as $chunk)
    <div class="row">
        @foreach ($chunk as $product)
            <div class="col-xs-4">{{ $product }}</div>
        @endforeach
    </div>
@endforeach
</x-app-layout>