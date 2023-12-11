<x-mail::message>

# Introduction
<div> New Item Created.</div>
<div>
    The new item {{$item->Name}} was created successfully.
    Item ID: {{$item->id}} 
</div>

#<x-mail::button :url="''">
#Button Text
#</x-mail::button>

Thanks, <br>
</x-mail::message>