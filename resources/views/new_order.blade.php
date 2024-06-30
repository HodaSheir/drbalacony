@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Order Registration</h2>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user_name">User Name</label>
                    <input type="text" id="user_name" name="user_name" class="form-control" autocomplete="off">
                    <div id="user_suggestions" class="list-group mt-2"></div>
                </div>
                <div class="form-group">
                    <label for="order_detail">Order Detail</label>
                    <textarea id="order_detail" name="order_detail" class="form-control" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('user_name').addEventListener('input', function() {
            let query = this.value;
            if (query.length > 2) {
                fetch(`/search-users?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let suggestions = data.map(user =>
                            `<button type="button" class="list-group-item list-group-item-action suggestion-item">${user.name}</button>`
                            ).join('');
                        document.getElementById('user_suggestions').innerHTML = suggestions;

                        // Add click event listener to each suggestion
                        document.querySelectorAll('.suggestion-item').forEach(function(item) {
                            item.addEventListener('click', function() {
                                document.getElementById('user_name').value = this.textContent;
                                document.getElementById('user_suggestions').innerHTML =
                                ''; // Clear suggestions
                            });
                        });
                    });
            }
        });
    </script>
@endsection
