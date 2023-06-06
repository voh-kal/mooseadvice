@extends('layouts.admin')
@section('content')

<div>
    <div class="row no-gutters align-items-baseline">
        <div class="col-md-10 col-6 mt-5 mb-4">
            <div class="h5 font-weight-bold text-dark">All Users</div>
        </div>
        <div class="ml-auto">
            <button class="btn btn-success mt-3 mb-3" data-target="#create" data-toggle="modal">Create</button>
        </div>
        @include('flash')
    </div>
    <div>
        <table class="table" id="">
            <thead style="background: #fff7f4">
                <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($all_information) > 0)
                @php $count = 1; @endphp
                @foreach($all_information as $all)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$all->title}}</td>
                    <td>{{$all->slug}}</td>
                    <td>{{$all->description}}</td>
                    <td style='white-space: nowrap'>
                        <a class="btn btn-approved edit" style="padding: 2px;" data-target="#editcreate{{$all->id}}" data-toggle="modal">Edit</a>
                        <a class="btn btn-approved" style="padding: 2px;" href="/delete/{{base64_encode($all->id)}}">Delete</a>
                    </td>
                </tr>


                <div class="modal fade" id="editcreate{{$all->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/edit/content/{{base64_encode($all->id)}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control" value="{{$all->title}}">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="">Slug</label>
                                            <input type="text" name="slug" class="form-control" value="{{$all->slug}}">
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label for="">Description</label>
                                            <textarea name="description" cols="30" rows="4" class="form-control" value="{{$all->description}}">{{$all->description}}</textarea>
                                        </div>
                                    </div>
                                    <button type='submit' class="btn btn-success mt-3">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <tr>
                    <td colspan="6" class="text-center">
                        <img src="/image/spinner.gif" alt="no-data" style="width: 100px; margin: 25px;">
                        <p class="no-data">No data available in table</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formId">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="">Slug</label>
                            <input type="text" name="slug" class="form-control" id="slug">
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="">Description</label>
                            <textarea name="description" cols="30" rows="4" class="form-control" id="description"></textarea>
                        </div>
                    </div>
                    <button type='button' class="btn btn-success mt-3" id="createform">Submit</button>
                </form>

            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
    $('#createform').click(function(event) {
        var form = new FormData();
        var title = $('#title').val()
        var slug = $('#slug').val()
        var description = $('#description').val()

        form.append("title", title);
        form.append("slug", slug);
        form.append("description", description);

        var settings = {
            "url": "/api/create-form",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": form
        };

        $.ajax(settings).done(function(response) {
            if (response.status = 200) {
                alert('content created successfully')
                window.location.reload()
            }
        });
    });
</script>


@endsection