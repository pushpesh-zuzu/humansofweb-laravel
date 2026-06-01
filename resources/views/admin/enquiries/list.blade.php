@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <table id="cityTable" class="table table-bordered table-striped">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/admin/scripts/enquiries.js') }}"></script>
<script>
    $(document).ready(function() {
        var url = $("#_url").val();
       
       
        var table = $("#cityTable").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: url + "/admin/enquiries",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: '#',
                    orderable: false,
                    searchable: false,
                    width: '5%' // Set width to 5%
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                },
                
                
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email',

                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone',
                },
                {
                    data: 'website_url',
                    name: 'website_url',
                    title: 'Website',
                },
                {
                    data: 'service_intrested',
                    name: 'service_intrested',
                    title: 'Int. Services',
                },
                {
                    data: 'monthly_budget',
                    name: 'monthly_budget',
                    title: 'Monthly Budget',
                },
                {
                    data: 'designation',
                    name: 'designation',
                    title: 'Designation',
                },
                {
                    data: 'about',
                    name: 'about',
                    title: 'About',
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Date',
                }
            ]
        });




    });
</script>
@endsection