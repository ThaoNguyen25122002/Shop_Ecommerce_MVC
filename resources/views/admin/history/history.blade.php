@extends('admin.layouts.app')

@section('content')
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Basic Table</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Default Table</h4>
                                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Mã hoá đơn</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Product and Qty</th>
                                                <th scope="col">Tông tiền</th>
                                                <th scope="col">Thời gian đặt hàng</th>
                                                <th scope="col">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($histories as $history)
                                        <tr>
                                            <th scope="row">{{ $history->id }}</th>
                                            <td>{{ $history->email }}</td>
                                            <td>{{ $history->phone }}</td>
                                            <td>{{ $history->name }}</td>
                                            <td>{{ json_decode($history->price) }}</td>
                                            <td>{{ $history->created_at }}</td>
                                            <td>
                                                <a href="">Duyệt</a>
                                                <a href="">Chỉnh sửa</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-sm-12">
                                <a href="" class="btn btn-success" style="color: white">Add Country</a>
                            </div>
                        </div> -->
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
@endsection()