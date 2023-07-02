@extends('frontend.layouts.master')
@section('content')
    <h2>Stacked form</h2>

    <div class="container word-count">
        <div class="mb-3 mt-3">
            <label for="email">Enter Your Text:</label>
            <textarea name="description" class="form-control" id="description" cols="10" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
    </div>
@endsection
@section('scripts')
    <script>
        $('.submit-btn').on('click', count_word)

        function count_word() {
            var text = $('#description').val();
            var url1 = "{{ route('count_word_post') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    text: text,
                },
                url: url1,
                success: function(result) {
                    
                    $.each(result.wordcount, function(key, value) {
                        $('.word-count').append('<p>Sentence '+(key+1) +' has ' +value+' words</p><br>');
                    });
                }
            });


        }
    </script>
@endsection
