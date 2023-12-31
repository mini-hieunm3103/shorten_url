<div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="m-0 font-weight-bold" style=" color: #3b3b3d">Edit Link</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.url.index')}}" method="post" class="mt-3 edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 pb-3" style="border-bottom: 2px solid #f1e8e8;">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3 shorted_url">
                                        <label for="">Title <small style="font-size: 16px">
                                                (optional)</small></label>
                                        <input value="" name="title" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3 shorted_url">
                                        <label for="">Domain</label>
                                        <select name="domain" disabled class="form-control form-select">
                                            <option selected value="{{$domain}}">{{$domain}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1 d-flex justify-content-center">
                                    <div class="mb-3 font-weight-bold" style="; margin-top: 35px;">
                                        <span style="align-items: center; font-size: 20px">/</span>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="mb-3 shorted_url">
                                        <label for="">Back-half </label>
                                        <input value="" name="back_half" type="text"
                                               class="form-control @error('back_half') is-invalid @enderror"
                                               placeholder="yourBackHalf">
                                        @error('back_half')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="archived" value="1">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-6 mt-3 mb-4 pl-0">
                                <h4 class="m-0 font-weight-bold" style=" color: #3b3b3d">Option details</h4>
                            </div>
                            <div class=" p-0">
                                <div class="mb-3" style="width: 100%; background-color: #fffffc">
                                    <div class="multiSelect">
                                        <select name="tags[]" multiple class="edit-tags-field" data-placeholder="Add Tags" style="width: 100%">

                                        </select>
                                    </div>

                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
                                            <g stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </g>
                                        </symbol>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
