<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Tag;
use App\Models\Color;

class TagManager extends Component
{

    public $name;
    public $color;
    public $tagId;


    public function render()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        $colors = Color::all();
        return view('livewire.tag-manager', compact('tags', 'colors'));
    }

    public function updateTag($tagId){
        $tag = Tag::where('id', $tagId)->first();
        $this->name = $tag->name;
        $this->tagId = $tagId;
        $this->color = $tag->color;
    }


}
