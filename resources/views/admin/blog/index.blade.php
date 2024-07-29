@extends('layouts.managerment')
@section('title', 'Manager Blog')
@section('read_blog')
    <h1>đây là blog</h1>
    <div id="read_product">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>ShortContent</th>
                    <th>Status</th>
                    <th> Outstand</th>
                    <th>View</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blog as $item)
                    <td class="thumnail"><img src="{{ asset('uploads/blog') }}/{{ $item->photo }}" alt=""></td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td style="text-align: left">{{ $item->shortcontent }}</td>
                    <td>{{ $item->post_status }}</td>
                    <td>{{ $item->post_outstand }}</td>
                    <td>{{ $item->view }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <button>Delete</button>
                        <button>Update</button>
                    </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
