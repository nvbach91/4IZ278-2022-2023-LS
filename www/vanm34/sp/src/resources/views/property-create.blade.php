<!DOCTYPE html>
<html>
@include('partials.header')
<body>

    @include('partials.navbar')

    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Page Content -->
        <div id="content">
            <div class="container">
                <h1 class="my-4">Edit Property</h1>

                <form action="{{ route('property.store') }}" method="POST">
                    <!-- to check if user who is making changes is actually authenticated  -->
                    @csrf

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" maxlength="40">
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="longDescription">Long Description:</label>
                        <textarea id="longDescription" name="longDescription" class="form-control" maxlength="255">{{ old('longDescription')}}</textarea>
                        @error('longDescription')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="property_type">Property Type:</label>
                        <select id="property_type" name="property_type" class="form-control">
                            <option value="1">Apartment</option>
                            <option value="2">House</option>
                            <option value="3">Lot</option>
                        </select>
                        @error('property_type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rentsale">For Rent/Sale:</label>
                        <select id="rentsale" name="rentsale" class="form-control">
                            <option value="1">Rent</option>
                            <option value="2">Sale</option>
                        </select>
                        @error('rentsale')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="size">Size:</label>
                        <input id="size" type="text" name="size" class="form-control" value="{{ old('size') }}">
                        @error('size')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input id="price" type="text" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input id="street" type="text" name="street" class="form-control" value="{{ old('street') }}" maxlength="255">
                        @error('street')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input id="city" type="text" name="city" class="form-control" value="{{ old('city') }}" maxlength="255">
                        @error('city')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group image-inputs">
                        <div class="image-input">
                            <label for="imagepath">Image URL:</label>
                            <input type="text" name="imagepath[]" class="form-control">
                            <input type="radio" name="is_main" value="0"> Is main image?
                            <button type="button" class="btn btn-danger delete-image">Remove</button>
                        </div>
                    </div>
                    <button type="button" id="add-image-input" class="btn btn-primary">Add More Image</button>

                    <div style="margin: 50px;">
                        <button type="submit" class="btn btn-primary">Add Property</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</body>

<footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            var mainImageIndex = 0;
            var imageInputTemplate = $('.image-input').first().clone();

            $('#add-image-input').click(function() {
                var imageInput = imageInputTemplate.clone();
                imageInput.find('input').val('');
                imageInput.find('input[type=radio]').val(++mainImageIndex);
                imageInput.appendTo('.image-inputs');
            });
            $('.image-inputs').on('click', '.delete-image', function() {
                var button = $(this);
                button.parent().remove();
            });
        });
    </script>
</footer>

</html>