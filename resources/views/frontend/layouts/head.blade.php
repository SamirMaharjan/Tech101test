<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <style>
        .pagination.theme-colored li.active a {
            background: #bf9e58;
            color: #fff;
            border: 1px solid transparent;
        }

        .pagination.dark li a {
            color: #333;
        }

        .pagination.dark li.active a {
            background: #333;
            color: #fff;
            border: 1px solid transparent;
        }

        .pager.theme-colored li.active a {
            color: #fff;
            border: 1px solid transparent;
        }

        .pager.dark li a {
            color: #fff;
            background-color: #333;
            border: 1px solid transparent;
        }
    </style>

</head>
