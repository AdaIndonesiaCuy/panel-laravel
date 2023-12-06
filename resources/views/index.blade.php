@extends('layouts.nav')

@section('title', 'Fakecez - Dashboard')

@section('content')            
               <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <div class="rounded bg-secondary p-2 text-white">
                                    <div class="mb-2">
                                        <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
                                        @if (Auth::user()->role == 'user' or Auth::user()->role == null)  
                                            @if (Auth::user()->spent < 1000000)  
                                                <div class="badge bg-info">
                                                    <i class="fa-solid fa-star-half-stroke"></i> RESELLER
                                                </div>
                                            @elseif (Auth::user()->spent >= 1000000 and Auth::user()->spent < 2000000)  
                                                <div class="badge bg-primary">
                                                    <i class="fa-solid fa-star"></i> RESELLER++
                                                </div>
                                            @elseif (Auth::user()->spent >= 2000000)  
                                                <div class="badge bg-success">
                                                    <i class="fa-solid fa-ranking-star"></i> TOP RESELLER
                                                </div>
                                            @endif
                                            @if (Auth::user()->balance >= 1000000)  
                                            <div class="badge bg-success">
                                                <i class="fa-solid fa-crown"></i> SULTAN
                                            </div>
                                            @endif
                                        @else
                                            <div class="badge bg-danger">
                                                Role: {{ Auth::user()->role }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-money-bill-wave"></i> Balance</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        Rp. {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-money-bill-transfer"></i> Total Spent</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        Rp. {{ number_format(Auth::user()->spent, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-chart-line"></i> Total Profit</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        Rp. {{ number_format(Auth::user()->profit, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-cart-arrow-down"></i> Total Transaction</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        {{ number_format(Auth::user()->profit, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Transaction Chart
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Profit Chart
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Key Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Game</th>
                                            <th>Key</th>
                                            <th>Expired</th>
                                            <th>Duration</th>
                                            <th>Max Device</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Game</th>
                                            <th>Key</th>
                                            <th>Expired</th>
                                            <th>Duration</th>
                                            <th>Max Device</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach(Auth::user()->keys as $key)
                                            @php
                                                $expirationDate = $key->date_generated->addDays($key->duration);
                                                $isExpired = now()->greaterThan($expirationDate);
                                            @endphp
                                            <tr @if($isExpired) class="text-danger" @endif>
                                                <td>{{ $key->game }}</td>
                                                <td>{{ $key->key }}</td>
                                                <td>{{ $expirationDate->format('m/d/Y') }}</td>
                                                <td>{{ $key->duration . 'd' }}</td>
                                                <td>{{ $key->max_device }}</td>
                                                @if ($isExpired)
                                                <td>
                                                    <div class="badge bg-danger">
                                                        <i class="fa-solid fa-circle-xmark"></i> EXPIRED
                                                    </div>
                                                </td>
                                                </td>
                                                @else
                                                <td>
                                                    <div class="badge bg-success">
                                                        <i class="fa-solid fa-circle"></i> ACTIVE
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
@endsection
