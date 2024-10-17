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

                                <h2>{{__('Organizations')}}</h2>

                            </div>

                        </div>

                        <div class="breadcrumb__content__right">

                            <nav aria-label="breadcrumb">

                                <ul class="breadcrumb">

                                    <li class="breadcrumb-item"><a
                                            href="{{route('admin.dashboard')}}">{{__('Dashboard')}}</a></li>

                                    <li class="breadcrumb-item active"
                                        aria-current="page">{{__('Organizations Blocking History')}}</li>

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

                            <h2>{{__('Organizations Blocking History')}}</h2>

                        </div>

                        <div class="customers__table">

                            <table id="customers-table" class="row-border data-table-filter table-style">

                                <thead>

                                <tr>


                                    <th>{{__('Blocked By')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Message')}}</th>
                                    <th>{{__('Date')}}</th>

{{--                                    <th class="text-center">{{__('Action')}}</th>--}}

                                </tr>

                                </thead>

                                <tbody>

                                @foreach($blocked_organizations as $row)
                                    <tr class="removable-item">
                                        <td>
                                            {{ $row->blocked_by_user->name }}<br>
                                            Email: {{ $row->blocked_by_user->email }}
                                        </td>
                                        <td>
                                            Account: <span class="{{ $row->status == 1 ? 'text-success' : 'text-danger' }}">{{ $row->status == 1 ? 'Unblocked' : 'Blocked' }}</span><br>
                                            Student ID: LS{{ $row->blocked_user?->id }}OR<br>
                                            Email: {{ $row->blocked_user?->email }}
                                        </td>
                                        <td>{{$row->message}}</td>
                                        <td>{{$row->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                            <div class="mt-3">

                                {{$blocked_organizations->links()}}

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

    <script>

        'use strict'

        $(".change-status").change(function () {

            var id = $(this).closest('tr').find('#hidden_id').html();

            var status_value = $(this).closest('tr').find('.status option:selected').val();

            Swal.fire({

                title: "{{ __('Are you sure to change status?') }}",

                text: "{{ __('You won`t be able to revert this!') }}",

                icon: "warning",

                input: "text",

                inputPlaceholder: 'You need to write something!',

                inputAttributes: {
                    autocapitalize: "off"
                },

                showCancelButton: true,

                confirmButtonText: "{{__('Yes, Change it!')}}",

                cancelButtonText: "{{__('No, cancel!')}}",

                reverseButtons: true

            }).then(function (result) {

                if (result.value) {

                    $.ajax({

                        type: "POST",

                        url: "{{route('organizations.changeOrganizationStatus')}}",

                        data: {
                            "status": status_value,
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                            "status_message":result.value
                        },

                        datatype: "json",

                        success: function (res) {

                            toastr.options.positionClass = 'toast-bottom-right';

                            if (res.status == true) {

                                toastr.success('', res.message);

                            } else {

                                toastr.error('', res.message);

                            }

                        },

                        error: function (error) {

                            toastr.options.positionClass = 'toast-bottom-right';

                            toastr.error('', JSON.parse(error.responseText).message);

                        },

                    });

                } else if (result.dismiss === "cancel") {

                }else{
                    Swal.fire("You need to write something!");
                    return false
                }

            });

        });


        $(".change-auto-content").change(function () {

            var id = $(this).closest('tr').find('#hidden_id').html();

            var status_value = $(this).closest('tr').find('.status option:selected').val();

            Swal.fire({

                title: "{{ __('Are you sure to change?') }}",

                icon: "warning",

                showCancelButton: true,

                confirmButtonText: "{{__('Yes, Change it!')}}",

                cancelButtonText: "{{__('No, cancel!')}}",

                reverseButtons: true

            }).then(function (result) {

                if (result.value) {

                    $.ajax({

                        type: "POST",

                        url: "{{route('organizations.changeAutoContentStatus')}}",

                        data: {"auto_content_approval": status_value, "id": id, "_token": "{{ csrf_token() }}",},

                        datatype: "json",

                        success: function (data) {

                            toastr.options.positionClass = 'toast-bottom-right';

                            toastr.success('', "{{ __('Auto content status has been updated') }}");

                            location.reload();

                        },

                        error: function () {

                            alert("Error!");

                        },

                    });

                } else if (result.dismiss === "cancel") {

                    location.reload();

                }

            });

        });

    </script>

@endpush

