<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <style>
        .border-bottom{
            border-bottom:1px solid #ccc!important
        }
        .logo-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content:center;
        }

        .logo {
            width: 3%;
            height: auto;
        }

        .logo-title {
            margin-left: 40px; 
            font-size: 30px; 
            font-weight: bold; 
        }
        .small-column {
            width: 10%;
        }
        th.title {
            font-size: 20px; 
            font-weight: bold; 
        } 
        table, th, td {
            border: 1px solid;
            outline: thin solid;
        }   
    </style>
    
    <!-- Scripts -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar">
            <div class="logo-container">
                <!-- Assuming the image is in the public/images directory -->
                <table class="table table-bordered">
                    <tr>
                        <th rowspan="4" style="text-align: center"><img src="{{ asset('sawitkinabalu.png') }}" style="width:150px;height:80px;" alt="Sawit Kinabalu"></th>
                        <th style="text-align: center">FORM</th>  
                        <th>No. Dokumen</th>
                        <th>SKG/OSH/FRM-10</th>
                    </tr>

                    <tr>
                        <td rowspan="3" style="text-align: center"><span class="logo-title">Self-Workplace Inspection Form - {{ $subplanning->operatingUnits->map(function($ou) { return $ou->type; })?->implode(', ') }}</span></td> 
                        <td>LADANG</td>
                        <td>No Pindaan</td>
                    </tr>
                    <tr>
                        <td>Tarikh Kuatkuasa</td>
                        <td>3hb Jun 2020</td>
                    </tr>
                    <tr>
                        <td>Mukasurat</td>
                        <td>1/1</td>    
                    </tr>
                </table>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                {{-- OperatingForm and MainWorkForm --}}
                <a class="btn btn-primary mb-3 hide-in-print" href="#" onclick="window.print()">Print</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="text-align:center;">No</th>
                            <th colspan="2" style="text-align:center">Compliance Status</th>
                        </tr>
                        <tr style="text-align:center">
                            <td>1</td>
                            <td>BAIK</td>
                            <td>100% Keperluan / Kehendak Dipatuhi</td>
                        </tr>
                        <tr style="text-align:center">
                            <td>2</td>
                            <td>TIDAK BAIK</td>
                            <td>50% Keperluan / Kehendak Dipatuhi</td>
                        </tr>
                        <tr style="text-align:center">
                            <td>3</td>
                            <td>TIDAK BERKAITAN</td>
                            <td>0% Keperluan / Kehendak Dipatuhi</td>
                        </tr>
                    </table>

                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4">Operating Unit: {{ $subplanning->operatingUnits->map(function($ou) { return $ou->name; })?->implode(', ') }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">Tarikh Pemeriksaan:  {{ \Carbon\Carbon::parse($subplanning->start_date)->format('jS F Y') }} </th>
                            <th colspan="2">Masa Pemeriksaan:   {{ \Carbon\Carbon::parse($subplanning->end_date)->format('jS F Y') }}</th>
                        </tr>
                        <tr>
                            <th width="150px" style="text-align:center;">No</th>
                            <th width="450px" style="text-align:center;">Name</th>
                            <th width="80px" style="text-align:center;">Compliance Status</th>
                            <th width="460px" style="text-align:center;">Comment</th>
                        </tr>
                        <!-- ... Existing HTML code ... -->

                        <!-- ... Other rows ... -->
                        @foreach ($executions as $key => $execution)
                            <tr>
                                <td style="text-align: center;">{{ $key + 1 }}</td>
                                <td>{{ $execution->inspection->name }}</td>
                                <td>{{ $execution->status }}</td>
                                <td>{{ $execution->comment }}</td>
                            </tr>
                            @foreach ($execution->inspection->children as $child)
                                <tr>
                                    <td style="text-align: center;">{{  chr(ord('a') + $loop->index) }}</td>
                                    <td>{{ $child->name }}</td>
                                    <td>{{ $child->status }}</td>
                                    <td>{{ $child->comment }}</td>
                                </tr>
                                @foreach ($child->children as $grandChild)
                                    <tr>
                                        <td style="text-align: center;"></td>
                                        <td>{{ $grandChild->name }}</td>
                                        <td>{{ $grandChild->status }}</td>
                                        <td>{{ $grandChild->comment }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<style>
    @media print {
        .hide-in-print {
            display: none;
        }
    }
</style>
