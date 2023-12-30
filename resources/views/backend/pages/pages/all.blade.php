@extends('backend.master')
@section('title','All Page')
@section('content')

<div class="container mt-5">
    <div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Create a page:</h5>
        <div class="mt-3 mx-3">
            <a class="btn btn-dark" href="{{route('admin.add.page')}}">Add Page</a>
        </div>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr class="bg-dark ">
                    <th>SL</th>
                    <th>Title</th>
                    <th>Slug/URL</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->slug}}</td>
                    <td> <small class="{{$item->status=='active'?'badge bg-success mt-2':'badge bg-warning mt-2'}}"> {{$item->status}}</small></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                               <a class="dropdown-item" href="{{route('page.edit',$item->id)}}"><i class="bx bx-edit-alt me-1"> Edit</i> </a>
                               <a class="dropdown-item" target="__blank" href="{{route('pages',$item->slug)}}"><i class="bx bx-show-alt me-1"> Preview</i> </a>
    
                              <form id="deleteForm" action="{{route('page.delete')}}" method="post">
                                @csrf
                                <input type="hidden" name="delete_id" value="{{$item->id}}">
                              <button type="submit" onclick="return confirm('Are you suer to delete it?')" class="dropdown-item" id="delete"><i class="bx bx-trash me-1"></i> Delete</button>
                            </form>
                            </div>
                          </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-dark ">
                    <th>SL</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
</div>
@endsection