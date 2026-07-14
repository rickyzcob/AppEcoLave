<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithModal
{
    use WithPagination;
    public $showDeleteModal = false;
    public $type = '';

    public function openSlide($blade, $params = [], $slide = null)
    {
        if($slide == null ) {
            $this->dispatch('openSlide', blade:$blade,  params:$params);
        }else if ($slide == 2) {
            $this->dispatch('openSlide2', blade:$blade,  params:$params);
        } else if ($slide == 3) {
            $this->dispatch('openSlide3', blade:$blade,  params:$params);
        }
    }
    public function closeSlide($slide = [])
    {
        if($slide == 1 ) {
            $this->dispatch('closeSlide1');
        }elseif ($slide == 2) {
            $this->dispatch('closeSlide2');
//            $this->dispatch('closeSlide1', openSlide2:true);
        } elseif ($slide == 3) {
            $this->dispatch('closeSlide3');
//            $this->dispatch('closeSlide2', openSlide3:true);
        }

    }

    public function openSlideMD($blade, $params = [])
    {
        $this->dispatch('showSlideMD', blade:$blade,  params:$params);
    }

    public function closeSlideMD()
    {
        $this->dispatch('closeSlideMD');
    }

    public function openSlide4xl($blade, $params = [])
    {
        $this->dispatch('openSlide4xl', blade:$blade,  params:$params);
    }

    public function closeSlide4xl()
    {
        $this->dispatch('closeSlide4xl');
    }

    public function openSlide6xl($blade, $params = [])
    {
        $this->dispatch('openSlide6xl', blade:$blade,  params:$params);
    }

    public function closeSlide6xl()
    {
        $this->dispatch('closeSlide6xl');
    }

    public function openSlide7xl($blade, $params = [])
    {
        $this->dispatch('openSlide7xl', blade:$blade,  params:$params);
    }

    public function closeSlide7xl()
    {
        $this->dispatch('closeSlide7xl');
    }
    public function openModal($component, $params = [], $modal = null)
    {
        if($modal == null) {
            $this->dispatch('showModal', $component,  $params);
        } else if ($modal == 2) {
            $this->dispatch('showModal2',  $component,  $params);
        } else if ($modal == 3) {
            $this->dispatch('showModal3',  $component,  $params);
        }
    }

    public function closeModals($modal = null)
    {
        if($modal == null) {
            $this->dispatch('closeModal');
        } else if ($modal == 2) {
            $this->dispatch( 'closeModal2');
        } else if ($modal == 3) {
            $this->dispatch('closeModal3');
        }
    }

    public function openCentralModal($blade, $params = [])
    {
        $this->dispatch('showCentralModal', blade:$blade,  params:$params);
    }

    public function closeCentralModal()
    {
        $this->dispatch('hideCentralModal');
    }
}
