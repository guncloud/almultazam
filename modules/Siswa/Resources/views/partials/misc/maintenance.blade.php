@extends('siswa::layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/pages/maintenance.css') }}">
    <style>
        .page{
            padding-top: 120px;
        }
    </style>
@stop

@section('content')

<!-- Page -->
    <div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
         data-animsition-out="fade-out">>
        <div class="page-content vertical-align-middle">
            <i class="icon wb-settings icon-spin page-maintenance-icon" aria-hidden="true"></i>
            <h2>Working On</h2>
            <p>PLEASE GIVE US A MOMENT TO SORT THINGS OUT</p>

            <footer class="page-copyright">
                <p>WEBSITE BY amazingSurge</p>
                <p>© 2015. All RIGHT RESERVED.</p>
            </footer>
        </div>
    </div>
<!-- End Page -->

@stop