
@foreach($imports as $import)
  
	@import "{{ $boomPath }}/bower_components/{{ $import }}";
	
@endforeach