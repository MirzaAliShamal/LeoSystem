@extends('layouts.admin')



@section('content')
    <!-- Page content area start -->

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="breadcrumb__content">

                        <div class="breadcrumb__content__left">

                            <div class="breadcrumb__title">

                                <h2>{{__('Teachers')}}</h2>

                            </div>

                        </div>

                        <div class="breadcrumb__content__right">

                            <nav aria-label="breadcrumb">

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a
                                            href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>

                                    <li class="breadcrumb-item active"
                                        aria-current="page">{{__('Teachers Blocking History')}}</li>

                                </ul>

                            </nav>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="customers__area bg-style mb-30">

                        <div class="item-title d-flex justify-content-between">

                            <h2>{{__('Teachers Blocking History')}}</h2>

                        </div>

                        <div class="customers__table">

                            <table id="customers-table" class="row-border data-table-filter table-style">

                                <thead>
                                    <tr>
                                        <th>{{__('Blocked By')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Message')}}</th>
                                        <th>{{__('Date')}}</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($blocked_teachers as $row)
                                        <tr class="removable-item">
                                            <td>
                                                {{ $row->blocked_by_user->name }}<br>
                                                Email: {{ $row->blocked_by_user->email }}
                                            </td>
                                            <td>
                                                Account: <span class="{{ $row->status == 1 ? 'text-success' : 'text-danger' }}">{{ $row->status == 1 ? 'Unblocked' : 'Blocked' }}</span><br>
                                                Student ID: LS{{ $row->blocked_user?->id }}T<br>
                                                Email: {{ $row->blocked_user?->email }}
                                            </td>
                                            <td>{{$row->message}}</td>
                                            <td>{{$row->created_at}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                            <div class="mt-3">

                                {{ $blocked_teachers->links() }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

    <!-- Page content area end -->

@endsection



@push('style')

    <link rel="stylesheet" href="{{asset('admin/css/jquery.dataTables.min.css')}}">

@endpush



@push('script')

    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>

    <script src="{{asset('admin/js/custom/data-table-page.js')}}"></script>

    <script src="{{ asset('admin/js/custom/instructor-delete.js') }}"></script>

@endpush

