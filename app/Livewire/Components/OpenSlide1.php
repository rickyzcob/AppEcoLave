<?php

namespace App\Livewire\Components;

use App\Traits\WithModal;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class OpenSlide1 extends Component
{
    use WithModal;

    public $openSlide = false;
    public $openSlide2 = false;
    public $openSlide3 = false;

    public int $slideId = 1;

    public $blade = '';
    public $params = [];
    #[On('openSlide')]
    public function showSlide($blade = null, $params = [])
    {
        $this->pushSlideToStack();

        $this->openSlide  = true;
        $this->blade = $blade;
        $this->params = $params;
    }

    #[On('openSlideJava')]
    public function openSlideJava($component = null, $params = [])
    {
        $this->pushSlideToStack();

        $this->openSlide  = true;
        $this->blade = $component;
        $this->params = $params;
    }


    #[On('closeSlide1')]
    public function closeSlide1($openSlide2 = false)
    {
        $this->removeSlideFromStack();

        if($openSlide2 == true) {
            $this->openSlide = true;
        } else {

            $this->openSlide = false;
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
            $this->openSlide = false;
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
        return view('livewire.components.open-slide1');
    }
}
