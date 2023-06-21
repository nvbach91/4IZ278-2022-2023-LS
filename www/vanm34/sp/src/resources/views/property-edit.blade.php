<!DOCTYPE html>
<html>

@include('partials.header')
<body>

    @include('partials.navbar')

    <div class="wrapper">
        @include('partials.sidebar')

        <!-- Page Content -->
        <div id="content">
            <div class="container">
                <h1 class="my-4">Edit Property</h1>

                <form action="{{ route('property.update', $property) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $property->description) }}" maxlength="40">
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="longDescription">Long Description:</label>
                        <textarea id="longDescription" name="longDescription" class="form-control" maxlength="255">{{ old('longDescription', $property->longDescription) }}</textarea>
                        @error('longDescription')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="property_type">Property Type:</label>
                        <select id="property_type" name="property_type" class="form-control">
                            <option value="1" @if(old('property_type', $property->property_type) == 1) selected @endif>Apartment</option>
                            <option value="2" @if(old('property_type', $property->property_type) == 2) selected @endif>House</option>
                            <option value="3" @if(old('property_type', $property->property_type) == 3) selected @endif>Lot</option>
                        </select>
                        @error('property_type')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="rentsale">For Rent/Sale:</label>
                        <select id="rentsale" name="rentsale" class="form-control">
                            <option value="1" @if(old('rentsale', $property->rentsale) == 1) selected @endif>Rent</option>
                            <option value="2" @if(old('rentsale', $property->rentsale) == 2) selected @endif>Sale</option>
                        </select>
                        @error('rentsale')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="size">Size:</label>
                        <input id="size" type="text" name="size" class="form-control" value="{{ old('size', $property->size) }}">
                        @error('size')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input id="price" type="text" name="price" class="form-control" value="{{ old('price', $property->price) }}">
                        @error('price')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input id="street" type="text" name="street" class="form-control" value="{{ old('street', $property->street) }}" maxlength="255">
                        @error('street')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input id="city" type="text" name="city" class="form-control" value="{{ old('city', $property->city) }}" maxlength="255">
                        @error('city')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group image-inputs">
                        @foreach($property->images as $image)
                        <div class="image-input">
                            <label for="imagepath">Image URL:</label>
                            <input type="text" name="imagepath[]" class="form-control" value="{{ old('imagepath.' . $loop->index, $image->imagepath) }}">
                            <input type="radio" name="is_main" value="{{ $loop->index }}" {{ $image->is_main ? 'checked' : '' }}> Is main image?
                            <button type="button" class="btn btn-danger delete-image" data-id="{{ $image->id }}">Remove</button>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-image-input" class="btn btn-primary">Add More Image</button>

                    <div style="margin: 50px;">
                        <button type="submit" class="btn btn-primary">Update Property</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</body>

<footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script>
        $(document).ready(function() {
            var mainImageIndex = $('.image-input').length - 1;
            var imageInputTemplate = $('.image-input').first().clone();
            $('#add-image-input').click(function() {
                var imageInput = imageInputTemplate.clone();
                imageInput.find('input').val('');
                imageInput.find('input[type=radio]').val(++mainImageIndex);
                imageInput.appendTo('.image-inputs');
            });

            // Delegating the click event from a static parent to the .delete-image button.
            $('.image-inputs').on('click', '.delete-image', function() {
                var button = $(this);
                var inputField = button.siblings('input[type=text]');
                var id = button.data('id');

                // If input field is empty, remove the field.
                if (inputField.val() === '') {
                    button.parent().remove();
                } else {
                    // If input field is not empty, send DELETE request as before.
                    $.ajax({
                        url: '/propertyEditor/image/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function() {
                            button.parent().remove();
                        }
                    });
                }
            });
        });
    </script>
</footer>



</html>