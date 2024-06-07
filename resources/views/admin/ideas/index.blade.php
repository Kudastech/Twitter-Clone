@extends('layout.app')
@section('title', 'Ideas | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            <h1>Ideas</h1>
            {{-- <div style="float:right">
                <form action="#" method="GET" enctype="multipart/form-data" class="mt-2">
                    @csrf

                    <input class="form-control" id="search" type="text">

                    <div class="mb-3 mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>
            </div> --}}
            <table class="table table-striped mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ideas as $idea)
                        <tr>
                            <td>{{ $idea->id }}</td>
                            <td>
                                <a href="{{ route('users.show', $idea->user) }}">
                                    {{ $idea->user->name }}
                                </a>
                            </td>
                            <td>{{ Str::words($idea->content, 10) }}</td>
                            <td>{{ $idea->created_at->toDateString() }}</td>
                            <td>
                                <a href="{{ route('ideas.show', $idea) }}">View</a>
                                <a href="{{ route('ideas.edit', $idea) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{ $ideas->links() }}
            </div>
        </div>
    </div>
@endsection


@section('script')

<script type="text/javascript">
    var path = "{{ route('admin.autocomplete') }}";
    $( "#search" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
           console.log(ui.item);
           return false;
        }
      });

</script>

@endsection
