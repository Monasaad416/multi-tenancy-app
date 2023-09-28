<div>
    <form wire:submit.prevent="submit">
        @foreach($addedItems as $key => $addedItem)
            <div class="row" wire:key="addedItem-{{$key}}">
                <div class="col-11">
                    <label for="name" class="mr-sm-2">البند:</label>
                    <input class="form-control" type="text" wire:model="addedItems.{{$key}}" />
                </div>
                <div class="col-1" style="margin-top:33px;" wire:click.prevent="removeItem({{$key}})">
                    <a><i class="fas fa-2x fa-trash text-danger"></i></a>
                </div>
            </div>
        @endforeach


        <div class="row">
            <div class="col-12 my-3">
                <button class="btn btn-outline-success" wire:click.prevent="addNewItem" >
                    <i class="fas fa-plus"></i>{!! "&nbsp;" !!} {!! "&nbsp;" !!}إضافة بند 
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-3 text-center">
                <button type="submit" class="btn btn-primary" >حفظ</button>
            </div>
        </div>
    </form>    
</div>
