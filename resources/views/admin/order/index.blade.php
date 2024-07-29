@extends('layouts.managerment')
@section('title', 'Manager Order')
@section('read_order')
    <div id="read_product">
        <table>
            <thead>
                <tr>
                    <th>OrderCode</th>
                    <th>FullName</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Payment method</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Purchase date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <td>{{ $item->ordercode }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->payment_method }}</td>
                    <td>{{ $item->cartlist }}</td>
                    <td>{{ $item->status }}</td>
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
