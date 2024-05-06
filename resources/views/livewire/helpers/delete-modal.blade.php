<div>
    <x-confirmation-modal wire:model="open">
        <x-slot name="title"> {!! $title !!} </x-slot>
        <x-slot name="content"> {!! $content !!} <br><small> <b>ID: {{$identifier}}</b></small></x-slot>
        <x-slot name="footer">

            <x-secondary-button wire:click="$set('open', false)" class="mr-2">Cancelar</x-secondary-button>
            <x-danger-button wire:click="confirm">{{$actionName}}</x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
