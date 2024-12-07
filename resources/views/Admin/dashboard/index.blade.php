@extends('admin.layouts.app')
@section('title', 'Admin | user')
@section('nav-link')
    <a href="#" class="nav-link disabled">User</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <h1>dashboard</h1>
    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/dashboard/index.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>
@endsection
