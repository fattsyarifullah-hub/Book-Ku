<div>
    <a href="{{ route('dashboard.book.create') }}">Create new Book</a>
    <p>index book</p>

    @foreach ($allbook as $item)
        <h1>{{$item->title}}</h1>
        <p>{{$item->description}}</p>
        <img src="{{ asset('storage/imagebook/' . $item->image) }}" alt="">
        <a href="{{ route('dashboard.book.show', $item->id) }}">Detail</a>
        <a href="{{ route('dashboard.book.edit', $item->id) }}">Edit</a>
        <form action="{{ route('dashboard.book.destroy', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"> Delete</button>
        </form>
    @endforeach
</div>
