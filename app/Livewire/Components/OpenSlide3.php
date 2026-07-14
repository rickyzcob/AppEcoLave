<?php

namespace App\Livewire\Components;

use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;

class OpenSlide3 extends Component
{
    use WithModal;
    public $openSlide3 = false;
    public $blade = '';
    public $params = [];

    public int $slideId = 3;

    #[On('openSlide3')]
    public function showSlide3($blade = null, $params = null)
    {
        $this->pushSlideToStack();
        $this->openSlide3  = true;
        $this->blade = $blade;
        $this->params = $params;
    }
    #[On('closeSlide3')]
    public function closeSlide3()
    {
        $this->removeSlideFromStack();
        $this->openSlide3 = false;
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
            $this->openSlide3 = false;
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
        return view('livewire.components.open-slide3');
    }
}
