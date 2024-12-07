@extends('admin.layouts.app')
@section('title', 'Admin | Products')
@section('nav-link')
    <a href="#" class="nav-link disabled">Products</a>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}">
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <h3 class="ml-auto">Products</h3>

                            <button type="button" class="btn btn-primary ml-auto" onclick="createProduct(this)"
                                data-target="commonModal">Create</button>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="product" class="table table-striped display nowrap " style="width:100%">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>
                                            <input type="checkbox" class="w-2 h-2 check-all" />
                                        </th>
                                        <th>Name</th>
                                        <th>Product Code</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class=" overflow-stick">


                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->




    </section>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/product/index.js') }}"></script>
    <script src="{{ asset('admin/common.js') }}"></script>
    <script src="{{ asset('admin/formsubmit.js') }}"></script>



@endsection
