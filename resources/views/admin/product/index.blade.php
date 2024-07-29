@extends('layouts.managerment')
@section('title', 'Manager Product')
@section('read_product')
    <div id="read_product">
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>ShortDesc</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sold</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                    @php
                        $image = json_decode($item->image)[0];
                    @endphp
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td class="thumnail">
                            <img src="{{ asset('uploads') }}/{{ $image }}" alt="">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td style="text-align: left">{{ $item->shortdesc }}</td>
                        <td>{{ number_format($item->price, 0) }}đ</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->sold }}</td>
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
