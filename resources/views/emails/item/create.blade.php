<x-mail::message>
 @if($item->IsType='Create')
    <div> New Item Created.</div>
    <div>
        The new item {{$item->Name}} was Created successfully.
        Item ID: {{$item->id}}
    </div>
  @elseif($item->IsType='Update')  
  <div> The Item Updated.</div>
    <div>
        The item {{$item->Name}} was Upadted successfully.
        Item ID: {{$item->id}}
    </div>
  @else
  <div> The Item Deleted.</div>
    <div>
        The item {{$item->Name}} was Deleted successfully.
        <br>
        Item ID: {{$item->id}}
    </div>

  @endif

        #<x-mail::button :url="''">
        #Button Text
        #</x-mail::button>

    Thanks, <br>
    {{config('app.name')}}
</x-mail::message>