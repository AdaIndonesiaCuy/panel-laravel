@extends('layouts.nav')

@section('title', 'Fakecez - Dashboard')

@section('content')            
               <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4 mb-4">Mobile Legends</h1>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if(session('generatedKey'))
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    Generated Key Information
                                </div>
                                <div class="card-body">
                                    <p class="mb-3">
                                        <strong>Key:</strong>
                                        <span id="generatedKey" class="badge bg-secondary">{{ session('generatedKey.key') }}</span> 
                                        <button onclick="copyToClipboard('generatedKey')" class="btn btn-success btn-sm ms-2">
                                            <i class="fas fa-copy me-1"></i>Copy
                                        </button>
                                    </p>
                                    <p>
                                        <strong>Date Generated:</strong>
                                        {{ session('generatedKey.date_generated') }}
                                    </p>
                                    <p>
                                        <strong>Expired Date:</strong>
                                        {{ \Carbon\Carbon::parse(session('generatedKey.date_generated'))->addDays(session('generatedKey.duration'))->format('Y-m-d H:i:s') }}
                                    </p>
                                    <p>
                                        <strong>Duration:</strong>
                                        {{ session('generatedKey.duration') }} Days
                                    </p>
                                </div>
                            </div>
                        @endif
                        
                    <script>
                        function copyToClipboard(elementId) {
                            const el = document.getElementById(elementId);
                            const textArea = document.createElement("textarea");
                            textArea.value = el.innerText;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                        }
                    </script>
                    
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
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-plug"></i> Total Key Active</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        {{
                                            number_format(
                                                Auth::user()->keys()
                                                    ->where('user_id', Auth::user()->id)
                                                    ->whereRaw('date_generated + INTERVAL duration DAY > NOW()')
                                                    ->count(),
                                                0,
                                                ','
                                            )
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body"><i class="fa-solid fa-plug-circle-xmark"></i> Total Key</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        {{
                                            number_format(
                                                Auth::user()->keys()
                                                    ->where('user_id', Auth::user()->id)
                                                    ->count(),
                                                0,
                                                ','
                                            )
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa-solid fa-key"></i>
                                        Generate Key
                                    </div>  
                                    <div class="card-body">
                                        <form action="{{ route('keygen.ml') }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Select Duration</label>
                                                <select class="form-select" id="duration" name="duration" onchange="updatePrice()">
                                                    <option >-</option>
                                                    <option value="1">1 day</option>
                                                    <option value="3">3 days</option>
                                                    <option value="7">7 days</option>
                                                    <option value="30">30 days</option>
                                                    <option value="60">60 days</option>
                                                    <option value="90">90 days</option>
                                                    <option value="365">1 year</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price List</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp.</span>
                                                    <input type="text" class="form-control" id="price" name="price" readonly>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Generate Key</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa-solid fa-basket-shopping"></i>
                                        Price List
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Duration</th>
                                                        <th class="text-center">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1 day</td>
                                                        <td class="text-center">10,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3 days</td>
                                                        <td class="text-center">20,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">7 days</td>
                                                        <td class="text-center">50,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">30 days</td>
                                                        <td class="text-center">100,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">60 days</td>
                                                        <td class="text-center">150,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">90 days</td>
                                                        <td class="text-center">200,000</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">1 year</td>
                                                        <td class="text-center">1,000,000</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <script>
                        function updatePrice() {
                            var durationSelect = document.getElementById('duration');
                            var priceInput = document.getElementById('price');
                    
                            var selectedDuration = durationSelect.options[durationSelect.selectedIndex].value;
                    
                            // You can map the duration to the corresponding price here
                            var priceMapping = {
                                '1': 10000,
                                '3': 20000,
                                '7': 50000,
                                '30': 100000,
                                '60': 150000,
                                '90': 200000,
                                '365': 1000000,
                            };
                    
                            // Set the price in the input field
                            priceInput.value = priceMapping[selectedDuration];
                        }

                        function copyToClipboard(elementId) {
                                const el = document.getElementById(elementId);
                                const textArea = document.createElement("textarea");
                                textArea.value = el.innerText;
                                document.body.appendChild(textArea);
                                textArea.select();
                                document.execCommand('copy');
                                document.body.removeChild(textArea);
                            }
                    </script>
                </main>
@endsection
