@if ($paginator->hasPages())
   
       
        @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link disabled"> Previous </a>
        </li>
        @else
         <li class="page-item disabled">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"> Previous </a>
        </li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <a class="disabled"><span>{{ $element }}</span></a>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a href="#" class="page-link active">{{ $page }}</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}"> Next </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" class="disabled"> Next </a>
        </li>
        @endif
    
@endif 