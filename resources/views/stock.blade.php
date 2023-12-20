@extends('layouts.app')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @php
    $stok1 = 100;

    // Define arrays for forecast, incoming, and gr values for each month
    $forecasts = [10,10,10,10,10,10,10,10,10,10,10,10];
    $incomings = [10,10,10,10,10,10,10,10,10,10,10,10];
    $grs = [10,10,10,10,10,200,10,10,10,10,10,10];

    $balances = [$stok1];
    
    @endphp 
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">          
          <!-- /.col-md-12 -->
          <div class="col-md-12">
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>P/N Before</th>
                    <th>P/N After</th>
                    <th>Part Name</th>
                    <th>Shortage</th>
                    <th></th>                    
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="bg-default">
                    <td>1</td>
                    <td>Indospring</td>
                    <td>41243-10480</td>
                    <td>41243-10490</td>
                    <td>Spring</td>
                    <td>@php
                        for ($i = 0; $i < 12; $i++) {
                        $forecast = $forecasts[$i];
                        $incoming = $incomings[$i];
                        $gr = $grs[$i];
                        $balance = $balances[$i] + $incoming - $gr;
                        
                        // Store the balance in an array for future reference
                        $balances[] = $balance;

                        //echo "Balance after month " . ($i + 4) . ": $balance\n";

                        // Check if balance is less than 0
                        if ($balance < 0) {
                            echo ($i + 4)."-2023";
                            break; // Exit the loop if balance is less than 0
                        }
                      }
                    @endphp</td>
                    <td><a href="" class="btn btn-sm btn-success">View Stock</a></td>                    
                  </tr>
                  <tr class="bg-default">
                    <td>2</td>
                    <td>Indospring</td>
                    <td>41243-10410</td>
                    <td>41243-10420</td>
                    <td>Spring</td>
                    <td>@php
                        for ($i = 0; $i < 12; $i++) {
                        $forecast = $forecasts[$i];
                        $incoming = $incomings[$i];
                        $gr = $grs[$i];
                        $balance = $balances[$i] + $incoming - $gr;
                        
                        // Store the balance in an array for future reference
                        $balances[] = $balance;

                        //echo "Balance after month " . ($i + 4) . ": $balance\n";

                        // Check if balance is less than 0
                        if ($balance < 0) {
                            echo ($i + 4)."-2023";
                            break; // Exit the loop if balance is less than 0
                        }
                      }
                    @endphp</td>
                    <td><a href="" class="btn btn-sm btn-success">View Stock</a></td>                    
                  </tr>
                  <tr class="bg-default">
                    <td>3</td>
                    <td>Indospring</td>
                    <td>41243-10400</td>
                    <td>41243-10390</td>
                    <td>Spring</td>
                    <td>@php
                        for ($i = 0; $i < 12; $i++) {
                        $forecast = $forecasts[$i];
                        $incoming = $incomings[$i];
                        $gr = $grs[$i];
                        $balance = $balances[$i] + $incoming - $gr;
                        
                        // Store the balance in an array for future reference
                        $balances[] = $balance;

                        //echo "Balance after month " . ($i + 4) . ": $balance\n";

                        // Check if balance is less than 0
                        if ($balance < 0) {
                            echo ($i + 4)."-2023";
                            break; // Exit the loop if balance is less than 0
                        }
                      }
                    @endphp</td>
                    <td><a href="" class="btn btn-sm btn-success">View Stock</a></td>                    
                  </tr>
                  </tbody>                  
                </table>
                <hr>
                <form action="">
                <label for="">Tahun</label>
                <select name="tahun" class="">
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
                <input type="submit" value="view">
                </form>
                <hr>
                <table id="" class="table table-bordered table-striped">
                  <thead>
                    <tr bgcolor="green" style="font-weight: bold">
                      <th>Bulan</th>  
                      <td>Apr</td>
                      <td>May</td>
                      <td>Jun</td>
                      <td>Jul</td>
                      <td>Aug</td>
                      <td>Sep</td>
                      <td>Oct</td>
                      <td>Nov</td>
                      <td>Dec</td>
                      <td>Jan</td>
                      <td>Feb</td>
                      <td>Mar</td>                                      
                    </tr>
                    <tr>
                      @php
                        $stok1=100;
                        $forecast1=10;
                        $incoming1=10;
                        $gr1=10;
                        $balance1=$stok1+$incoming1-$gr1;

                        $forecast2=10;
                        $incoming2=10;
                        $gr2=10;
                        $balance2=$balance1+$incoming2-$gr2;
                        
                        $forecast3=10;
                        $incoming3=10;
                        $gr3=10;
                        $balance3=$balance2+$incoming3-$gr3;
                        
                        $forecast4=10;
                        $incoming4=10;
                        $gr4=10;
                        $balance4=$balance3+$incoming4-$gr4;
                        
                        $forecast5=10;
                        $incoming5=10;
                        $gr5=10;
                        $balance5=$balance4+$incoming5-$gr5;
                        
                        $forecast6=10;
                        $incoming6=10;
                        $gr6=200;
                        $balance6=$balance5+$incoming6-$gr6;
                        
                        $forecast7=10;
                        $incoming7=10;
                        $gr7=10;
                        $balance7=$balance6+$incoming7-$gr7;
                        
                        $forecast8=10;
                        $incoming8=10;
                        $gr8=10;
                        $balance8=$balance7+$incoming8-$gr8;
                        
                        $forecast9=10;
                        $incoming9=10;
                        $gr9=10;
                        $balance9=$balance8+$incoming9-$gr9;
                        
                        $forecast10=10;
                        $incoming10=10;
                        $gr10=10;
                        $balance10=$balance9+$incoming10-$gr10;
                        
                        $forecast11=10;
                        $incoming11=10;
                        $gr11=10;
                        $balance11=$balance10+$incoming11-$gr11;
                        
                        $forecast12=10;
                        $incoming12=10;
                        $gr12=10;
                        $balance12=$balance11+$incoming12-$gr12;

                      @endphp
                      
                    <th>Stock</th>  
                    <td>{{$stok1}}</td>
                    <td>{{$balance1}}</td>
                    <td>{{$balance2}}</td>
                    <td>{{$balance3}}</td>
                    <td>{{$balance4}}</td>
                    <td>{{$balance5}}</td>
                    <td>{{$balance6}}</td>
                    <td>{{$balance7}}</td>
                    <td>{{$balance8}}</td>
                    <td>{{$balance9}}</td>
                    <td>{{$balance10}}</td>
                    <td>{{$balance11}}</td>                                      
                  </tr>
                  <tr>
                    <th>Forecast</th>  
                    <td>{{$forecast1}}</td>
                    <td>{{$forecast2}}</td>
                    <td>{{$forecast3}}</td>
                    <td>{{$forecast4}}</td>
                    <td>{{$forecast5}}</td>
                    <td>{{$forecast6}}</td>
                    <td>{{$forecast7}}</td>
                    <td>{{$forecast8}}</td>
                    <td>{{$forecast9}}</td>
                    <td>{{$forecast10}}</td>
                    <td>{{$forecast11}}</td>
                    <td>{{$forecast12}}</td>
                  </tr>
                  <tr>
                    <th>Incoming Supplier</th>
                    <td>{{$incoming1}}</td>
                    <td>{{$incoming2}}</td>
                    <td>{{$incoming3}}</td>
                    <td>{{$incoming4}}</td>
                    <td>{{$incoming5}}</td>
                    <td>{{$incoming6}}</td>
                    <td>{{$incoming7}}</td>
                    <td>{{$incoming8}}</td>
                    <td>{{$incoming9}}</td>
                    <td>{{$incoming10}}</td>
                    <td>{{$incoming11}}</td>
                    <td>{{$incoming12}}</td>                     
                  </tr>
                  <tr>
                    <th>GR Aisin</th>
                    <td>{{$gr1}}</td>
                    <td>{{$gr2}}</td>
                    <td>{{$gr3}}</td>
                    <td>{{$gr4}}</td>
                    <td>{{$gr5}}</td>
                    <td>{{$gr6}}</td>
                    <td>{{$gr7}}</td>
                    <td>{{$gr8}}</td>
                    <td>{{$gr9}}</td>
                    <td>{{$gr10}}</td>
                    <td>{{$gr11}}</td>
                    <td>{{$gr12}}</td> 
                  </tr>
                  <tr>
                    <th>Balance</th>
                    <td>{{$balance1}}</td>
                    <td>{{$balance2}}</td>
                    <td>{{$balance3}}</td>
                    <td>{{$balance4}}</td>
                    <td>{{$balance5}}</td>
                    <td>{{$balance6}}</td>
                    <td>{{$balance7}}</td>
                    <td>{{$balance8}}</td>
                    <td>{{$balance9}}</td>
                    <td>{{$balance10}}</td>
                    <td>{{$balance11}}</td>
                    <td>{{$balance12}}</td> 
                  </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  
@endsection