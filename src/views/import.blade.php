
@foreach($imports as $import)
  
	@import "{{ $boom }}/bower_components/{{ $import }}";
	
@endforeach