<!DOCTYPE html>
<html>

@include('partials.header')

<body>

    @include('partials.navbar')

    <div class="wrapper">
        @include('partials.sidebar')

        <div id="content">
            <div class="container">
                <h1>Contact Us</h1>

                <h3>Are Owners, contact us!:</h3>
                @foreach($users as $user)
                <p>{{ $user->email }}</p>
                @endforeach

                <form action="{{ route('contact.send') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>