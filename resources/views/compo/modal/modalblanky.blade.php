<div class="modal inmodal" id="{{ $id or '' }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog {{ $size or '' }}">{{--'modal-lg'--}}
        <div class="modal-content animated flipInY">
            <div class="modal-header" style="text-align: left;padding: 15px">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="{{ $title_style or '' }}">{{ $title or '' }}</h4>
            </div>
            <div class="modal-body">
                <div class="tabs-container">{{ $blankbldy or '' }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>