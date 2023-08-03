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
        table, th, tr,td {
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th style="text-align: center"><img src="{{ asset('sawitkinabalu.png') }}" style="width:150px;height:80px;" alt="Sawit Kinabalu"></th>
                           <th style="text-align: center"><span class="logo-title">Self-Workplace Inspection Form</span></th>  
                           
                        </tr>
                    </table>
                </div>
             </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                {{-- OperatingForm and MainWorkForm --}}
                    <a class="btn btn-primary mb-3 hide-in-print" href="#" onclick="window.print()">Print</a>
                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <tr>
                            <th>No</th>
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
                            <th colspan="4">
                                Operating Unit: 
                            </th>
                            </tr>

                            <tr>
                              <th colspan="2">Tarikh Pemeriksaan:</th>
                              <th colspan="2">Masa Pemeriksaan:</th>
                            </tr>
                           
                            
                            <tr>
                                <th>No</th>
                                <th width="350px">Name</th>
                                <th width="80px">Compliance Status</th>
                                <th width="460px">Comment</th>
                                
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
                <td style="text-align: center;"></td>
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

<!-- ... Remaining HTML code ... -->

            
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
