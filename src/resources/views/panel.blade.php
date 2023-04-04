@extends('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Main Functions</div>

                <div class="card-body">
                        <div class="alert alert-success" role="alert">
                        </div>


                    <div class="row text-center">

                        <div class="col-sm-4">
                            <a href="/management">
                                <h4>Managment</h4>
                                <img width="50px" src="{{asset('images/report.png')}}"/>
                            </a>
                        </div>

                        <div class="col-sm-4">
                            <a href="/cashier">
                                <h4>Cashier</h4>
                                <img width="50px" src="{{asset('images/report.png')}}"/>
                            </a>
                        </div>

                        <div class="col-sm-4">
                            <a href="/report">
                                <h4>Report</h4>
                                <img width="50px" src="{{asset('images/report.png')}}"/>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>