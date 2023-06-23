<div>
    <div class="p-2 shadow-lg rounded bg-dark mb-3">
        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#addTagModal">Nový tag</a>
    </div>



    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tag</th>
                <th scope="col">Barva</th>
                <th scope="col">Projektů</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td><span class="badge p-2 text-light shadow-sm"
                            style="background-color: #{{ $tag->color }}">...</span></td>
                    <td>{{ $tag->projects->count() }}</td>
                    <td class="text-end" style="width: 50px;">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link dropdown-toggle" type="button"
                                id="task{{ $tag->id }}Actions" data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="task{{ $tag->id }}Actions">
                                <li><a class="dropdown-item" wire:click="updateTag({{ $tag->id }})"
                                        data-toggle="modal" data-target="#updateTagModal">Upravit</a></li>
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <li><button type="submit" class="dropdown-item"
                                            href="#">Odstranit</a></button>
                                </form>

                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="modal fade" id="updateTagModal" tabindex="-1" role="dialog" aria-labelledby="updateTagModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Upravit tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tags.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Název</label>
                            <input type="text" class="form-control" id="name" name="name" wire:model="name"
                                required>
                        </div>
                        <div class="form-group mx-2">
                            <div class="square-radio px-3">
                                <div class="row">
                                    @foreach ($colors as $color)
                                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="{{ $color->HEX }}"
                                                {{ $color->HEX == 'FFFFFF' ? 'checked' : '' }}
                                                style="background-color: #{{ $color->HEX }}" required
                                                wire:model="color">
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <input wire:model="tagId" type="hidden" id="id" name="id">

                        <button type="submit" class="btn btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="addTagModalLabel">Přidat nový tag</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Název</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mx-2">
                            <div class="square-radio px-3">
                                <div class="row">
                                    @foreach ($colors as $color)
                                        <div class="col-lg-2 col-md-4 col-6 mb-2 mx-auto">
                                            <input class="form-check-input" type="radio" name="color"
                                                value="{{ $color->HEX }}" wire:model="color"
                                                {{ $color->HEX == 'FFFFFF' ? 'checked' : '' }}
                                                style="background-color: #{{ $color->HEX }}" required>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
                        <button type="submit" class="btn btn-primary">Uložit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
