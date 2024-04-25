@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <h2 class="text-center mb-4">Detail Pembayaran</h2>
                <table class="table">
                    <tr>
                        <td>Nama Produk</td>
                        <td>{{$order->product->name}}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>Rp {{$order->amount}}</td>
                    </tr>
                </table>
                @if ($transaction['status_code'] != "200")
                <div class="text-center">
                    <button id="pay-button" class="btn btn-primary btn-lg">Bayar Sekarang</button>
                </div>
                @endif
                <div class="mt-4">
                    <p>JSON result:</p>
                    <div id="result-json">
                        <p>Status Code: {{$transaction['status_code']}}</p>
                        <p>Status Message: {{$transaction['status_message']}}</p>
                        <p>Transaction ID: {{$transaction['transaction_id']}}</p>
                        <p>Order ID: {{$transaction['order_id']}}</p>
                        <p>Gross Amount: {{$transaction['gross_amount']}}</p>
                        <p>Payment Type: {{$transaction['payment_type']}}</p>
                        <p>Transaction Time: {{$transaction['transaction_time']}}</p>
                        <p>Transaction Status: {{$transaction['transaction_status']}}</p>
                        <p>Fraud Status: {{$transaction['fraud_status']}}</p>
                        <p>Bank: {{$transaction['va_numbers'][0]['bank']}}</p>
                        <p>VA Number: {{$transaction['va_numbers'][0]['va_number']}}</p>
                        <p><a href="{{$transaction['pdf_url']}}">PDF Link</a></p>
                        <p><a href="{{$transaction['finish_redirect_url']}}">Riwayat Transaksi</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.clientKey')}}"></script>
<script>

function redirectToOrderHistory() {
        window.location.href = "{{ route('orderHistory') }}";
    }
    document.getElementById('pay-button').onclick = function(){
        snap.pay('<?=$snapToken?>', {
            onSuccess: function(result){
                redirectToOrderHistory();
                
            },
            onPending: function(result){
                redirectToOrderHistory();
            },
            onError: function(result){
                redirectToOrderHistory();
            }
        });
    };
</script>
@endsection
