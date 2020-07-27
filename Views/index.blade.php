@extends('layouts.app')

@section('grecaptcha')
@endsection
@section('content')
    <div class="panel-body">
        @include('common.errors')
        <div class="col-12 col-md-6">
            <form id="linked" name="linked" class="form-horizontal" method="POST" action="Contact">
                    {{ csrf_field() }}
                <div class="form-group">
                    <label for="Name">Name: </label>
                    <input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" placeholder="john@example.com" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">message: </label>
                    <textarea type="text" class="form-control luna-message" id="message" placeholder="Type your messages here" name="message" required></textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>

                This site is protected by reCAPTCHA and the Google
                <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                <a href="https://policies.google.com/terms">Terms of Service</a> apply.

                <div id="myWidget"></div>
                {!! app('captcha')->render() !!}
            </form>
            {!! app('captcha')->renderFooterJS('en') !!}
        </div>
    </div>
@endsection