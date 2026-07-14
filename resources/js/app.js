import './bootstrap';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'
import mask from '@alpinejs/mask'

Alpine.plugin(Clipboard)
Alpine.plugin(mask)
Livewire.start()
