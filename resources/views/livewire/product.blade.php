@section('content')
<div class="container">
    <div class="row">
        @foreach ($products as $item )
        <div class="col mt-4">
            <image src='{{ $item->image }}' class="w-50 h-50"></image>
            <p>{{ $item->Product_name }}</p>
            <h4>${{ $item->price }}</h1>
        </div>
        @endforeach
    </div>
    <div>
        <form wire:submit.prevent="checkout">
            <button type="submit" class="btn btn-primary">Check out</button>
        </form>
    </div>
</div>
@endsection