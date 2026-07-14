<?php

namespace App\Livewire\Components;

use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlide2 extends Component
{
    use WithModal;
    public $openSlide = false;
    public $openSlide2 = false;

    public $blade = '';
    public $params = [];

    public int $slideId = 2;

    #[On('openSlide2')]
    public function showSlide2($blade = null, $params = null)
    {
        $this->pushSlideToStack();

        $this->openSlide2  = true;
        $this->blade = $blade;
        $this->params = $params;

    }
    #[On('closeSlide2')]
    public function closeSlide2($openSlide3 = false)
    {
        $this->removeSlideFromStack();

        if($openSlide3 == true) {
            $this->openSlide2 = true;
        } else {
            $this->openSlide2 = false;
        }
    }

    #[On('esc-pressed')]
    public function handleEsc()
    {
        $stack = session()->get('slides_stack', []);

        if (empty($stack)) {
            return;
        }

        $topSlide = end($stack);

        if ($topSlide === $this->slideId) {
            $this->openSlide2 = false;
            $this->removeSlideFromStack();
        }
    }

    protected function pushSlideToStack()
    {
        $stack = session()->get('slides_stack', []);

        if (!in_array($this->slideId, $stack)) {
            $stack[] = $this->slideId;
            session()->put('slides_stack', $stack);
        }
    }

    protected function removeSlideFromStack()
    {
        $stack = session()->get('slides_stack', []);

        $stack = array_filter($stack, fn ($id) => $id !== $this->slideId);

        session()->put('slides_stack', array_values($stack));
    }

    public function render()
    {
        return view('livewire.components.open-slide2');
    }
}
