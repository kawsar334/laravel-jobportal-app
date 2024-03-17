@extends('layout.app')



@section('main')



<p>id:{{$job->id}}</p>
<p>job title:{{$job->title}}</p>


@endsection


@section(' customjs') <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

</script>


@endsection