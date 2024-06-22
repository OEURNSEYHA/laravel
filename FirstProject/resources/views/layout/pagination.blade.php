

@if($paginator->hasPages())
    <div class="paginate">
        @if($paginator->onFirstPage())
            <a href="#" disabled > &laquo; </a>  
        @else
             <a href="{{$paginator->previousPageUrl()}}" class="active-page"> &laquo; </a> 
        @endif

        @foreach( $elements as $element)
            @if(is_string($element))
                <a href="">{{$element}}</a>

            @endif
            @if (is_array($element))

                @foreach($element as $page => $url)
                    @if ($page === $paginator->currentPage())

                        <a href="#" class="active-page">{{$page}}</a>

                    @else

                        <a href="{{ $url }}" class="active-page">{{$page}}</a>

                    @endif
                @endforeach
                
            @endif
        @endforeach

        @if ($paginator->hasMorepages())
            <a href="{{$paginator->nextPageUrl()}}"> &raquo;</a>
        @else
            <a href="#"> &raquo;</a>
        @endif
        
        
       
    </div>
@endif