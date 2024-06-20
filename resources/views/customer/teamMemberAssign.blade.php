 <!-- Teammember Modal -->
 <div class="modal fade" id="teamMemberModal-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="/assignCustomerToTeamMember" method="POST" class="needs-validation" novalidate >
    @csrf
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Team Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="form-group">
        <strong><span class="text-danger">*</span>Team Members:</strong>
            <select class="form-control" name="team_member_id" id="team_member_id" required>
            <option value="">Select Team Member</option>
            @foreach ($teamMembers as $teamMember)
                @if ($team_member_id === $teamMember->id)
                    <option value="{{$teamMember->id}}" selected> {{ isset($teamMember->users) ? $teamMember->users->name : '' }}</option>
                @else
                    <option value="{{$teamMember->id}}"> {{ isset($teamMember->users) ? $teamMember->users->name : '' }}</option>
                @endif
            @endforeach
            </select>
            <div class="invalid-feedback">
                Please upload your Company Reference image 
             </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </div>
        <input type="hidden" name="customer_id" value="{{$customer->id}}">
    </form>
</div>
@push('scripts')
<script src="{{asset('js/validate.js')}}"></script>
@endpush