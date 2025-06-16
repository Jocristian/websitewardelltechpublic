@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header text-center font-weight-bold">
                    {{ __('Verifikasi Alamat Email Anda') }}
                </div>

                <div class="card-body text-center">
                    <i class="fas fa-paper-plane text-success mb-4" style="font-size: 120px;"></i>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Tautan verifikasi yang baru telah dikirim ke alamat email Anda.') }}
                        </div>
                    @endif

                    <p >{{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}</p>
                    <p >{{ __('Jika Anda tidak menerima email tersebut, klik tombol di bawah ini:') }}</p>

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="py-3">
                            <button type="submit py-2" class="btn btn-success">
                                {{ __('Kirim Ulang Email Verifikasi') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
